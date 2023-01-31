<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\BackgroundImage;
use App\Models\District;
use App\Models\Division;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Technology;
use App\Models\Training;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Actions\CompletePasswordReset;
use Laravel\Fortify\Contracts\FailedPasswordResetResponse;
use Laravel\Fortify\Contracts\PasswordResetResponse;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Laravel\Fortify\Fortify;

class AuthController extends Controller {
  public function login(Request $request) {
    if ($request->isMethod('POST')) {
      $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:' . User::$minimumPasswordLength
      ]);

      $credential = $request->only('email', 'password');

      if (Auth::attempt($credential)) {
        if (\auth()->user()->status !== User::$statusArrays[1]) {
          Auth::logout();
          \Illuminate\Support\Facades\Session::flush();
          return RedirectHelper::backWithInput('<strong>Sorry!!!</strong> Your not eligible for automatic activation. <br>Please call following concerned for activation (at working hour). For more details visit &nbsp;<a href="http://www.asset-dte.gov.bd/" target="_blank">ASSET Project</a><br>
    <table class="table table-bordered" style="width: 100%">
    <th class="p-0">Designation</th>
    <th class="p-0">Contact No</th>
<tbody>
<tr>
<td class="p-1">Programmer</td>
<td class="p-1"><a href="tel:01325073614">01325073614</a></td>
</tr>
<tr>
<td class="p-1">DPD(RPL)</td>
<td class="p-1"><a href="tel:01325073610">01325073610</a></td>
</tr>
<tr>
<td class="p-1">PO(RPL)</td>
<td class="p-1"><a href="tel:01325073616">01325073616</a></td>
</tr>
<tr>
<td class="p-1">DPD(IDG), Technical</td>
<td class="p-1"><a href="tel:01325073612">01325073612</a></td>
</tr>
<tr>
<td class="p-1">DPD(IDG), Medical</td>
<td class="p-1"><a href="tel:01325073611">01325073611</a></td>
</tr>
<tr>
<td class="p-1">DPD(Short Course)</td>
<td class="p-1"><a href="tel:01325073613">01325073613</a></td>
</tr>
<tr>
<td class="p-1">PO(Short Course)</td>
<td class="p-1"><a href="tel:01325073615">01325073615</a></td>
</tr>
<tr>
<td class="p-1">AO(Enterprise)</td>
<td class="p-1"><a href="tel:01711589488">01711589488</a></td>
</tr>
<tr>
<td class="p-1">Programmer (Enterprise)</td>
<td class="p-1"><a href="tel:01325073614">01325073614</a></td>
</tr>
</tbody>
</table>');
        }
        return to_route('admin.dashboard');
      }
      return RedirectHelper::backWithInput('<strong>Sorry!!!</strong> Your email or password is wrong.');
    }
    $data['images'] = BackgroundImage::where('status', BackgroundImage::$statusArray[0])->get();
    // return $data;
    return view('admin.auth.login', $data);
  }

  public function register(Request $request) {
//     return $request;
    if ($request->isMethod('POST')) {
//      return $request;

      $message = '<strong>Congratulations!!!</strong> Successfully ';
      $rules = [
        'trade_technology' => 'nullable|string',
        'shift' => 'nullable|string',
        'section' => 'nullable|string',
        'semester' => 'nullable|string',
        'year' => 'nullable|string',
        's_session' => 'nullable|string',
        'board_roll' => 'nullable|string|unique:' . with(new User)->getTable() . ',board_roll,',
        'running_board_roll' => 'nullable|string|unique:' . with(new User)->getTable() . ',running_board_roll,',
        'admission_year' => 'nullable|string',
        'nid' => 'nullable|string',
        'birth_certificate' => 'nullable|string|unique:' . with(new User)->getTable() . ',birth_certificate,',

        'name_en' => 'nullable|string',
        'name_bn' => 'nullable|string',
        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,
        'institute_id' => 'nullable|numeric|exists:' . with(new Institute)->getTable() . ',id',


        'institute_type_id' => 'nullable|string',
        // 'department' => 'nullable|string',
        'profile_photo_path' => 'nullable|mimes:png,jpg,jpeg',
      ];
      $message = $message . ' Register';
      // return $request;
      $request->validate($rules);
      // return $request;
      $user = new User();
      try {
        $user->trade_technology_id = $request->trade_technology_id;
        $user->shift_id = $request->shift_id;
        $user->section = $request->section;
        $user->semester_id = $request->semester_id;
        $user->year = $request->year;
        $user->session = $request->s_session;
        $user->board_roll = $request->board_roll;
        $user->running_board_roll = $request->running_board_roll;
        $user->admission_year = $request->admission_year;
        $user->nid = $request->nid;
        $user->birth_certificate = $request->birth_certificate;
        $user->name_en = $request->name_en;
        $user->name_bn = $request->name_bn;
        $user->username = $request->username;

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->institute_id = $request->institute_id;
        $user->profile_photo_path = $request->profile_photo_path;


        $user->institute_type = $request->institute_type;
        // $user->department = $request->department;


        $user->status = User::$statusArrays[0];
        if ($user->save()) {
          $user->assignRole('Student');
//        return RedirectHelper::routeSuccess('register.step2', $message);
          return RedirectHelper::routeSuccess('login', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
//        return $e;
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
    $data['datas'] = Shift::select('id', 'name')->get();

    return view('site.registration.student', $data);
    // return $data['technologies'];
  }

  public function resetPassword(Request $request, $token) {
    $request->validate([
      'password' => 'required|string|min:8|confirmed',
      'password_confirmation' => 'required'
    ]);

    $updatePassword = DB::table('password_resets')
      ->where('email', $request->email)
      ->first();
    if (!$updatePassword) {
      return back()->withInput()->with('error', 'Invalid token!');
    }

    User::where('email', $updatePassword->email)
      ->update(['password' => bcrypt($request->password)]);

    DB::table('password_resets')->where(['email' => $request->email])->delete();

    return RedirectHelper::routeSuccess('login', '<strong>Congratulations!!!</strong> Password updated.');
  }


  /**
   * @param Request $request
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
   */
  public function instituteCreateWithUser(Request $request) {//: \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application {
    $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
    $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderby('name')->get();
    $data['types'] = InstituteType::select('id', 'name')->orderby('name', 'asc')->get();
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> Institute successfully ';

      $rules = [
        'division_id' => 'required',
        'district_id' => 'required',
        'upazila_id' => 'required',
        'address' => 'required',
      ];

      $institute = new Institute();
      $user = new user();
      //        user table
      $rules['name_en'] = 'required|string|max:50';
      $rules['name_bn'] = 'required|string|max:60';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['phone'] = 'required|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['dob'] = 'required|date';
      $rules['password'] = 'required|confirmed|string|min:' . User::$minimumPasswordLength;
      // $rules['semester'] = 'required|string';
      //      institute
      $rules['institute_name'] = 'required|string|max:200|unique:' . with(new Institute)->getTable() . ',name';
      $rules['institute_name_bn'] = 'string|max:200|unique:' . with(new Institute)->getTable() . ',name_bn';
      $rules['code'] = 'required|min:5|max:7|unique:' . with(new Institute)->getTable() . ',code';
      $rules['institute_phone'] = 'required|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new Institute)->getTable() . ',phone,';
      $rules['institute_email'] = 'required|email|unique:' . with(new Institute)->getTable() . ',email,';
      $rules['website'] = 'required|string|regex:'.CustomHelper::URLRegex;
      $rules['institute_type_id'] = 'required|string';
      $rules['photo'] = 'nullable|mimes:png';
      $rules['description'] = 'nullable|string';
      $message = $message . ' created';

      $request->validate($rules);
      // return $request;

      DB::beginTransaction();
      try {
        if (!$request->has('id')) {
          $user->username = $request->username;
          $user->name_en = $request->name_en;
          $user->name_bn = $request->name_bn;
          $user->phone = $request->phone;
          $user->dob = $request->dob;
          $user->nid = $request->nid;
          $user->email = $request->email;
          $user->password = bcrypt($request->password);
          if ($request->hasFile('user_image')) {
            $logo = CustomHelper::storeImage($request->file('user_image'), '/users/');
            if ($logo != false) {
              $user->profile_photo_path = $logo;
            }
          }
          $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
          $user->assignRole('Institute Head');
          if ($user->save()) {
            $userid = $user->id;
          }
        }
        $institute->code = $request->code;
        $institute->name = $request->institute_name;
        $institute->name_bn = $request->institute_name_bn;
        $institute->phone = $request->institute_phone;
        $institute->email = $request->institute_email;
        if (!$request->has('id')) {
          $institute->institute_head_id = $userid;
        }
        $institute->division_id = $request->division_id;
        $institute->district_id = $request->district_id;
        $institute->upazila_id = $request->upazila_id;
        $institute->address = $request->address;
        $institute->website = $request->website;
        $institute->description = $request->description;
        $institute->institute_type_id = $request->institute_type_id;
        $institute->status = isset($request->institute_status) ? $request->institute_status : \App\Models\User::$statusArrays[0];

        $oldImage = $institute->photo;
        if ($request->hasFile('photo')) {
          $logo = CustomHelper::storeImage($request->file('photo'), '/institute/');
          if ($logo != false) {
            $institute->photo = $logo;
          }
        }

        if ($institute->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }

          if (!$request->has('id')) {
            $user = User::find($userid);
            $user->institute_id = $institute->id;
            $user->save();
          }


          try {
            ini_set('max_execution_time', 300);
            \Illuminate\Support\Facades\Mail::to($institute->email)->cc([$user->email, 'info@asset-dte.gov.bd', 'dpd1@asset-dte.gov.bd', 'dpd2@asset-dte.gov.bd', 'dpd3@asset-dte.gov.bd', 'dpd4@asset-dte.gov.bd', 'po1@asset-dte.gov.bd', 'po2@asset-dte.gov.bd', 'programmer@asset-dte.gov.bd'])->send(new \App\Mail\InstituteRegistrationMail($institute->name, $institute->code, $user->name_en));
          } catch (\Exception $e) {
          }

          DB::commit();
          return RedirectHelper::back($message);
        }
        DB::rollBack();
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
//        return $e;
        DB::rollBack();
        return RedirectHelper::backWithInputFromException();
      }
    }
    return view('site.registration.institute', $data);
  }


  /**
   * @param Request $request
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
   */
  public function training(Request $request) {
    $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
    $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderby('name')->get();
    $data['types'] = InstituteType::select('id', 'name')->orderby('name', 'asc')->get();
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> Institute successfully ';
      $rules = [
        'division_id' => 'required',
        'district_id' => 'required',
        'upazila_id' => 'required',
        'address' => 'required',
      ];
      $institute = new Institute();
      $user = new user();
      //        user table
      $rules['name_en'] = 'required|string|max:50';
      $rules['name_bn'] = 'required|string|max:60';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['phone'] = 'required|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['dob'] = 'required|date';
      $rules['password'] = 'required|confirmed|string|min:' . User::$minimumPasswordLength;
      $rules['nid'] = 'required|string';
      //      institute
      $rules['institute_name'] = 'required|string|max:200|unique:' . with(new Institute)->getTable() . ',name';
      $rules['institute_name_bn'] = 'string|max:200|unique:' . with(new Institute)->getTable() . ',name_bn';
      $rules['code'] = 'required|min:7|max:7';
      $rules['institute_phone'] = 'required|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new Institute)->getTable() . ',phone,';
      $rules['institute_email'] = 'required|email|unique:' . with(new Institute)->getTable() . ',email,';
      $rules['website'] = 'required|url';
      $rules['institute_type_id'] = 'required|string';
      $rules['photo'] = 'nullable|mimes:png';
      $rules['user_image'] = 'nullable|mimes:png';
      $rules['description'] = 'nullable|string';
      $message = $message . ' created';
      $request->validate($rules);

      // return $request;

      DB::beginTransaction();
      try {
        if (!$request->has('id')) {
          $user->username = $request->username;
          $user->name_en = $request->name_en;
          $user->name_bn = $request->name_bn;
          $user->phone = $request->phone;
          $user->dob = $request->dob;
          $user->nid = $request->nid;
          $user->email = $request->email;
          $user->password = bcrypt($request->password);
          if ($request->hasFile('user_image')) {
            $logo = CustomHelper::storeImage($request->file('user_image'), '/users/');
            if ($logo != false) {
              $user->profile_photo_path = $logo;
            }
          }
          $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
          $user->assignRole('Institute Head');
          if ($user->save()) {
            $userid = $user->id;
          }
        }
        $institute->code = $request->code;
        $institute->name = $request->institute_name;
        $institute->name_bn = $request->institute_name_bn;
        $institute->phone = $request->institute_phone;
        $institute->email = $request->institute_email;
        if (!$request->has('id')) {
          $institute->institute_head_id = $userid;
        }
        $institute->division_id = $request->division_id;
        $institute->district_id = $request->district_id;
        $institute->upazila_id = $request->upazila_id;
        $institute->address = $request->address;
        $institute->website = $request->website;
        $institute->description = $request->description;
        $institute->institute_type_id = $request->institute_type_id;
        $institute->status = isset($request->institute_status) ? $request->institute_status : \App\Models\User::$statusArrays[0];

        $oldImage = $institute->photo;
        if ($request->hasFile('photo')) {
          $logo = CustomHelper::storeImage($request->file('photo'), '/institute/');
          if ($logo != false) {
            $institute->photo = $logo;
          }
        }

        if ($institute->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }

          if (!$request->has('id')) {
            $user = User::find($userid);
            $user->institute_id = $institute->id;
            $user->save();
          }
          DB::commit();
          return RedirectHelper::back($message);
        }
        DB::rollBack();
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
        DB::rollBack();
        return RedirectHelper::backWithInputFromException();
        return RedirectHelper::backWithInputFromException();
      }
    }
    return view('site.registration.training_provider', $data);
  }


  public function evalutor(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> Evalutor successfully ';
//          return $request;
      $user = new user();

      //        user table
      $rules['name_en'] = 'required|string|max:50';
      $rules['name_bn'] = 'required|string|max:60';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['phone'] = 'required|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['alt_phone'] = 'required';
      $rules['office'] = 'required|string|max:60';
      $rules['designation'] = 'required|string|max:60';
      $rules['password'] = 'required|confirmed|string|min:' . User::$minimumPasswordLength;
      $rules['image'] = 'nullable|mimes:png';
      $rules['nid'] = 'required';
      $message = $message . ' created';

      $request->validate($rules);
      DB::beginTransaction();

      try {
        if (!$request->has('id')) {
          $user->username = $request->username;
          $user->name_en = $request->name_en;
          $user->name_bn = $request->name_bn;
          $user->phone = $request->phone;
          $user->alt_phone = $request->alt_phone;
          $user->office = $request->office;
          $user->designation = $request->designation;
          $user->nid = $request->nid;
          $user->email = $request->email;
          $user->image = $request->image;
          $user->password = bcrypt($request->password);


          if ($request->hasFile('image')) {
            $logo = CustomHelper::storeImage($request->file('image'), '/evalutor/');
            if ($logo != false) {
              $user->profile_photo_path = $logo;
            }
          }

//                  $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
//                  $user->assignRole('Institute Head');
          if ($user->save()) {
            DB::commit();
            return RedirectHelper::back($message);
          }


        }


      } catch (QueryException $e) {
        DB::rollBack();
        return RedirectHelper::backWithInputFromException();
      }

    }
    return view('site.registration.evalutor');
  }

  public function student() {
    return view('site.registration.student');
  }

  public function teacher(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> Teacher successfully ';
      $rules = [
//        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,
        // 'phone' => 'required' ,
        'name_en' => 'nullable|string',
        'name_bn' => 'nullable|string',
        'dob ' => 'nullable|date',
        'nid' =>'required',
        'designation' =>'nullable|string',
      ];
      $message = $message . ' Register';
      $request->validate($rules);
      $user = new User();
      try {
        $user->nid = $request->nid;
        $user->designation = $request->designation;
        $user->section = $request->section_id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->name_en = $request->name_en;
        $user->name_bn = $request->name_bn;
        $user->institute_id = $request->institute_id;
        $user->trade_technology = $request->trade_technology;
        $user->institute_type_id = $request->institute_type_id;
//        $user->nid = $request->nid;
        $user->dob = $request->dob;
        $user->status = User::$statusArrays[0];
        $oldImage = $user->profile_photo_path;
        if ($request->has('profile_photo_path')) {
          $logo = CustomHelper::storeImage($request->file('profile_photo_path'), '/teacher/');
          if ($logo != false) {
            $user->profile_photo_path = $logo;
          }
        }
        if ($user->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }

          ($request->teacher_type == 'Teacher') ? $user->assignRole('Teacher') : $user->assignRole('Hod');

//        return RedirectHelper::routeSuccess('register.step2', $message);
          return RedirectHelper::routeSuccess('login', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
        return RedirectHelper::backWithInputFromException();
      }
    }
    $data['divisions'] = Division::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['technologies'] = Technology::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['districts'] = District::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderby('name', 'asc')->get();
    $data['institute_types'] = InstituteType::select('id', 'name')->orderBy('name', 'asc')->get();
    $data['institutes'] = Institute::select('id', 'name')->orderby('id', 'asc')->get();
//    return view('site.registration.register', $data);
    return view('site.registration.teacher', $data);
  }


