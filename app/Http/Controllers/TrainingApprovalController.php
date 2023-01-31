<?php

namespace App\Http\Controllers;

use App\Helper\NotificationHelper;
use App\Models\Division;
use App\Models\InstituteType;
use App\Models\Membership;
use App\Models\Notification;
use App\Models\TrainingMember;
use Illuminate\Http\Request;
use App\Helper\RedirectHelper;
use App\Models\Training;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use stdClass;

class TrainingApprovalController extends Controller {

  public function replace(Request $request) {
    $message = '<strong>Congratulations!!!</strong> Replace successfully';
    DB::beginTransaction();
    try {
      if (!($mem = TrainingMember::find($request->id))) {
        return response()->json(['error' => "Training Member not found."]);
      }

      if (!($user = User::find($request->repId))) {
        return response()->json(['error' => "Replace by Member not found."]);
      }
      $mem->status = TrainingMember::$statusArrays[3];
      $mem->replace_by = $user->id;
      $mem->save();

      $newMember = new TrainingMember();
      $newMember->training_id = $mem->training_id;
      $newMember->name = $user->name_en;
      $newMember->email = $user->email;
      $newMember->phone = $user->phone;
      $newMember->user_id = $user->id;

      $newMember->replace_from = $mem->user_id;
      $newMember->batch_approver_id = auth()->id();
      $newMember->batch_approver_approve_at = now();
      $newMember->batch_approver_approve_status = TrainingMember::$approvalArrays[0];
      $newMember->status = TrainingMember::$statusArrays[1];
      $newMember->save();
      NotificationHelper::create(Notification::$types[0], $mem->user_id, 'Training Application.', 'Your application is replaced at ' . now()->format('h:i A F d,Y'));
      NotificationHelper::create(Notification::$types[0], $newMember->user_id, 'Training Application.', 'Your are selected to a training at ' . now()->format('h:i A F d,Y'));
      DB::commit();
      return response()->json(['success' => 'Member Replaced.']);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => 'Something went wrong.']);
    }
  }


  public function approval() {
    if (\auth()->user()->hasRole('Batch Creator')) {
      $data['trainings'] = Training::withCount('members')->with('district:id,name', 'institute:id,name', 'user:id,name_en')->where('batch_creator_id', \auth()->id())->orderby('id')->get();
    } elseif (\auth()->user()->hasRole('Batch Approver')) {
      $data['trainings'] = Training::withCount('members')->with('district:id,name', 'institute:id,name', 'user:id,name_en')->where('batch_approver_id', \auth()->id())->orderby('id')->get();
    } else {
      $data['trainings'] = Training::withCount('members')->with('district:id,name', 'institute:id,name', 'user:id,name_en')->orderby('id')->get();
    }
    return view('admin.training.approval.index', $data);
  }


  public function approvalMemberList($id = null) {
    if ($data['training'] = Training::withCount('members')->with('members', 'district:id,name', 'institute:id,name', 'user:id,name_en')->where('id', $id)->first()) {
      if (\auth()->user()->hasRole('Batch Creator')) {
        $data['pendings'] = TrainingMember::with('head', 'creator', 'approver')->where('training_id', $id)->whereNull('batch_creator_approve_status')->where('status', TrainingMember::$statusArrays[0])->get();
      } else {
        $data['pendings'] = TrainingMember::with('head', 'creator', 'approver')->where('training_id', $id)->whereNull('batch_approver_approve_status')->where('status', TrainingMember::$statusArrays[0])->get();
      }
      $data['accepted'] = TrainingMember::with('head', 'creator', 'approver', 'user.institute', 'replacedby:id,name_en', 'replacedfrom:id,name_en')->where('training_id', $id)->whereIn('status', [TrainingMember::$statusArrays[1], TrainingMember::$statusArrays[3]])->get();
//      return $data;
      $data['rejected'] = TrainingMember::with('head', 'creator', 'approver')->where('training_id', $id)->where('status', TrainingMember::$statusArrays[2])->get();

      $data['users'] = User::whereHas('institute')->whereHas('roles')->with('institute:id,name', 'roles')
        ->whereNotIn('id', $data['accepted']->pluck('user_id'))
        ->whereNotIn('id', $data['rejected']->pluck('user_id'))
        ->select('id', 'name_en', 'institute_id')->orderBy('name_en')->get()->map(function ($item, $key) {
          $user = new stdClass();
          $user->id = $item->id;
          $user->name = $item->name_en;
          $user->name_bn = $item->name_bn;
          $user->role = $item->roles->first()?->name;
          $user->institute = $item->institute?->name;
          return $user;
        });

      $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
      $data['types'] = InstituteType::select('id', 'name')->orderby('name', 'asc')->get();

      return view('admin.training.approval.memberList', $data);
    }
    return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Training not found.');
  }


  public function addMemeberToTraining(Request $request, $id = null) {
    if (!($training = Training::find($id))) {
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Training not found.');
    }
//    return $request;
    foreach (User::whereIn('id', $request->members)->get() as $user) {
      TrainingMember::create([
        'training_id' => $training->id,
        'name' => $user->name_en,
        'email' => $user->email,
        'phone' => $user->phone,
        'user_id' => $user->id,
        'batch_approver_id' => \auth()->id(),
        'batch_approver_approve_at' => now(),
        'batch_approver_approve_status' => TrainingMember::$approvalArrays[0],
        'status' => TrainingMember::$statusArrays[1]
      ]);
      NotificationHelper::create(Notification::$types[0], $user->id, 'Training Application.', 'Your are selected to a training at ' . now()->format('h:i A F d,Y'));
    }

    return RedirectHelper::back('<strong>Congratulation!!! </strong> Process Successful.');
  }

  public function ajaxUpdateStatus(Request $request) {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $postStatus = $request->post('status');
      $status = strtolower($postStatus);
      $training = Training::find($id);
      if ($training->update(['status' => $status])) {
        return "success";
      }
    }
  }


  public function approvalMemberListUpdate(Request $request) {
    if ($training = Training::find($request->id)) {
      if ($request->has('accepted')) {
        if (\auth()->user()->hasRole('Batch Creator')) {
          TrainingMember::where('training_id', $training->id)->whereIn('id', $request->accepted)->update([
            'batch_creator_id' => \auth()->id(),
            'batch_creator_approve_at' => now(),
            'batch_creator_approve_status' => TrainingMember::$approvalArrays[0],
          ]);
          TrainingMember::where('training_id', $training->id)->whereIn('id', $request->rejected)->update([
            'batch_creator_id' => \auth()->id(),
            'batch_creator_approve_at' => now(),
            'batch_creator_approve_status' => TrainingMember::$approvalArrays[1],
          ]);
        } else {
          TrainingMember::where('training_id', $training->id)->whereIn('id', $request->accepted)->update([
            'batch_approver_id' => \auth()->id(),
            'batch_approver_approve_at' => now(),
            'batch_approver_approve_status' => TrainingMember::$approvalArrays[0],
            'status' => TrainingMember::$statusArrays[1]
          ]);
          TrainingMember::where('training_id', $training->id)->whereIn('id', $request->rejected)->update([
            'batch_approver_id' => \auth()->id(),
            'batch_approver_approve_at' => now(),
            'batch_approver_approve_status' => TrainingMember::$approvalArrays[1],
            'status' => TrainingMember::$statusArrays[2]
          ]);
        }
      } else {
        if (\auth()->user()->hasRole('Batch Creator')) {
          TrainingMember::where('training_id', $training->id)->whereIn('id', $request->rejected)->update([
            'batch_creator_id' => \auth()->id(),
            'batch_creator_approve_at' => now(),
            'batch_creator_approve_status' => TrainingMember::$approvalArrays[1],
          ]);
        } else {
          TrainingMember::where('training_id', $training->id)->whereIn('id', $request->rejected)->update([
            'batch_approver_id' => \auth()->id(),
            'batch_approver_approve_at' => now(),
            'batch_approver_approve_status' => TrainingMember::$approvalArrays[1],
            'status' => TrainingMember::$statusArrays[2]
          ]);
        }
      }
      return 'success';
    }
  }


