<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\ProjectIdea;
use App\Models\ProjectIdeaFile;
use App\Models\ProjectIdeaMember;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ProjectIdeaController extends Controller
{

  public function index()
  {
    $data['users'] = User::where('institute_id',auth()->user()->institute_id)->whereHas('roles', function ($q){
      $q->where('name', 'Mentor');
    })->select('id','name_en')->get();
    $data['datas'] = ProjectIdea::orderby('title', 'desc')->get();
    return view('admin.projectIdea.list', $data);
  }

  public function indexMentor()
  {

    $data['users'] = User::where('institute_id',auth()->user()->institute_id)->where('trade_technology',auth()->user()->trade_technology)->whereHas('roles', function ($q){
       $q->where('name', 'Institute Head');
   })->select('id','name_en')->get();
       $data['datas'] = ProjectIdea::with('institute:id,name','user:id,institute_id,name_en')->where('institute_id',auth()->user()->institute_id)->select('title','institute_id','user_id','status','year')->whereHas('user',function ($query){
          $query->where('trade_technology',auth()->user()->trade_technology);
      })->get()->groupBy('year');
    return view('admin.projectIdea.list', $data);
  }

  public function indexHead()
  {

    $data['users'] = User::where('institute_id',auth()->user()->institute_id)->whereHas('roles', function ($q){
      $q->where('name', 'Pmu');
    })->select('id','name_en')->get();
        $data['datas'] = ProjectIdea::with('institute:id,name','user:id,institute_id,name_en')->where('institute_id',auth()->user()->institute_id)->select('title','institute_id','user_id','status','year')->where('hod_approval',1)->get()->groupBy('year');
    return view('admin.projectIdea.list', $data);
  }


  public function indexTeacher()
  {

    $data['users'] = User::where('institute_id',auth()->user()->institute_id)->whereHas('roles', function ($q){
      $q->where('name', 'Teacher');
    })->select('id','name_en')->get();
    $data['datas'] = ProjectIdea::orderby('title', 'desc')->where('institute_id',auth()->user()->institute_id)->get();
    return view('admin.projectIdea.list', $data);
  }


  public function create()
  {
      $prid = ProjectIdea::where('user_id',auth()->id())->where('year',date('Y'))->first();
      if ($prid){
          return RedirectHelper::success('admin.projectIdea.manage',[$prid->id],'<strong></strong>');
      }else{

          return view('admin.projectIdea.create');
      }
  }


  public function manage($id = null)
  {
    if ($data['projectIdea'] = ProjectIdea::find($id)) {
      $data['files'] = ProjectIdeaFile::where('project_idea_id', $id)->get();
      $data['projectIdeaMembers'] = ProjectIdeaMember::where('project_idea_id', $id)->get();
      return view('admin.projectIdea.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.projectIdea.create', '<strong>Sorry!!!</strong> Job Experience not found');
  }


  public function store(Request $request)
  {
//        return $request;
    $message = '<strong>Congratulations!!!</strong> Project Idea successfully ';
    $rules = [
      'title' => 'required|string',
      'title_bn' => 'nullable|string',
      'keyword' => 'required',
      'short_description' => 'required|string|max:60',
      'short_description_bn' => 'nullable|string|max:60',
      'description' => 'required|string|max:300',
      'description_bn' => 'nullable|string|max:300',
      'benefits' => 'required|string',
      'implementation_location' => 'required|string',
      'expenses' => 'required|string',
      'instrument_details' => 'required|string',
    ];
    if ($request->has('id')) {
      $idea = ProjectIdea::find($request->id);
      ProjectIdeaMember::where('project_idea_id', $request->id)->delete();
      $studentUpload = ProjectIdeaMember::find($request->id);

      $message = $message . ' updated';

    } else {
      $idea = new ProjectIdea();
      $studentUpload = new ProjectIdeaMember();
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $idea->user_id = auth()->id();
      $idea->institute_id = auth()->user()->institute_id;
      $idea->title = $request->title;
      $idea->title_bn = $request->title_bn;
      $idea->keyword = $request->keyword;
      $idea->short_description = $request->short_description;
      $idea->short_description_bn = $request->short_description_bn;
      $idea->description = $request->description;
      $idea->description_bn = $request->description_bn;
      $idea->benefits = $request->benefits;
      $idea->implementation_location = $request->implementation_location;
      $idea->expenses = $request->expenses;
      $idea->instrument_details = $request->instrument_details;
      $idea->status = ProjectIdea::$statusArrays[0];
      $idea->year = date('Y');
      if ($idea->save()) {
        $project_idea_id = $idea->id;
        if ($request->hasFile('image_upload')) {
          foreach ($request->file('image_upload') as $k => $file) {
            $file = CustomHelper::fileSystem($file, '/ProjectIdea/' . $project_idea_id . '/');
            if ($file) {
//              return $file;
              $fileUpload = new ProjectIdeaFile();
              $fileUpload->description = $request->image_filename[$k];
              $fileUpload->type = $request->image_type[$k];
              $fileUpload->size = $request->image_size[$k];
              $fileUpload->file = $file->path;
              $fileUpload->name = $file->name;
              $fileUpload->project_idea_id = $project_idea_id;
              $fileUpload->save();
            }
          }
        }
        if ($request->user_id) {

          foreach ($request->user_id as $key => $student) {
            if ($student) {
              $studentUpload = new ProjectIdeaMember();
              $studentUpload->user_id = $student;
              $studentUpload->type = ProjectIdeaMember::$memberTypeArrays[$key];
              $studentUpload->technology = $request->technology[$key];
              $studentUpload->semester = $request->semester[$key];
              $studentUpload->board_roll = $request->board_roll[$key];
              $studentUpload->project_idea_id = $project_idea_id;
              $studentUpload->save();
            }
          }
        }

        return RedirectHelper::routeSuccess('admin.projectIdea.list', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return $e;
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request)
  {
    $id = $request->post('id');
    try {
      $idea = ProjectIdea::find($id);
      if ($idea->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }

  public function fileDestroy($project_idea_id = null, $id = null)
  {
    if ($file = ProjectIdeaFile::where('id', $id)->where('project_idea_id', $project_idea_id)->first()) {
      $filePath = $file->file;
      if ($file->delete()) {
        CustomHelper::deleteFile($filePath);
        return RedirectHelper::back('<strong>Congratulation!!! </strong> File Successfully Deleted.');
      }
    }
    return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
  }

  public function hod_approval(Request $request)
  {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $user = ProjectIdea::find($id);
      $postStatus = $request->status;
      $user->hod_approval = $postStatus;
      $user->hod_approval_id = auth()->id();
      if ($user->save()) {
        if ($user->status === 1) {
          ProjectIdea::where('id', '!=', $user->id)->update(['status' => 0, 'hod_approval_id' => auth()->id()]);
        }
        return 'success';
      }
    }
  }


  public function vp_approval(Request $request)
  {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $user = ProjectIdea::find($id);
      $postStatus = $request->status;
      $user->vp_approval_id = auth()->id();
      $user->vp_approval = $postStatus;
      if ($user->save()) {
        if ($user->status === 1) {
          ProjectIdea::where('id', '!=', $user->id)->update(['status' => 0, 'vp_approval_id' => auth()->id()]);
        }
        return 'success';
      }
    }
  }


  public function p_approval(Request $request)
  {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $user = ProjectIdea::find($id);
      $postStatus = $request->status;
      $user->p_approval = $postStatus;
      $user->p_approval_id = auth()->id();
      if ($user->save()) {
        if ($user->status === 1) {
          ProjectIdea::where('id', '!=', $user->id)->update(['status' => 0, 'p_approval_id' => auth()->id()]);
        }
        return 'success';
      }
    }
  }

  public function pmu_approval(Request $request)
  {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $user = ProjectIdea::find($id);
      $postStatus = $request->status;
      $user->pmu_approval = $postStatus;
      $user->pmu_approval_id = auth()->id();
      if ($user->save()) {
        if ($user->status === 1) {
          ProjectIdea::where('id', '!=', $user->id)->update(['status' => 0, 'pmu_approval_id' => auth()->id()]);
        }
        return 'success';
      }
    }
  }



      public function ajaxUpdateStatus(Request $request) {
      if ($request->isMethod("POST")) {
          $id = $request->post('id');
          $postStatus = $request->post('status');
          $status = strtolower($postStatus);
          $fiscalYear = ProjectIdea::find($id);
          if ($fiscalYear->update(['status' => $status])) {
              if ($fiscalYear->status === ProjectIdea::$statusArrays[1]){
                  ProjectIdea::where('id', '!=', $fiscalYear->id)->update(['status'=>ProjectIdea::$statusArrays[0]]);
              }
              return 'success';
          }
      }
  }

      public function ajaxUpdateForeword(Request $request)
  {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      if ($request->button_name == 'status_foreword_list') {
        foreach ($id as $value) {
          $user = ProjectIdea::find($value);
          if(auth()->user()->hasRole('Super Admin')){
            $user->pmu_approval =1;
            $user->pmu_approval_id = auth()->id();
          }elseif(auth()->user()->hasRole('Institute Head')){
            $user->hod_approval =1;
            $user->hod_approval_id = auth()->id();
          }elseif(auth()->user()->hasRole('Teacher')){
            $user->p_approval =1;
            $user->p_approval_id = auth()->id();
          } elseif(auth()->user()->hasRole('Student')){
            $user->vp_approval =1;
            $user->vp_approval_id = auth()->id();
          }
          $user->save();
        }
      }

    }
  }
 public function view($id)
 {
     $data['projectIdea'] = ProjectIdea::with('files')->where('id',$id)->first();
     return view('admin.projectIdea.view',$data);
 }

  public function ajaxprojectIdeaStudent(Request $request)
  {
    if ($data = User::where('name_en', 'LIKE', '%' . $request->name . '%')->first()) {
      return $data->prefix;
    }
  }
}
