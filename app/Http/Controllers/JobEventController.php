<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\IndustryPost;
use App\Models\JobEvent;
use App\Rules\MaxWordsRule;
use App\Rules\MinWordsRule;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class JobEventController extends Controller
{
  public function index()
  {
    $data['datas'] = JobEvent::orderby('id', 'desc')->get();
    return view('admin.event.job.list', $data);
  }

  public function posts($id = null)
  {
    $data['datas'] = IndustryPost::with('user')->where('job_event_id',$id)
      ->orderby('id', 'desc')->get();
    return view('admin.organizer.post', $data);
  }
  public function create()
  {
    $data['job_events'] = JobEvent::where('organizer_id', auth()->user()->id)->get();
    return view('admin.event.job.create', $data);
  }

  public function manage($id = null)
  {
    if ($data['job_event'] = JobEvent::find($id)) {
      return view('admin.event.job.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.event.job.create', '<strong>Sorry!!!</strong> Job Event not found');
  }

  public function store(Request $request)
  {
    $message = '<strong>Congratulations!!!</strong> Job Event successfully ';
    $rules = [
      'title' => 'required|string',
      'start_date' => 'required|string|before:today',
      'end_date' => 'nullable',
      'place' => 'nullable|string',
      'guest_no' => 'nullable|string',
      'event_details' => 'nullable|string',
      'guest_details' => 'nullable|string',
    ];
    if ($request->filled('end_date')) {
      $rules['start_date'] = 'required|string|before:end_date';
      $rules['end_date'] = 'required|string|after:start_date';
    }

    if ($request->has('id')) {
      $job_event = JobEvent::find($request->id);
      $message = $message . ' updated';
    } else {
      $job_event = new JobEvent();
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $job_event->organizer_id = auth()->user()->id;
      $job_event->title = $request->title;
      $job_event->place = $request->place;
      $job_event->start_date = $request->start_date;
      $job_event->end_date = ($request->end_date !=null) ? $request->end_date : 'Running';
      $job_event->guest_no = $request->guest_no;
      $job_event->event_details = $request->event_details;
      $job_event->guest_details = $request->guest_details;
      $job_event->status = JobEvent::$statusArrays[0];
      $oldImage = $job_event->image;
//      return $request;
      if($request->hasFile('image')){
        $logo = CustomHelper::storeImage($request->file('image'),'/JobEvent/');
        if( $logo != false){
          $job_event->image = $logo;
        }
      }
      if ($job_event->save()) {
        if($oldImage != null && $logo != null){
          CustomHelper::deleteFile($oldImage);
        }
        return RedirectHelper::routeSuccess('admin.event.job.create', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request)
  {
    $id = $request->post('id');
    try {
      $job_event = JobEvent::find($id);
      if ($job_event->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
  /**
   * @param Request $request
   * @return string|void
   */
  public function ajaxUpdateStatus(Request $request) {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $postStatus = $request->post('status');
      $status = strtolower($postStatus);
      $user = JobEvent::find($id);
      if ($user->update(['status' => $status])) {
        return "success";
      }
    }
  }
  public function ajaxPostUpdateStatus(Request $request) {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $postStatus = $request->post('status');
      $status = strtolower($postStatus);
      $user = IndustryPost::find($id);
      if ($user->update(['status' => $status])) {
        return "success";
      }
    }
  }
}