//arman
  public function mentor(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> Mentor successfully ';
      $user = new user();

      //        user table
      $rules['name_en'] = 'required|string|max:50';
      $rules['name_bn'] = 'required|string|max:60';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['phone'] = 'required|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['alt_phone'] = 'required';
      $rules['designation'] = 'required|string|max:60';
      $rules['office'] = 'required|string|max:60';
      $rules['password'] = 'required|confirmed|string|min:' . User::$minimumPasswordLength;
      $rules['image'] = 'nullable|mimes:png,jpg,jpeg';
      $rules['nid'] = 'required';
      $message = $message . ' registered';

      $request->validate($rules);
      DB::beginTransaction();

      try {
        if (!$request->has('id')) {
          $user->username = $request->username;
          $user->name_en = $request->name_en;
          $user->name_bn = $request->name_bn;
          $user->phone = $request->phone;
          $user->alt_phone = $request->alt_phone;
          $user->office = $request->office;
          $user->nid = $request->nid;
          $user->designation = $request->designation;
          $user->trade_technology = $request->trade_technology;
          $user->institute_id = $request->institute_id;
          $user->email = $request->email;
//                    $user->image = $request->image;
          $user->password = bcrypt($request->password);

          $oldImage = $user->image;

//                    return $user;
          if ($request->hasFile('image')) {
            $logo = CustomHelper::storeImage($request->file('image'), '/mentor/');
            if ($logo != false) {
              $user->image = $logo;
            }
          }

          $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
          $user->assignRole('Mentor');
          if ($user->save()) {
            if ($oldImage !== null && isset($logo)) {
              CustomHelper::deleteFile($oldImage);
            }
            DB::commit();
            return RedirectHelper::back($message);
          }


        }


      } catch (QueryException $e) {
        DB::rollBack();
        return RedirectHelper::backWithInputFromException();
      }

    }
    $data['technologies'] = Technology::where('status',Technology::$statusArrays[1])->get();
    $data['institutes'] = Institute::where('status',Institute::$statusArrays[1])->get();
    return view('site.registration.mentor',$data);
  }

