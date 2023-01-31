<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\NotificationHelper;
use App\Helper\RedirectHelper;
use App\Models\BackgroundImage;
use App\Models\CoreModule;
use App\Models\District;
use App\Models\Division;
use App\Models\IndustryPost;
use App\Models\Institute;
use App\Models\JobEvent;
use App\Models\jobFairHasParticipant;
use App\Models\Notification;
use App\Models\PostHasStudent;
use App\Models\Training;
use App\Models\TrainingFile;
use App\Models\TrainingMember;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SiteController extends Controller
{

  public function instituteTrainingList($id)
  {
    $today = (date('Y-m-d'));
    $today = date('Y-m-d', strtotime($today . ' +1 day'));
    $data['institute'] = Institute::find(request('id'));
    $data['datas'] = Training::where('institute_id', $id)->where('start_date', '>=', $today)->where('status', Training::$statusArrays[1])->orderBy('title', 'asc')->get();

    return view('site.institute-trainingsList', $data);
  }


// Training list
  public function indexTrainingList(Request $request)
  {
    $today = (date('Y-m-d'));
    $tomorrow = date('Y-m-d', strtotime($today . ' +1 day'));
    $data['institutes'] = Institute::whereHas('trainings', function ($q) use ($tomorrow) {
      $q->where('start_date', '>=', $tomorrow)->where('status', Training::$statusArrays[1]);
    })->withCount('trainings')->orderBy('name')->get();

    $data['trainings'] = Training::where('start_date', '>=', $tomorrow)->where('status', Training::$statusArrays[1])->orderBy('title', 'asc')->get();
    $data['upcomings'] = Training::where('start_date', '>=', $tomorrow)->where('status', Training::$statusArrays[1])->orderBy('title', 'asc')->get();
    $data['runnings'] = Training::where('start_date', '<=', $today)->where('end_date', '>=', $today)->where('status', Training::$statusArrays[1])->orderBy('title', 'asc')->get();
    $data['previouses'] = Training::where('end_date', '<', $today)->where('status', Training::$statusArrays[1])->orderBy('title', 'asc')->get();
    return view('site.trainingsList', $data);
  }

  // Training Member Form
  public function trainingDetails()
  {

    $data['training'] = Training::withCount('members')->with('institute.instituteHead', 'members')->where('id', \request('training_id'))->first();

    return view('site.training-details', $data);
  }

// training member store
  public function storeTrainingMember(Request $request, $trainingId)
  {
    $message = '<strong>Congratulations!!!</strong> Component successfully ';
    $rules = [
//            'user_id' => 'required|unique:'. with(new TrainingMember())->getTable() . 'user_id,training_id.'.$trainingId,
    ];
    $request->validate($rules);
    try {
      $trainingMember = new TrainingMember();
      $trainingMember->training_id = $trainingId;
      $trainingMember->user_id = auth()->id();
      $trainingMember->name = auth()->user()->name_en ?? auth()->user()->username;
      $trainingMember->email = auth()->user()->email;
      $trainingMember->phone = auth()->user()->phone;

      if ($trainingMember->save()) {
        $message = '<strong>Congratulations!!! Successfully Submitted.</strong>';
        NotificationHelper::create(Notification::$types[0], auth()->id(), 'Training Application.', 'Your application is submitted at ' . now()->format('h:i A F d,Y'));
        return RedirectHelper::routeSuccessWithParams('institute.trainings.details', $message, [$trainingId]);
      }
      return RedirectHelper::backWithInput();

    } catch (Exception $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function enrollTrainingList()
  {
    $data['trainings'] = TrainingMember::with('training.institute:name,id,photo')->where('user_id', auth()->id())->get();

    return view('site.enrollTrainingList', $data);
  }

  public function instituteRegistration()
  {
    $data['divisions'] = Division::get();
    $data['districts'] = District::get();
    return view('site.institute', $data);
  }


  public function cancelTrainingRequest($id)
  {
    try {
      $trainingMember = TrainingMember::find($id);
      if ($trainingMember->delete()) {
        return RedirectHelper::backWithInput();
      }
    } catch (\Exception $e) {
    }
  }

  public function home()
  {
    $data['core'] = CoreModule::where('status', '=', CoreModule::$statusArrays[0])->get();
      $data['numberofstudents'] = User::with('roles')->whereHas('roles', function ($q){
          $q->where('name', 'Student');
      })->get()->count();
      $data['numberofindustries'] = User::with('roles')->whereHas('roles', function ($q){
          $q->where('name', 'Industry');
      })->get()->count();
      $data['numberoffair'] = JobEvent::get()->count();
      $data['numberofjobs'] = IndustryPost::get()->count();
//      return $datas;
    return view('site.index', $data);
  }

  public function indexJobEvent()
  {
    // ini_set('memory_limit', '64M');
    $data['job_events'] = JobEvent::with('institute')->where('status', '=', JobEvent::$statusArrays[1])->get();
    $user = auth()->id();
    $data['participant'] = jobFairHasParticipant::where('participant_id',$user)->get();
    $data['count'] = count($data['participant']);
    // return $data;
    return view('site.job.jobFairList', $data);
  }

  public function jobEventApply(Request $request){
    if(!auth()->user()){
      return json_encode(400);
    }
    if( jobFairHasParticipant::where('participant_id',auth()->id())->where('job_event_id',$request->id)->first()){
      // return json_encode("Joined");
  }
  else{
    $jobFairApply = new jobFairHasParticipant();
    $jobFairApply->job_event_id = $request->id;
    $jobFairApply->participant_id	 = auth()->id();
    $jobFairApply->status	 = jobFairHasParticipant::$status[0];
    if($jobFairApply->save()){
      return json_encode("Applied");
    }
  }
  }

  public function jobEvent($id = null)
  {
    $data['job_event'] = JobEvent::with('institute')->find($id);
    return view('site.job.jobFairDetails', $data);
  }

  public function industryPost($id = null)
  {
    $data['industry_posts'] = IndustryPost::with('user')->where('job_event_id', $id)->orderby('id', 'desc')->get();
//    return $data;
    return view('site.job.jobs', $data);
  }


  public function jobpost()
  {
    $data['jobpost'] = IndustryPost::where('status', '=', IndustryPost::$statusArrays[1])->get();
//     return $data;
    return view('site.job.jobpost', $data);
  }

  public function job_post_details($id = null)
  {
      if ($data['job_post_details'] = IndustryPost::where('status', IndustryPost::$statusArrays[1])->find($id)) {
        $data['IsApplied'] = 0;
        if(auth()->user()) {
          if (PostHasStudent::where('student_id', auth()->user()->id)->first()) {
            $data['IsApplied'] = 1;
          }
        }
        return view('site.job.jobPostDetails', $data);
      }
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Post not found.');
  }

  public function graduateList()
  {
    $data['graduates'] = User::with('roles')->whereHas('roles', function ($q){
      $q->where('name', 'Student');
    })->get();
    return view('site.graduateList', $data);
  }
  public function graduateInfo($id = null)
  {
    if ($data['graduate'] = User::with('roles')->whereHas('roles', function ($q){
      $q->where('name', 'Student');
    })->where('status', User::$statusArrays[1])->find($id)) {
//      return $data;
      return view('site.graduateInfo', $data);
    }
    return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Graduate Info not found.');
  }

  public function postApply(Request $request) {
    if ($request->isMethod("POST")) {
      $postAdd = new PostHasStudent();
      $postAdd->post_id = $request->id;
      $postAdd->student_id = auth()->user()->id;
      if ($postAdd->save()) {
        return "success";
      }
    }
  }


}
