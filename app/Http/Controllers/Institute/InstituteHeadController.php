<?php

namespace App\Http\Controllers\Institute;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Technology;
use App\Models\Upazila;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class InstituteHeadController extends Controller {
  public function registration() {
    $data['datas'] = User::where("status", "=", "inactive")->where('institute_id', auth()->user()->institute_id)->orderby('id', 'desc')->get();
    return view('admin.instituteHead.registration', $data);
  }

  public function approved() {
    $data['datas'] = User::where("status", "=", "active")->where('institute_id', auth()->user()->institute_id)->orderby('id', 'desc')->get();
    return view('admin.instituteHead.approvedList', $data);
  }

  public function rejected() {
    $thirtyday = Carbon::today()->subDays(30);
    $data['datas'] = User::where("status", "=", "rejected")->where('institute_id', auth()->user()->institute_id)->where("updated_at", ">=", $thirtyday)->orderby('id', 'desc')->get();
    return view('admin.instituteHead.rejectedList', $data);
  }

  public function ajaxUpdateStatus(Request $request) {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $postStatus = $request->post('status');
      $status = strtolower($postStatus);
      $user = User::find($id);
      if ($user->update(['status' => $status])) {
        return "success";
      }
    }
  }

  public function ajaxUserDetails(Request $request) {
    if ($request->ajax()) {
      $user = User::with('division', 'district')->find($request->id);
      if ($user) {
        return response()->json($user, 200);
      } else {
        $errors = "Something went wrong!";
        return response()->json(['errors' => $errors], 200);
      }
    }

  }

  public function index() {
    $data['datas'] = User::where('institute_id', auth()->user()->institute_id)->orderby('id', 'desc')->get();;
    return view('admin.instituteHead.list', $data);
  }

  public function create() {
    $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
    $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
    return view('admin.instituteHead.create', $data);
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function students() {
    if (\App\Helper\CustomHelper::canView('', 'Super Admin')) {
      $data['datas'] = User::with('roles')->orderby('id', 'desc')->paginate(20);
    } else {
      $data['datas'] = User::with('roles')->whereHas('roles', function ($q){
        $q->where('name', 'Student');
      })->paginate(20);
    }
    $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
    $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
//    $data['institutes'] = Institute::where('status', Institute::$statusArrays[1])->where('type', 'Training Provider')->get();
    // return $data;
    return view('admin.instituteHead.students', $data);
  }



  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function createStudent() {
    $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
    $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
//    $data['institutes'] = Institute::where('status', Institute::$statusArrays[1])->where('type', 'Training Provider')->get();
$data['semester'] = Semester::select('id', 'name')->orderby('id', 'asc')->get();
$data['upazilas'] = Upazila::select('id', 'name')->orderby('name', 'asc')->get();
$data['technologies'] = Technology::select('id', 'name')->orderby('name', 'asc')->get();
$data['datas'] = Shift::select('id', 'name')->get();
    return view('admin.instituteHead.create-student', $data);
  }



  public function manage($id = null) {
    if ($data['institute'] = Institute::find($id)) {
      $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
      $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
      return view('admin.instituteHead.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.instituteHead.list', '<strong>Sorry!!!</strong> Institute not found');
  }


  public function store(Request $request) {

    $message = '<strong>Congratulations!!!</strong> User successfully ';

    if ($request->has('id')) {
      $user = user::find($request->id);
      $message = $message . ' updated';
    } else {
      $user = new user();
      $rules['name_en'] = 'required|string';
      $rules['name_bn'] = 'required|string';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['phone'] = 'required|max:11|min:11|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['password'] = 'required|string|min:' . User::$minimumPasswordLength;
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $user->username = $request->username;
      $user->name_en = $request->name_en;
      $user->name_bn = $request->name_bn;
      $user->phone = $request->phone;
      $user->email = $request->email;
      $user->institute_id = $request->institute_id;
      $user->password = bcrypt($request->password);
      $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
      $user->assignRole('Trainee');
      if ($user->save()) {
        return RedirectHelper::routeSuccess('admin.institute.head.list', $message);
      }
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }
  }
  public function manageStudent($id = null) {
    if ($data['user'] = User::find($id)) {
      $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
      $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
      $data['departments'] = Technology::where('status', Technology::$statusArrays[1])->orderby('name', 'ASC')->get();
      $data['semesters'] = Semester::where('status', Technology::$statusArrays[1])->orderby('name', 'ASC')->get();
      return view('admin.instituteHead.manage-student', $data);
    }
    return RedirectHelper::routeWarning('admin.instituteHead.list', '<strong>Sorry!!!</strong> Institute not found');
  }

  public function storeStudent(Request $request) {

//    return $request;
    $message = '<strong>Congratulations!!!</strong> User successfully ';


    $rules['name_en'] = 'required|string';
    $rules['name_bn'] = 'required|string';
    $rules['password'] = 'required|string|min:' . User::$minimumPasswordLength;
    $rules['birth_certificate'] = 'nullable|string';
    $rules['s_session'] = 'nullable|string';
    $rules['board_roll'] = 'nullable|string';
    $rules['running_board_roll'] = 'nullable|string';
    $rules['admission_year'] = 'nullable|string';
    $rules['nid'] = 'nullable|string';
    $rules['employment_status'] = 'nullable|string';
    $rules['employing_company'] = 'nullable|string';
    if ($request->has('id')) {
      $user = user::find($request->id);
      $message = $message . ' updated';
    } else {
      $user = new user();

      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['phone'] = 'required|max:11|min:11|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $user->username = $request->username;
      $user->name_en = $request->name_en;
      $user->name_bn = $request->name_bn;
      $user->phone = $request->phone;
      $user->email = $request->email;
      $user->institute_id = auth()->user()->institute_id;
      $user->birth_certificate = $request->birth_certificate;
      $user->session = $request->s_session;
      $user->board_roll = $request->board_roll;
      $user->nid = $request->nid;
      $user->running_board_roll = $request->running_board_roll;
      $user->admission_year = $request->admission_year;
      $user->employing_company = $request->employing_company;
      $user->employment_status = $request->employment_status;
      $user->password = bcrypt($request->password);
      $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[1];

      $old_cv = $user->cv;
      if ($request->hasFile('cv')) {
        $cvv = CustomHelper::storeImage($request->file('cv'), '/CV/');
        if ($cvv != false) {
          $user->cv = $cvv;
        }
      }
      $user->assignRole('Student');
      if ($user->save()) {
        if ($old_cv != $user->cv) {
          CustomHelper::deleteFile($old_cv);
        }
        return RedirectHelper::routeSuccess('admin.institute.head.student.list', $message);
      }
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }
  }

  public function profile($id = null){
    $data['profile'] = User::where('id',$id)->first();
    return view('admin.instituteHead.studentProfile',$data);
  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $user = User::find($id);
      if ($user->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }








  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function createTeacher() {
    $data['departments'] = Technology::where('status', Technology::$statusArrays[1])->orderby('name', 'ASC')->get();
    return view('admin.instituteHead.create-teacher', $data);
  }

  public function storeTeacher(Request $request) {
    $message = '<strong>Congratulations!!!</strong> Teacher successfully ';

    if ($request->has('id')) {
      $user = User::find($request->id);
      $message = $message . ' updated';
    } else {
      $user = new User();
      $rules['name_en'] = 'required|string';
      $rules['name_bn'] = 'required|string';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['department'] = 'required|numeric';
      $rules['designation'] = 'nullable|string';
      $rules['phone'] = 'required|max:11|min:11|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['password'] = 'required|string|min:' . User::$minimumPasswordLength;
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $user->username = $request->username;
      $user->name_en = $request->name_en;
      $user->name_bn = $request->name_bn;
      $user->phone = $request->phone;
      $user->email = $request->email;
      $user->designation = $request->designation;
      $user->department_id = $request->department;
      $user->institute_id = auth()->user()->institute_id;
      $user->password = bcrypt($request->password);
      $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
      if ($user->save()) {
        $user->assignRole('Teacher');
        return RedirectHelper::routeSuccess('admin.institute.head.teacher.list', $message);
      }
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }


  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function teachers() {
    $data['datas'] = User::with('roles', 'department:id,name')->whereHas('roles', function ($q){
      $q->where('name', 'Teacher');
    })->orderby('id', 'desc')
      ->where('institute_id', auth()->user()->institute_id)->paginate(20);
    return view('admin.instituteHead.teachers', $data);
  }





  public function createStaff() {
    return view('admin.instituteHead.create-staff');
  }

  public function storeStaff(Request $request) {

    $message = '<strong>Congratulations!!!</strong> Staff successfully ';

    if ($request->has('id')) {
      $user = user::find($request->id);
      $message = $message . ' updated';
    } else {
      $user = new user();
      $rules['name_en'] = 'required|string';
      $rules['name_bn'] = 'required|string';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['phone'] = 'required|max:11|min:11|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['designation'] = 'nullable|string';
      $rules['password'] = 'required|string|min:' . User::$minimumPasswordLength;
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $user->username = $request->username;
      $user->name_en = $request->name_en;
      $user->name_bn = $request->name_bn;
      $user->phone = $request->phone;
      $user->email = $request->email;
      $user->designation = $request->designation;
      $user->institute_id = auth()->user()->institute_id;
      $user->password = bcrypt($request->password);
      $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
      if ($user->save()) {
        $user->assignRole('Staff');
        return RedirectHelper::routeSuccess('admin.institute.head.staff.list', $message);

      }
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function staffs() {
    $data['datas'] = User::with('roles')->whereHas('roles', function ($q){
      $q->where('name', 'Staff');
    })->where('institute_id', auth()->user()->institute_id)->orderby('id', 'desc')->paginate(20);
    return view('admin.instituteHead.staffs', $data);
  }






  public function createOfficer() {
    return view('admin.instituteHead.create-officer');
  }

  public function storeOfficer(Request $request) {

    $message = '<strong>Congratulations!!!</strong> Officer successfully ';

    if ($request->has('id')) {
      $user = user::find($request->id);
      $message = $message . ' updated';
    } else {
      $user = new user();
      $rules['name_en'] = 'required|string';
      $rules['name_bn'] = 'required|string';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['phone'] = 'required|max:11|min:11|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['designation'] = 'nullable|string';
      $rules['password'] = 'required|string|min:' . User::$minimumPasswordLength;
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $user->username = $request->username;
      $user->name_en = $request->name_en;
      $user->name_bn = $request->name_bn;
      $user->phone = $request->phone;
      $user->email = $request->email;
      $user->designation = $request->designation;
      $user->institute_id = auth()->user()->institute_id;
      $user->password = bcrypt($request->password);
      $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
      if ($user->save()) {
        $user->assignRole('Officer');
        return RedirectHelper::routeSuccess('admin.institute.head.officer.list', $message);

      }
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function officers() {
    $data['datas'] = User::with('roles')->whereHas('roles', function ($q){
      $q->where('name', 'Officer');
    })->where('institute_id', auth()->user()->institute_id)->orderby('id', 'desc')->paginate(20);
    return view('admin.instituteHead.officers', $data);
  }

// employee section
public function createEmployee(){
  return view('admin.instituteHead.create_employee');
}
public function storeEmployee(Request $request){
  if ($request->isMethod('POST')) {
    $message = '<strong>Congratulations!!!</strong> Successfully ';
    $rules = [
      'nid' => 'nullable|string',
      'name_en' => 'required|string',
      'name_bn' => 'nullable|string',
      'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
      'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,',
      'password' => 'required|string|min:6|confirmed',
      'website' => 'url',
      'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,


      // 'department' => 'nullable|string',

      'image' => 'nullable|mimes:png,jpg,jpeg',
    ];
    $message = $message . ' Register';
    $request->validate($rules);
    // return $request;
    $user = new User();
    try {
      $user->website = $request->website;
      $user->nid = $request->nid;
      $user->name_en = $request->name_en;
      $user->name_bn = $request->name_bn;
      $user->username = $request->username;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->phone = $request->phone;
      $user->alt_phone = $request->alt_phone;
//                $user->image = $request->image;
      $oldImage = $request->image;
      // $user->department = $request->department;
      if ($request->hasFile('image')) {
        $logo = CustomHelper::storeImage($request->file('image'), '/industry/');
        if ($logo != false) {
          $user->image = $logo;
        }
      }
      $user->status = User::$statusArrays[1];
      if ($user->save()) {
        if ($oldImage !== null && isset($logo)) {
          CustomHelper::deleteFile($oldImage);
        }
        $user->assignRole('Industry');
//        return RedirectHelper::routeSuccess('register.step2', $message);
        return RedirectHelper::routeSuccess('admin.institute.head.employee.list', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }
  }
  $data['institutes'] = Institute::select('id', 'name')->orderby('id', 'asc')->get();
  $data['institutes_type'] = InstituteType::select('id', 'name')->orderby('id', 'asc')->get();
  $data['semester'] = Semester::select('id', 'name')->orderby('id', 'asc')->get();
  $data['divisions'] = Division::Select('id', 'name')->orderby('name', 'asc')->get();
  $data['districts'] = District::Select('id', 'name')->orderby('name', 'asc')->get();
  $data['upazilas'] = Upazila::select('id', 'name')->orderby('name', 'asc')->get();
  $data['technologies'] = Technology::select('id', 'name')->orderby('name', 'asc')->get();

  // return view('site.registration.industry', $data);
}

public function employeeList(){
  $data['datas'] = User::with('roles')->whereHas('roles', function ($q){
    $q->where('name', 'Industry');
  })->orderby('id', 'desc')->paginate(20);
  // return $data['datas'];
  return view('admin.instituteHead.employee_list', $data);
}

}