//arman
  public function dte(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> dte successfully ';
//          return $request;
      $user = new user();

      //        user table
      $rules['name_en'] = 'required|string|max:50';
      $rules['name_bn'] = 'required|string|max:60';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['phone'] = 'required|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['alt_phone'] = 'required';
      $rules['designation'] = 'required|string|max:60';
      $rules['office'] = 'required|string|max:60';
      $rules['password'] = 'required|confirmed|string|min:' . User::$minimumPasswordLength;
      $rules['image'] = 'nullable|mimes:png,jpg,jpeg';
      $rules['nid'] = 'required';
      $message = $message . ' registered';

      $request->validate($rules);
      DB::beginTransaction();

      try {
        if (!$request->has('id')) {
          $user->username = $request->username;
          $user->name_en = $request->name_en;
          $user->name_bn = $request->name_bn;
          $user->phone = $request->phone;
          $user->alt_phone = $request->alt_phone;
          $user->office = $request->office;
          $user->nid = $request->nid;
          $user->designation = $request->designation;
          $user->email = $request->email;
//                    $user->image = $request->image;
          $user->password = bcrypt($request->password);

          $oldImage = $user->image;

//                    return $user;
          if ($request->hasFile('image')) {
            $logo = CustomHelper::storeImage($request->file('image'), '/mentor/');
            if ($logo != false) {
              $user->image = $logo;
            }
          }

          $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
//                  $user->assignRole('Institute Head');
          if ($user->save()) {
            if ($oldImage !== null && isset($logo)) {
              CustomHelper::deleteFile($oldImage);
            }
            DB::commit();
            return RedirectHelper::back($message);
          }


        }


      } catch (QueryException $e) {
        DB::rollBack();
        return RedirectHelper::backWithInputFromException();
      }

    }
    return view('site.registration.dte');
  }

