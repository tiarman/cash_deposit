<?php

namespace App\Http\Controllers\Institute;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstituteController extends Controller {

  public function index() {
    $data['datas'] = Institute::with('idg:id,institute_id,status', 'rpl:id,institute_id,status', 'sc:id,institute_id,status', 'district:id,name', 'division:id,name', 'type:id,name')->orderby('id', 'desc')->paginate(100);
//    return $data;
    return view('admin.institute.list', $data);
  }
  public function create() {
    $data['users'] = User::whereHas('roles', function ($q) {
      $q->where('name', 'Institute Head');
    })->whereNull('institute_id')->select('id', 'name_en as name')->get();
    $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
    $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderBy('name')->get();
    $data['types'] = InstituteType::select('id', 'name')->orderBy('name')->get();
//    return $data;
    return view('admin.institute.create', $data);
  }


  public function manage($id = null) {
//      $data['users'] = User::with('institute:id,name')->select('id', 'name_en','institute_id')->orderBy('id')->get();
    $data['users'] = User::whereHas('roles', function ($q) {
      $q->where('name', 'Institute Head');
    })->whereNull('institute_id')->select('id', 'name_en as name')->get();
    if ($data['institute'] = Institute::with('instituteHead:id,name_en')->find($id)) {
      $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
      $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
      $data['upazilas'] = Upazila::select('id', 'name')->orderBy('name')->get();
      $data['types'] = InstituteType::select('id', 'name')->orderBy('name')->get();
      return view('admin.institute.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.institute.list', '<strong>Sorry!!!</strong> Institute not found');
  }


  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> Institute successfully ';

    $rules = [
      'division_id' => 'required',
      'district_id' => 'required',
      'address' => 'required',

    ];

    if ($request->has('id')) {
//        photo,
      $institute = Institute::find($request->id);
//      institute
      if (User::where('phone', $request->phone)->first() != NULL) {
        $rules['institute_head_id'] = 'required|string|string:' . with(new Institute)->getTable() . ',name,' . $request->id;
      }
      $rules['institute_name'] = 'required|string|string|unique:' . with(new Institute)->getTable() . ',name,' . $request->id;
//            $rules['photo'] = 'required|string|string|:' . with(new Institute)->getTable() . ',name,' . $request->id;
      $rules['institute_phone'] = 'required|max:11|min:11|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new Institute)->getTable() . ',phone,' . $request->id;
      $rules['institute_email'] = 'required|email|unique:' . with(new Institute)->getTable() . ',email,' . $request->id;
      $rules['photo'] = 'nullable|file|mimes:png,jpg,jpeg,svg:' . with(new Institute)->getTable() . ',name,' . $request->id;
      $message = $message . ' updated';

    } else {
      $institute = new Institute();
      $user = new user();
      //        user table
      $rules['name_en'] = 'required|string';
      $rules['name_bn'] = 'string|nullable';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      if ($request->filled('created_user')) {
        $rules['username'] .= $request->created_user;
      }
      if ($request->filled('created_user')) {
        $rules['password'] = 'nullable';
      } else {
        $rules['password'] = 'required|string|min:' . User::$minimumPasswordLength;
      }
      $rules['phone'] = 'required|max:11|min:11|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      if ($request->filled('created_user')) {
        $rules['phone'] .= $request->created_user;
      }
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      if ($request->filled('created_user')) {
        $rules['email'] .= $request->created_user;
      }
      //      institute
      $rules['code'] = 'required|min:7|max:7';
      $rules['institute_name'] = 'required|string|unique:' . with(new Institute)->getTable() . ',name';
      $rules['institute_name_bn'] = 'string|unique:' . with(new Institute)->getTable() . ',name';
      $rules['photo'] = 'nullable|file|mimes:png,jpg,jpeg,svg';
      $rules['institute_phone'] = 'required|max:11|min:11|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new Institute)->getTable() . ',phone,';
      $rules['institute_email'] = 'required|email|unique:' . with(new Institute)->getTable() . ',email,';
      $message = $message . ' created';

    }
    $request->validate($rules);