//  public function approvalMemberListUpdate(Request $request) {
//    if ($training = Training::find($request->id)) {
//      if ($request->has('members')) {
////        if (\auth()->user()->hasRole('Batch Creator')) {
//        TrainingMember::where('training_id', $training->id)->whereIn('id', $request->members)->update(['status' => TrainingMember::$statusArrays[1]]);
//        TrainingMember::where('training_id', $training->id)->whereNotIn('id', $request->members)->update(['status' => TrainingMember::$statusArrays[2]]);
//      } else {
//        TrainingMember::where('training_id', $training->id)->update(['status' => TrainingMember::$statusArrays[2]]);
//      }
//      return 'success';
//    }
//  }


  public function approvalMemberUpdate($id, $status) {
//    if ($trainingMember = TrainingMember::find($id)) {
//      if ($status != TrainingMember::$statusArrays[1]) {
//        $status = TrainingMember::$statusArrays[2];
//      }
//      $trainingMember->status = $status;
//      $trainingMember->save();
//      return RedirectHelper::back('<strong>Congratulation!!! </strong> Process Successful.');
//    }

    if ($trainingMember = TrainingMember::find($id)) {
      if (\auth()->user()->hasRole('Batch Creator')) {
        $data = [
          'batch_creator_id' => \auth()->id(),
          'batch_creator_approve_at' => now(),
          'batch_creator_approve_status' => TrainingMember::$approvalArrays[0],
        ];
      } else {
        $data = [
          'batch_approver_id' => \auth()->id(),
          'batch_approver_approve_at' => now(),
          'batch_approver_approve_status' => TrainingMember::$approvalArrays[0],
          'status' => TrainingMember::$statusArrays[1]
        ];
      }
      if ($status != TrainingMember::$statusArrays[1]) {
        if (\auth()->user()->hasRole('Batch Creator')) {
          $data['batch_creator_approve_status'] = TrainingMember::$approvalArrays[1];
        } else {
          $data['batch_approver_approve_status'] = TrainingMember::$approvalArrays[1];
          $data['status'] = TrainingMember::$statusArrays[2];
        }
      }
      $trainingMember->update($data);
      return RedirectHelper::back('<strong>Congratulation!!! </strong> Process Successful.');
    }
  }


  public function applyListOfInstituteHead() {
    $usersIds = User::where('institute_id', \auth()->user()->institute_id)->pluck('id');
    $data['trainings'] = Training::whereHas('members', function ($q) use ($usersIds) {
      $q->whereIn('user_id', $usersIds);
    })->get();
    return view('admin.training.instituteHead.list', $data);
  }


  public function applyDetailsOfInstituteHead($id = null) {
    if ($training = Training::find($id)) {
      $usersIds = User::where('institute_id', \auth()->user()->institute_id)->pluck('id');
      $data['pendings'] = TrainingMember::where('training_id', $id)->whereNull('institute_head_approve_status')->whereIn('user_id', $usersIds)->get();
      $data['accepted'] = TrainingMember::where('training_id', $id)->whereIn('user_id', $usersIds)->where('status', TrainingMember::$statusArrays[1])->get();
      $data['rejected'] = TrainingMember::where('training_id', $id)->whereIn('user_id', $usersIds)->where('status', TrainingMember::$statusArrays[2])->get();
      $data['training'] = $training;
      return view('admin.training.instituteHead.memberList', $data);
    }
    return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Training not found.');
  }


  public function approvalMemberListUpdateInstituteHead(Request $request) {
    if ($training = Training::find($request->id)) {
      if ($request->has('accepted')) {
        TrainingMember::where('training_id', $training->id)->whereIn('id', $request->accepted)->update([
          'institute_head_id' => \auth()->id(),
          'institute_head_approve_at' => now(),
          'institute_head_approve_status' => TrainingMember::$approvalArrays[0],
        ]);
        TrainingMember::where('training_id', $training->id)->whereIn('id', $request->rejected)->update([
          'institute_head_id' => \auth()->id(),
          'institute_head_approve_at' => now(),
          'institute_head_approve_status' => TrainingMember::$approvalArrays[1],
        ]);
      } else {
        TrainingMember::where('training_id', $training->id)->whereIn('id', $request->rejected)->update([
          'institute_head_id' => \auth()->id(),
          'institute_head_approve_at' => now(),
          'institute_head_approve_status' => TrainingMember::$approvalArrays[1],
        ]);
      }
      return 'success';
    }
  }


  public function approvalMemberUpdateInstituteHead($id, $status) {
    if ($trainingMember = TrainingMember::find($id)) {
      $data = [
        'institute_head_id' => \auth()->id(),
        'institute_head_approve_at' => now(),
        'institute_head_approve_status' => TrainingMember::$approvalArrays[0],
      ];
      if ($status != TrainingMember::$statusArrays[1]) {
        $data['institute_head_approve_status'] = TrainingMember::$approvalArrays[1];
      }
      $trainingMember->update($data);
      return RedirectHelper::back('<strong>Congratulation!!! </strong> Process Successful.');
    }
  }
}
