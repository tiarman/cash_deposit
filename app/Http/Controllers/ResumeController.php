<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\District;
use App\Models\Division;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Technology;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ResumeController extends Controller
{
  public function registrationInfo() {
    $data['divisions'] = Division::Select('name', 'id')->orderby('name', 'asc')->get();
    $data['districts'] = District::Select('name', 'id')->orderby('name', 'asc')->get();
    $data['semesters'] = Semester::select('id', 'name')->orderby('id', 'asc')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderby('name', 'asc')->get();
    $data['trades'] = Technology::select('id', 'name')->orderby('name', 'asc')->get();
    $data['shifts'] = Shift::select('id', 'name')->get();
    return view('admin.resume.index', $data);
  }
//  public function registrationInfoUpdate(Request $request) {
////   return $request;
//    $request->validate([
////      'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,' . auth()->id(),
//      'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,' . auth()->id(),
//      'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,
//      'name_en' => 'required|string',
////      'name_bn' => 'nullable|string',
//      'address' => 'nullable|string',
////      'father_name' => 'nullable|string',
////      'mother_name' => 'nullable|string',
////      'email' => 'required|unique:' . with(new User)->getTable() . ',email,',
////      'phone' => 'required|unique:' . with(new User)->getTable() . ',phone,',
//      'nid ' => 'nullable|unique:' . with(new User)->getTable() . ',nid,',
//      'session ' => 'nullable|date',
////      'alt_phone' => 'nullable|string|regex:' . CustomHelper::PhoneNoRegex,
//      'board_roll' => 'nullable|string',
//      'admission_year' => 'nullable|string',
//      'running_board_roll' => 'nullable|string',
//      'birth_certificate' => 'nullable|string',
////      'employment_status' => 'nullable|string',
////      'employing_company' => 'nullable|string',
////      'cv' => 'nullable'
//
//    ]);
////    return $request->all();
//
////    $data = $request->only(['email', 'phone', 'name_en', 'address', 'session', 'board_roll', 'nid', 'birth_certificate', 'admission_year', 'running_board_roll','profile_photo','employment_status','employing_company','cv']);
////    $data = $request->only(['email', 'phone', 'name_en', 'address', 'session', 'board_roll', 'nid', 'birth_certificate', 'admission_year', 'running_board_roll']);
////    return $data;
//    $user = User::where('id', auth()->user()->id);
//
//
//    try {
//      $user->email = $request->email;
//      $user->phone = $request->phone;
//      $user->name_en = $request->name_en;
//      $user->address = $request->address;
//      $user->session = $request->s_session;
//      $user->board_roll = $request->board_roll;
//      $user->running_board_roll = $request->running_board_roll;
//      $user->admission_year = $request->admission_year;
//      $user->nid = $request->nid;
//      $user->birth_certificate = $request->birth_certificate;
////      $user->profile_photo = $request->profile_photo;
//      $old_photo = $user->photo;
//      if ($request->hasFile('photo')) {
//        $logo = CustomHelper::storeImage($request->file('photo'), '/profile/');
//        if ($logo != false) {
//          $user->photo = $logo;
//        }
//      }
//      if ($user->update()) {
//        if ($old_photo != $user->photo) {
//          CustomHelper::deleteFile($old_photo);
//        }
//        return RedirectHelper::back('<strong>Congratulation!!! </strong> Profile Updated.');
//      }
//    } catch (\Exception $e) {
//      return $e;
//    }
//    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
//                <strong>Congratulation !!!</strong> Profile updated.
//                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                  <span aria-hidden="true">&times;</span>
//                </button>
//            </div>';
//    return redirect()->back()->with('updateProfile', $status);
//  }
//}

  public function registrationInfoUpdate(Request $request) {

    $request->validate([
//      'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,' . auth()->id(),
      'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,' . auth()->id(),
      'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,
      'name_en' => 'required|string',
//      'name_bn' => 'nullable|string',
      'address' => 'nullable|string',
//      'father_name' => 'nullable|string',
//      'mother_name' => 'nullable|string',
//      'email' => 'required|unique:' . with(new User)->getTable() . ',email,',
//      'phone' => 'required|unique:' . with(new User)->getTable() . ',phone,',
      'nid ' => 'nullable|unique:' . with(new User)->getTable() . ',nid,',
      'session ' => 'nullable|date',
//      'alt_phone' => 'nullable|string|regex:' . CustomHelper::PhoneNoRegex,
      'board_roll' => 'nullable|string',
      'admission_year' => 'nullable|string',
      'running_board_roll' => 'nullable|string',
      'birth_certificate' => 'nullable|string',
      'employment_status' => 'nullable|string',
      'employing_company' => 'nullable|string',
      'cv' => 'nullable'

    ]);

    $user = User::where('id', auth()->user()->id)->first();
//    return $user;

    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->semester_id = $request->semester_id;
    $user->shift_id = $request->shift_id;
    $user->trade_technology_id = $request->trade_technology_id;
    $user->year = $request->year;
    $user->name_en = $request->name_en;
    $user->address = $request->address;
    $user->session = $request->s_session;
    $user->board_roll = $request->board_roll;
    $user->running_board_roll = $request->running_board_roll;
    $user->admission_year = $request->admission_year;
    $user->nid = $request->nid;
    $user->birth_certificate = $request->birth_certificate;
    $user->employing_company = $request->employing_company;
    $user->employment_status = $request->employment_status;
    $user->father_name = $request->father_name;
    $user->mother_name = $request->mother_name;
    $user->gender = $request->gender;
    $user->blood_group = $request->blood_group;
    $user->marital_status = $request->marital_status;
    $user->religion = $request->religion;

    $old_photo = $user->photo;
    if ($request->hasFile('photo')) {
      $logo = CustomHelper::storeImage($request->file('photo'), '/Student/');
      if ($logo != false) {
        $user->image = $logo;
      }
    }

//  $user->cv = $request->cv;

    $old_cv = $user->cv;
    if ($request->hasFile('cv')) {
      $cvv = CustomHelper::storeImage($request->file('cv'), '/CV/');
      if ($cvv != false) {
        $user->cv = $cvv;
      }
    }
    try {
      if ($user->update()) {
        if ($old_photo != $user->image) {
          CustomHelper::deleteFile($old_photo);
        }
        if ($old_cv != $user->cv) {
          CustomHelper::deleteFile($old_cv);
        }
        return RedirectHelper::back('<strong>Congratulation!!! </strong> Registration Information Updated.');
      }
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Update not possible.');
    } catch (\Exception $e) {
      return $e;
    }
    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                <strong>Congratulation !!!</strong> Profile updated.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    return redirect()->back()->with('updateProfile', $status);
  }}
