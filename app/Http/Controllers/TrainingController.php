<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\NotificationHelper;
use App\Helper\RedirectHelper;
use App\Models\Component;
use App\Models\Country;
use App\Models\InstituteType;
use App\Models\District;
use App\Models\Division;
use App\Models\Institute;
use App\Models\Notification;
use App\Models\Training;
use App\Models\TrainingBatch;
use App\Models\TrainingFile;
use App\Models\TrainingMember;
use App\Models\TrainingType;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Sabberworm\CSS\Rule\Rule;
use function PHPUnit\Framework\at;

class TrainingController extends Controller {


  public function myTrainings() {
    $data['datas'] = TrainingMember::with('training.institute')->where('user_id', \auth()->id())->orderby('id', 'desc')->get();
    return view('admin.training.self.index', $data);
  }


  public function myTrainingWithdraw($id = null) {
    if ($tr = TrainingMember::where('user_id', \auth()->id())->where('id', $id)->first()) {
      $tr->delete();
      NotificationHelper::create(Notification::$types[0], \auth()->id(), 'Withdraw Application.', 'Withdraw Successfully at' . now()->format('h:i A F d,Y'));
      return RedirectHelper::back('<strong>Congratulation!!! </strong> Withdraw Successful.');
    }
    return RedirectHelper::backWithWarning();
  }

  public function index() {
    if (\App\Helper\CustomHelper::canView('', 'Super Admin')) {
      $data['datas'] = Training::withCount('members')->with('district:id,name', 'institute:id,name')->orderby('title', 'desc')->get();
    } else {
      $data['datas'] = Training::withCount('members')->with('district:id,name', 'institute:id,name')->where('institute_id', auth()->user()->institute_id)->orderby('title', 'desc')->get();
    }

    return view('admin.training.list', $data);
  }

  public function create() {
    if (!($institute = Institute::with('members:id,institute_id,name_en')->where('institute_head_id', Auth::user()->id)->first())) {
      return redirect()->back();
    }
    $data['institute'] = $institute;
    $data['institutes'] = Institute::where('status', Institute::$statusArrays[1])->where('institute_type_id',1)->get();
    $data['countries'] = Country::select('id', 'name')->orderBy('name')->get();

    $data['batchcreators'] = User::whereHas('roles', function ($q) {
      $q->where('name', 'Batch Creator');
    })->select('id', 'name_en')->orderBy('name_en')->get();
    $data['batchapprovers'] = User::whereHas('roles', function ($q) {
      $q->whereIn('name', ['Batch Approver', 'Super Admin']);
    })->select('id', 'name_en')->orderBy('name_en')->get();

    $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
    $data['instituteTypes'] = InstituteType::select('id', 'name')->orderBy('name')->get();
    $data['trainingtype'] = TrainingType::select('id', 'name')->orderBy('name')->get();
    $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderBy('name')->get();
    return view('admin.training.create', $data);
  }