//arman
  public function pmu(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> PMU successfully ';
      $user = new user();

      //        user table
      $rules['name_en'] = 'required|string|max:50';
      $rules['name_bn'] = 'required|string|max:60';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['phone'] = 'required|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['alt_phone'] = 'required';
      $rules['designation'] = 'required|string|max:60';
      $rules['office'] = 'required|string|max:60';
      $rules['password'] = 'required|confirmed|string|min:' . User::$minimumPasswordLength;
      $rules['image'] = 'nullable|mimes:png,jpg,jpeg';
      $rules['nid'] = 'required';
      $message = $message . ' registered';

      $request->validate($rules);
      DB::beginTransaction();

      try {
        if (!$request->has('id')) {
          $user->username = $request->username;
          $user->name_en = $request->name_en;
          $user->name_bn = $request->name_bn;
          $user->phone = $request->phone;
          $user->alt_phone = $request->alt_phone;
          $user->office = $request->office;
          $user->nid = $request->nid;
          $user->designation = $request->designation;
          $user->email = $request->email;
//                    $user->image = $request->image;
          $user->password = bcrypt($request->password);

          $oldImage = $user->image;

//                    return $user;
          if ($request->hasFile('image')) {
            $logo = CustomHelper::storeImage($request->file('image'), '/pmu/');
            if ($logo != false) {
              $user->image = $logo;
            }
          }

          $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
//                  $user->assignRole('Institute Head');
          if ($user->save()) {
            if ($oldImage !== null && isset($logo)) {
              CustomHelper::deleteFile($oldImage);
            }
            DB::commit();
            return RedirectHelper::back($message);
          }


        }


      } catch (QueryException $e) {
        DB::rollBack();
        return RedirectHelper::backWithInputFromException();
      }

    }
    return view('site.registration.pmu');
  }

