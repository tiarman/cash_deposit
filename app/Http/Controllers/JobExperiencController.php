<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\Education;
use App\Models\JobExperience;
use App\Models\User;
use App\Rules\MaxWordsRule;
use App\Rules\MinWordsRule;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class JobExperiencController extends Controller
{
  public function index()
  {
    $data['datas'] = JobExperience::orderby('id', 'desc')->get();
    return view('admin.trainee.job_experience.list', $data);
  }


  public function create()
  {
    $data['job_experiences'] = JobExperience::where('user_id', auth()->user()->id)->get();
    return view('admin.trainee.job_experience.create', $data);
  }

  public function manage($id = null)
  {
    if ($data['job_experience'] = JobExperience::find($id)) {
      return view('admin.trainee.job_experience.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.trainee.job.experience.create', '<strong>Sorry!!!</strong> Job Experience not found');
  }

  public function store(Request $request)
  {
    $message = '<strong>Congratulations!!!</strong> Job Experience successfully ';
    $rules = [
      'start_date' => 'required|string|before:today',
      'end_date' => 'nullable',
      'organization_name' => 'required|string',
      'designation' => 'required|string',
      'role' => 'nullable', 'string', new MaxWordsRule(100), new MinWordsRule(2),
      'contact_name' => 'nullable|string',
      'contact_phone' => 'nullable|string|regex:' . CustomHelper::PhoneNoRegex,
      'contact_designation' => 'nullable|string',
      'contact_email' => 'nullable|string|email',
    ];
    if ($request->filled('end_date')) {
      $rules['start_date'] = 'required|string|before:end_date';
      $rules['end_date'] = 'required|string|after:start_date';
    }

    if ($request->has('id')) {
      $job_experience = JobExperience::find($request->id);
      $message = $message . ' updated';
    } else {
      $job_experience = new JobExperience();
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $job_experience->user_id = auth()->user()->id;
      $job_experience->organization_name = $request->organization_name;
      $job_experience->designation = $request->designation;
      $job_experience->start_date = $request->start_date;
      $job_experience->end_date = ($request->end_date !=null) ? $request->end_date : 'Running';
      $job_experience->role = $request->role;
      $job_experience->contact_name = $request->contact_name;
      $job_experience->contact_phone = $request->contact_phone;
      $job_experience->contact_designation = $request->contact_designation;
      $job_experience->contact_email = $request->contact_email;
      $job_experience->status = JobExperience::$statusArrays[0];
      if ($job_experience->save()) {

        return RedirectHelper::routeSuccess('admin.job.experience.create', $message);
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
      $job_experience = JobExperience::find($id);
      if ($job_experience->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}