  public function manage($id = null) {
    if ($data['training'] = Training::with('participants')->find($id)) {
      $data['institute'] = Institute::with('members:id,institute_id,name_en')->where('institute_head_id', Auth::user()->id)->first();
      $data['institutes'] = Institute::where('status', Institute::$statusArrays[1])->where('institute_type_id',1)->get();

      $data['countries'] = Country::select('id', 'name')->orderBy('name')->get();
      $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
      $data['instituteTypes'] = InstituteType::select('id', 'name')->orderBy('name')->get();
      $data['trainingtype'] = TrainingType::select('id', 'name')->orderBy('id')->get();
      $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
      $data['upazilas'] = Upazila::select('id', 'name')->orderBy('name')->get();

      $data['batchcreators'] = User::whereHas('roles', function ($q) {
        $q->where('name', 'Batch Creator');
      })->select('id', 'name_en')->orderBy('name_en')->get();
      $data['batchapprovers'] = User::whereHas('roles', function ($q) {
        $q->whereIn('name', ['Batch Approver', 'Super Admin']);
      })->select('id', 'name_en')->orderBy('name_en')->get();


      $data['training_file'] = TrainingFile::where('training_id', $id)->get();
      return view('admin.training.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.training.list', '<strong>Sorry!!!</strong> Training not found');
  }


  public function makeCompleted($id = null) {
    if ($training = Training::find($id)) {
      $training->status = Training::$statusArrays[3];
      $training->save();
      return RedirectHelper::back('<strong>Congratulation!!! </strong> Training Successful Completed.');
    }
    return RedirectHelper::routeWarning('admin.training.list', '<strong>Sorry!!!</strong> Training not found');
  }

  public function view($id = null) {
    if ($data['training'] = Training::find($id)) {
      $data['accepted'] = TrainingMember::with('user:id,institute_id', 'user.institute:id,name')->where('training_id', $id)->where('status', TrainingMember::$statusArrays[1])->get();
      $data['rejected'] = TrainingMember::with('user:id,institute_id', 'user.institute:id,name')->where('training_id', $id)->where('status', TrainingMember::$statusArrays[2])->get();
      return view('admin.training.view', $data);
    }
    return RedirectHelper::routeWarning('admin.training.list', '<strong>Sorry!!!</strong> Training not found');
  }

  public function store(Request $request) {
//      return $request;
    $message = '<strong>Congratulations!!!</strong> Training successfully ';
    $institute = Institute::where('institute_head_id', Auth::user()->id)->first();

    $rules['title'] = 'required|string|max:255';
    $rules['technology'] = 'required|string|max:255';
    $rules['type_id'] = 'required|numeric';
    $rules['country_id'] = 'required|numeric|exists:' . with(new Country)->getTable() . ',id';
    $rules['division_id'] = 'required|numeric|exists:' . with(new Division)->getTable() . ',id';
    $rules['district_id'] = 'required|numeric|exists:' . with(new District)->getTable() . ',id';
    $rules['participants'] = 'required';
    $rules['participant_limit'] = 'nullable|numeric';
    $rules['start_date'] = 'required|date';
    $rules['end_date'] = 'date|after_or_equal:start_date';

    if ($request->has('id')) {
      $training = Training::find($request->id);
      $message = $message . ' updated';
    } else {
      $training = new Training();
      $message = $message . ' created';
    }
    $request->validate($rules);
    DB::beginTransaction();
    try {

      $training->user_id = Auth::user()->id;
      $training->institute_id = $request->institute_id;
      $training->type_id = $request->type_id;
      $training->country_id = $request->country_id;
      $training->division_id = $request->division_id;
      $training->district_id = $request->district_id;
      $training->title = $request->title;
      $training->technology = $request->technology;
      $training->participation = $request->participation ?? Training::$participationArrays[0];
      $training->participant_limit = $request->participant_limit;
      $training->start_date = $request->start_date;
      $training->end_date = $request->end_date;
      $training->description = $request->description;
      $training->batch_creator_id = $request->batch_creator_id;
      $training->batch_approver_id = $request->batch_approver_id;
      if (Auth::user()->hasRole('Super Admin')) {
        $training->status = Training::$statusArrays[1];
      } else {
        $training->status = Training::$statusArrays[0];
      }

      if ($training->save()) {
        $training->participants()->sync($request->participants);

        if ($request->hasFile('image_upload')) {
          foreach ($request->file('image_upload') as $k => $file) {
            $file = CustomHelper::storeImage($file, '/Training/' . $training->id . '/');
            if ($file) {
              $fileUpload = new TrainingFile();
              $fileUpload->description = $request->image_filename[$k];
              $fileUpload->type = $request->image_type[$k];
              $fileUpload->size = $request->image_size[$k];
              $fileUpload->file = $file;
              $fileUpload->training_id = $training->id;
              $fileUpload->save();
            }
          }
        }
        DB::commit();
        return RedirectHelper::routeSuccess('admin.training.list', $message);
      }
      DB::rollBack();
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      DB::rollBack();
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request, $trainin_id = null) {

    $id = $request->post('id');
    try {
      $training = Training::find($id);
      response($training);
      if ($training->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }

  public function batchStore(Request $request) {
    DB::beginTransaction();
    $batch = new TrainingBatch();
    $batch->user_id = \auth()->id();
    $batch->training_id = $request->id;
    $batch->name = $request->name;
    if ($batch->save()) {
      TrainingMember::whereIn('id', $request->members)->update(['batch_id' => $batch->id]);
      DB::commit();
      return RedirectHelper::back('<strong>Congratulation!!! </strong> Batch create Successful.');
    }
    DB::rollBack();
    return RedirectHelper::backWithInput('<strong>Sorry!!! </strong> Action not completed.');
  }


  /**
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function trainingFileDelete($trainingId = null, $id = null): \Illuminate\Http\RedirectResponse {
    if ($file = TrainingFile::where('id', $id)->where('training_id', $trainingId)->first()) {
      $filePath = $file->file;
      if ($file->delete()) {
        CustomHelper::deleteFile($filePath);
        return RedirectHelper::back('<strong>Congratulation!!! </strong> File Successfully Deleted.');
      }
    }
    return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
  }

}