//arman
  public function nsda(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> NSDA successfully ';
//          return $request;
      $user = new user();

      //        user table
      $rules['name_en'] = 'required|string|max:50';
      $rules['name_bn'] = 'required|string|max:60';
      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
      $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,';
      $rules['phone'] = 'required|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,';
      $rules['alt_phone'] = 'required';
      $rules['designation'] = 'required|string|max:60';
      $rules['office'] = 'required|string|max:60';
      $rules['password'] = 'required|confirmed|string|min:' . User::$minimumPasswordLength;
      $rules['image'] = 'nullable|mimes:png,jpg,jpeg';
      $rules['nid'] = 'required';
      $message = $message . ' registered';

      $request->validate($rules);
      DB::beginTransaction();

      try {
        if (!$request->has('id')) {
          $user->username = $request->username;
          $user->name_en = $request->name_en;
          $user->name_bn = $request->name_bn;
          $user->phone = $request->phone;
          $user->alt_phone = $request->alt_phone;
          $user->office = $request->office;
          $user->nid = $request->nid;
          $user->designation = $request->designation;
          $user->email = $request->email;
//                    $user->image = $request->image;
          $user->password = bcrypt($request->password);

          $oldImage = $user->image;

//                    return $user;
          if ($request->hasFile('image')) {
            $logo = CustomHelper::storeImage($request->file('image'), '/pmu/');
            if ($logo != false) {
              $user->image = $logo;
            }
          }

          $user->status = isset($request->status) ? strtolower($request->status) : \App\Models\User::$statusArrays[0];
//                  $user->assignRole('Institute Head');
          if ($user->save()) {
            if ($oldImage !== null && isset($logo)) {
              CustomHelper::deleteFile($oldImage);
            }
            DB::commit();
            return RedirectHelper::back($message);
          }


        }


      } catch (QueryException $e) {
        DB::rollBack();
        return RedirectHelper::backWithInputFromException();
      }

    }
    return view('site.registration.nsda');
  }

