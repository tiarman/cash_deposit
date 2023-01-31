<?php

namespace App\Http\Controllers;

use App\Models\JobEvent;
use App\Models\PostHasStudent;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
  public function appliedList()
  {
    $data['datas'] = PostHasStudent::with('post')->where('student_id',auth()->user()->id)->orderby('id', 'desc')->get();
    return view('admin.graduate.job.list', $data);
  }
}
