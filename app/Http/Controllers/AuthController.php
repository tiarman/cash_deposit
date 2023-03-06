<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\BackgroundImage;
use App\Models\District;
use App\Models\Division;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\Marquee;
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

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string|min:' . User::$minimumPasswordLength
            ]);

            $credential = $request->only('username', 'password');

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
        $data['marquee1'] = Marquee::orderby('id', 'desc')->get();
        // return $data;
        return view('admin.auth.login', $data);
    }

    public function register(Request $request)
    {
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

    public function resetPassword(Request $request, $token)
    {
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
}