//arif
  public function moi(Request $request) {
    if ($request->isMethod('POST')) {

      $message = '<strong>Congratulations!!!</strong> MOI successfully ';

      $rules = [
        'nid' => 'required|string',
        'name_en' => 'nullable|string',
        'name_bn' => 'nullable|string',
        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'office' => 'nullable|string',
        'designation' => 'nullable|string',
        'email' => 'required|email|unique:' . with(new User())->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,
        'alt_phone' => 'required|string:',
        'image' => 'nullable|mimes:png,jpg,jpeg',

      ];
      $message = $message . ' Register';
      $request->validate($rules);
      $user = new User();
      try {
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->name_en = $request->name_en;
        $user->name_bn = $request->name_bn;


        $user->nid = $request->nid;
        $user->dob = $request->dob;
        $user->status = User::$statusArrays[0];
        $oldImage = $user->image;
        if ($request->hasFile('image')) {
          $logo = CustomHelper::storeImage($request->file('image'), '/moi/');
          if ($logo != false) {
            $user->image = $logo;
          }
        }
        if ($user->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }
          $user->assignRole('moi');
          //        return RedirectHelper::routeSuccess('register.step2', $message);
          return RedirectHelper::routeSuccess('login', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
        return $e;
        return RedirectHelper::backWithInputFromException();
      }
    }
    $data['divisions'] = Division::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['districts'] = District::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderby('name', 'asc')->get();

    //    return view('site.registration.register', $data);
    return view('site.registration.moi', $data);
  }

//arif
  public function bmet(Request $request) {
    if ($request->isMethod('POST')) {
// return $request;
      $message = '<strong>Congratulations!!!</strong> BMET successfully ';

      $rules = [
        'nid' => 'required|string',
        'name_en' => 'nullable|string',
        'name_bn' => 'nullable|string',
        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'office' => 'nullable|string',
        'designation' => 'nullable|string',
        'email' => 'required|email|unique:' . with(new User())->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,
        'alt_phone' => 'required|string:',
        'image' => 'nullable|mimes:png,jpg,jpeg',

      ];
      $message = $message . ' Register';
      $request->validate($rules);
      // return $request;
      $user = new User();
      try {
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->name_en = $request->name_en;
        $user->name_bn = $request->name_bn;


        $user->nid = $request->nid;
        $user->dob = $request->dob;
        $user->status = User::$statusArrays[0];
        $oldImage = $user->image;
        if ($request->hasFile('image')) {
          $logo = CustomHelper::storeImage($request->file('image'), '/bmet/');
          if ($logo != false) {
            $user->image = $logo;
          }
        }
        if ($user->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }
          $user->assignRole('bmet');
          //        return RedirectHelper::routeSuccess('register.step2', $message);
          return RedirectHelper::routeSuccess('login', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
        // return $e;
        return RedirectHelper::backWithInputFromException();
      }
    }
    $data['divisions'] = Division::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['districts'] = District::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderby('name', 'asc')->get();

    //    return view('site.registration.register', $data);
    return view('site.registration.bmet', $data);
  }

//arif
  public function tmed(Request $request) {
    if ($request->isMethod('POST')) {
      // return $request;
      $message = '<strong>Congratulations!!!</strong> TMED successfully ';

      $rules = [
        'nid' => 'required|string',
        'name_en' => 'nullable|string',
        'name_bn' => 'nullable|string',
        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'office' => 'nullable|string',
        'designation' => 'nullable|string',
        'email' => 'required|email|unique:' . with(new User())->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,
        'alt_phone' => 'required|string:',
        'image' => 'nullable|mimes:png,jpg,jpeg',

      ];
      $message = $message . ' Register';
      $request->validate($rules);
      // return $request;
      $user = new User();
      try {
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->name_en = $request->name_en;
        $user->name_bn = $request->name_bn;


        $user->nid = $request->nid;
        $user->dob = $request->dob;
        $user->status = User::$statusArrays[0];
        $oldImage = $user->image;
        if ($request->hasFile('image')) {
          $logo = CustomHelper::storeImage($request->file('image'), '/tmed/');
          if ($logo != false) {
            $user->image = $logo;
          }
        }
        if ($user->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }
          $user->assignRole('tmed');
          //        return RedirectHelper::routeSuccess('register.step2', $message);
          return RedirectHelper::routeSuccess('login', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
        // return $e;
        return RedirectHelper::backWithInputFromException();
      }
    }
    $data['divisions'] = Division::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['districts'] = District::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderby('name', 'asc')->get();

    //    return view('site.registration.register', $data);
    return view('site.registration.tmed', $data);
  }

//  arif
  public function trainee(Request $request) {
    if ($request->isMethod('POST')) {
      // return $request;
      $message = '<strong>Congratulations!!!</strong> Trainee successfully ';

      $rules = [
        'nid' => 'required|string',
        'name_en' => 'nullable|string',
        'name_bn' => 'nullable|string',
        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'office' => 'nullable|string',
        'designation' => 'nullable|string',
        'email' => 'required|email|unique:' . with(new User())->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,
        'alt_phone' => 'required|string:',
        'image' => 'nullable|mimes:png,jpg,jpeg',

      ];
      $message = $message . ' Register';
      $request->validate($rules);
      // return $request;
      $user = new User();
      try {
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->name_en = $request->name_en;
        $user->name_bn = $request->name_bn;


        $user->nid = $request->nid;
        $user->dob = $request->dob;
        $user->status = User::$statusArrays[0];
        $oldImage = $user->image;
        if ($request->hasFile('image')) {
          $logo = CustomHelper::storeImage($request->file('image'), '/tmed/');
          if ($logo != false) {
            $user->image = $logo;
          }
        }
        if ($user->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }
          $user->assignRole('trainee');
          //        return RedirectHelper::routeSuccess('register.step2', $message);
          return RedirectHelper::routeSuccess('login', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
        // return $e;
        return RedirectHelper::backWithInputFromException();
      }
    }
    $data['divisions'] = Division::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['districts'] = District::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderby('name', 'asc')->get();

    //    return view('site.registration.register', $data);
    return view('site.registration.trainee', $data);
  }

//mahir
  public function bteb(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> Successfully ';
      $rules = [
        'nid' => 'nullable|string',
        'name_en' => 'required|string',
        'name_bn' => 'nullable|string',
        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,


        // 'department' => 'nullable|string',

        'image' => 'nullable|mimes:png,jpg,jpeg',
      ];
      $message = $message . ' Register';
      $request->validate($rules);
      // return $request;
      $user = new User();
      try {
        $user->office = $request->office;
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
          $logo = CustomHelper::storeImage($request->file('image'), '/bteb/');
          if ($logo != false) {
            $user->image = $logo;
          }
        }


        $user->status = User::$statusArrays[0];
        if ($user->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }
//                    $user->assignRole('bteb');
//        return RedirectHelper::routeSuccess('register.step2', $message);
          return RedirectHelper::routeSuccess('login', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
        return $e;
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

    return view('site.registration.bteb', $data);
  }

//mahir
  public function isc(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> Successfully ';
      $rules = [
        'nid' => 'nullable|string',
        'name_en' => 'required|string',
        'name_bn' => 'nullable|string',
        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,


        // 'department' => 'nullable|string',

        'image' => 'nullable|mimes:png,jpg,jpeg',
      ];
      $message = $message . ' Register';
      $request->validate($rules);
      // return $request;
      $user = new User();
      try {
        $user->office = $request->office;
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
          $logo = CustomHelper::storeImage($request->file('image'), '/isc/');
          if ($logo != false) {
            $user->image = $logo;
          }
        }


        $user->status = User::$statusArrays[0];
        if ($user->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }
//                    $user->assignRole('isc');
//        return RedirectHelper::routeSuccess('register.step2', $message);
          return RedirectHelper::routeSuccess('login', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
        return $e;
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

    return view('site.registration.isc', $data);
  }

  //mahir
  public function association(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> Successfully ';
      $rules = [
        'nid' => 'nullable|string',
        'name_en' => 'required|string',
        'name_bn' => 'nullable|string',
        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,


        // 'department' => 'nullable|string',

        'image' => 'nullable|mimes:png,jpg,jpeg',
      ];
      $message = $message . ' Register';
      $request->validate($rules);
      // return $request;
      $user = new User();
      try {
        $user->office = $request->office;
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
          $logo = CustomHelper::storeImage($request->file('image'), '/association/');
          if ($logo != false) {
            $user->image = $logo;
          }
        }


        $user->status = User::$statusArrays[0];
        if ($user->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }
//                    $user->assignRole('association');
//        return RedirectHelper::routeSuccess('register.step2', $message);
          return RedirectHelper::routeSuccess('login', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
        return $e;
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

    return view('site.registration.associations', $data);
  }

//mahir
  public function industry(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> Successfully ';
      $rules = [
        'nid' => 'nullable|string',
        'name_en' => 'required|string',
        'name_bn' => 'nullable|string',
        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'website' => 'string',
          'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex . '|unique:' . with(new User)->getTable() . ',phone,',

        // 'department' => 'nullable|string',

        'image' => 'nullable|mimes:png,jpg,jpeg',
      ];
      $message = $message . ' Register';
      $request->validate($rules);
//       return $request;
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
          return RedirectHelper::routeSuccess('login', $message);
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

    return view('site.registration.industry', $data);
  }

//mahir
  public function dgnm(Request $request) {
    if ($request->isMethod('POST')) {
      $message = '<strong>Congratulations!!!</strong> Successfully ';
      $rules = [
        'nid' => 'nullable|string',
        'name_en' => 'required|string',
        'name_bn' => 'nullable|string',
        'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,',
        'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,


        // 'department' => 'nullable|string',

        'image' => 'nullable|mimes:png,jpg,jpeg',
      ];
      $message = $message . ' Register';
      $request->validate($rules);
      // return $request;
      $user = new User();
      try {
        $user->office = $request->office;
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
          $logo = CustomHelper::storeImage($request->file('image'), '/dgnm/');
          if ($logo != false) {
            $user->image = $logo;
          }
        }


        $user->status = User::$statusArrays[0];
        if ($user->save()) {
          if ($oldImage !== null && isset($logo)) {
            CustomHelper::deleteFile($oldImage);
          }
//                    $user->assignRole('dgnm');
//        return RedirectHelper::routeSuccess('register.step2', $message);
          return RedirectHelper::routeSuccess('login', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (QueryException $e) {
        return $e;
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

    return view('site.registration.dgnm', $data);
  }
  public function event_participant(Request $request) {
    // return $request;
    $data['districts'] = District::Select('id', 'name')->orderby('name', 'asc')->get();
    $data['upazilas'] = Upazila::select('id', 'name')->orderby('name', 'asc')->get();
    $data['technologies'] = Technology::select('id', 'name')->orderby('name', 'asc')->get();
    return view('site.registration.event_participant_reg', $data);

  }

  public function contact(Request $request) {
    // return $request;

    $data['institutes'] = Institute::select('id', 'name')->orderby('id', 'asc')->get();
    $data['pmus'] = User::select('id', 'name_en')->orderby('id', 'asc')->get();
    $data['technologies'] = Technology::select('id', 'name')->orderby('name', 'asc')->get();
    return view('site.contact', $data);

  }
}