    DB::beginTransaction();
    try {
      if (!$request->has('id')) {
        if (User::where('phone', $request->phone)->first() == NULL) {
          $user->username = $request->username;
          $user->name_en = $request->name_en;
          $user->name_bn = $request->name_bn;
          $user->phone = $request->phone;
          $user->email = $request->email;
          $user->password = bcrypt($request->password);
          $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
          $user->assignRole('Institute Head');
          if ($request->hasFile('user_image')) {
            $logo = CustomHelper::storeImage($request->file('user_image'), '/users/');
            if ($logo != false) {
              $user->profile_photo_path = $logo;
            }
          }
          if ($user->save()) {
            $userid = $user->id;
          }
        } else {
          $user->assignRole('Institute Head');
          $user = User::find($request->created_user);
          if ($user->save()) {
            $userid = $user->id;
          }
        }
      }
      $institute->code = $request->code;
      $institute->name = $request->institute_name;
      $institute->name_bn = $request->institute_name_bn;
      $institute->phone = $request->institute_phone;
      $institute->photo = $request->photo;
//            $oldImage = $institute->photo;
      if ($request->hasFile('photo')) {
        $logo = CustomHelper::storeImage($request->file('photo'), '/institute/');
        if ($logo != false) {
          $institute->photo = $logo;
        }
      }
      $institute->email = $request->institute_email;
      if (!$request->has('id')) {
        $institute->institute_head_id = $userid;
      }
      $institute->division_id = $request->division_id;
      $institute->district_id = $request->district_id;
      $institute->upazila_id = $request->upazila_id;
      $institute->address = $request->address;
      $institute->description = $request->description;

      $institute->status = isset($request->institute_status) ? $request->institute_status : \App\Models\User::$statusArrays[0];
      $institute->institute_type_id = $request->institute_type_id;
      if ($request->has('id')) {
        $user = User::find($institute->institute_head_id);
        $user->institute_id = null;
        $user->save();
        $user = User::find($request->created_user);
        $user->institute_id = $institute->id;
        $user->save();

        $institute->institute_head_id = $request->created_user;
        if (!$request->hasFile('photo')) {
          $institute->photo = $request->old_photo;
        } else {
          CustomHelper::deleteFile($request->old_photo);
        }

      }
      if ($institute->save()) {
//                if ($oldPhoto !== null && isset($logo)) {
//                    CustomHelper::deleteFile($oldPhoto);
//                }
        if (!$request->has('id')) {
          $user = User::find($userid);
          $user->institute_id = $institute->id;
          $user->save();
        }
        if ($request->has('public-form')) {
          DB::commit();
          return RedirectHelper::routeSuccess('institute.form', $message);
        } else {
          DB::commit();
          return RedirectHelper::routeSuccess('admin.institute.list', $message);
        }
      }
      DB::rollBack();
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
//        return $e;
      DB::rollBack();
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {

      $institute = Institute::find($id);
      $user = User::find($institute->institute_head_id);
      $user->institute_id = null;
      $user->save();

      if ($institute->delete()) {
        if ($institute !== null) {
          CustomHelper::deleteFile($institute->photo);
        }
        return 'success';
      }

    } catch (\Exception $e) {

    }


  }

  public function ajaxUpdateStatus(Request $request) {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $postStatus = $request->post('status');
      $status = strtolower($postStatus);
      $institute = Institute::find($id);
      $user = User::find($institute->institute_head_id);
      if ($institute->update(['status' => $status])) {
        if ($status === Institute::$statusArrays[1]) {
          try {
            ini_set('max_execution_time', 300);
            \Illuminate\Support\Facades\Mail::to($institute->email)->cc([$user->email, 'info@asset-dte.gov.bd', 'dpd1@asset-dte.gov.bd', 'dpd2@asset-dte.gov.bd', 'dpd3@asset-dte.gov.bd', 'dpd4@asset-dte.gov.bd', 'po1@asset-dte.gov.bd', 'po2@asset-dte.gov.bd', 'programmer@asset-dte.gov.bd'])->send(new \App\Mail\InstituteActivationMail($institute->name, $institute->code, $user->name_en, 'active'));
          } catch (\Exception $e) {
          }
          $user->update(['status' => User::$statusArrays[1]]);
        }else{
          try {
            ini_set('max_execution_time', 300);
            \Illuminate\Support\Facades\Mail::to($institute->email)->cc([$user->email, 'info@asset-dte.gov.bd', 'programmer@asset-dte.gov.bd'])->send(new \App\Mail\InstituteActivationMail($institute->name, $institute->code, $user->name_en, 'inactive'));
          } catch (\Exception $e) {
          }
        }
        return "success";
      }
    }
  }

  public function ajaxUsersChange(Request $request) {
    if ($request->id) {
      $dataa = User::select('name_en', 'name_bn', 'username', 'phone', 'email')->find($request->id);
      // return view('admin.tainingMember.create',$dataa);
      return json_encode($dataa, 200);

    }
  }
}
