<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\Division;
use App\Models\District;
use App\Models\Education;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class TraineeController extends Controller
{
  public function view() {
    if ($data['user'] = User::find( auth()->user()->id)) {
      $data['divisions'] = Division::orderby('name', 'asc')->get();
      $data['districts'] = District::with('districts')->select('id', 'name')->orderby('name', 'asc')->get();
//      $data['companies'] = Company::select('id', 'name_en')->orderby('name_en', 'asc')->get();
//      $data['designations'] = Designation::select('id', 'name')->orderby('name', 'asc')->get();
//      return $data;
      return view('admin.trainee.view', $data);
    }
    return RedirectHelper::routeWarning('admin.dashboard', '<strong>Sorry!!!</strong> User not found');
  }

  public function update(Request $request)
  {
    $message = '<strong>Congratulations!!!</strong> User successfully ';
      $user = User::find(auth()->user()->id);
//      $rules['username'] = 'required|string|unique:' . with(new User)->getTable() . ',username,';
    $rules = [
      'name_en' => 'required|string',
      'name_bn' => 'nullable|string',
      'father_name' => 'nullable|string',
      'mother_name' => 'nullable|string',
//      'email' => 'required|unique:' . with(new User)->getTable() . ',email,',
//      'phone' => 'required|unique:' . with(new User)->getTable() . ',phone,',
      'nid ' => 'nullable|unique',
      'dob ' => 'nullable|string',
      'alt_phone' => 'nullable|string|regex:' . CustomHelper::PhoneNoRegex ,
      'village' => 'nullable|string',
      'ps' => 'nullable|string',
      'po' => 'nullable|string',
      'division_id' => 'nullable|numeric|exists:' .with(new Division)->getTable() . ',id',
      'district_id' => 'nullable|numeric|exists:' .with(new District)->getTable() . ',id',
    ];

      $message = $message . ' created';
    $request->validate($rules);
    try {
      $user->name_en = $request->name_en;
      $user->name_bn = $request->name_bn;
//      $user->username = $request->username;
      $user->father_name = $request->father_name;
      $user->mother_name = $request->mother_name;
//      $user->email = $request->email;
//      $user->phone = $request->phone;
      $user->nid = $request->nid;
      $user->alt_phone = $request->alt_phone;
      $user->village = $request->village;
      $user->ps = $request->ps;
      $user->po = $request->po;
      $user->dob = $request->dob;
      $user->district_id = $request->district_id;
      $user->division_id = $request->division_id;
      if ($user->save()) {
        return RedirectHelper::routeSuccess('admin.trainee.view', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }
}
