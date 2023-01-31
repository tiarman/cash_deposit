<?php

namespace App\Http\Controllers;

use App\Mail\SendDemoMail;
use App\Models\PostHasStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmployerController extends Controller
{
  public function applicationList($id = null)
  {
    $data['graduate'] = PostHasStudent::with('graduate')->where('post_id',$id)->get();
    return view('admin.job.application.list', $data);
  }
  public function ajaxUpdatejobApplicantStatus(Request $request)
  {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $postStatus = $request->post('status');
      $status = strtolower($postStatus);
      $poststudent = PostHasStudent::find($id);
//      $user = User::where('')
//      return $status;
//      if (($type !== GroupUser::$typeArray[2]) && GroupUser::where('type', $type)->where('group_id', $groupuser->group_id)->where('id', '!=', $id)->first()) {
//        return 'exist';
//      }
      if ($poststudent->update(['status' => $status])) {
        return "success";
      }
    }
  }

  public function ajaxSendMail(Request $request){


    $graduate = PostHasStudent::find($request->id);
    $user = User::where('id',$graduate->student_id)->get()->first();

    $email = $user->email;

    $maildata = [
      'title' => 'Laravel Mail Sending Example with Markdown',
      'url' => 'https://www.positronx.io'
    ];

    Mail::to($email)->send(new SendDemoMail($maildata));

    return "success";

    echo "Mail has been sent successfully". $user->email;

    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $postStatus = $request->post('status');
      $status = strtolower($postStatus);
      $poststudent = PostHasStudent::find($id);
      if ($poststudent->update(['status' => $status])) {
        return "success";
      }
    }

  }

}
