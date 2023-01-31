<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\District;
use App\Models\Division;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
  public function index() {
    $data['datas'] = District::with('division:id,name')->orderby('name', 'desc')->get();
    return view('admin.district.list', $data);
  }


  public function create() {
    $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
    return view('admin.district.create', $data);
  }


  public function manage($id = null) {
    if (in_array($id, [1, 2, 3])) {
      return RedirectHelper::routeWarning('admin.district.list', '<strong>Sorry!!!</strong> District update not possible');
    }
    if ($data['district'] = District::find($id)) {
      $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
      return view('admin.district.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.district.list', '<strong>Sorry!!!</strong> District not found');
  }


  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> District successfully ';
    if ($request->has('id')) {
      $district = District::find($request->id);
      $rules['division_id'] = 'required|numeric|exists:' . with(new Division)->getTable() . ',id';
      $rules['name'] = 'required|string|unique:' . with(new District)->getTable() . ',name,' . $request->id;
      $rules['name_bn'] = 'nullable|string|unique:' . with(new District)->getTable() . ',name_bn,' . $request->id;
      $rules['url'] = 'nullable|string';
      $message = $message . ' updated';
    } else {
      $district = new District();
      $rules['division_id'] = 'required|numeric|exists:' . with(new Division)->getTable() . ',id';
      $rules['name'] = 'required|string|unique:' . with(new District)->getTable() . ',name';
      $rules['name_bn'] = 'nullable|string|unique:' . with(new District)->getTable() . ',name_bn';
      $rules['url'] = 'nullable|string';
      $message = $message . ' created';
    }
    $request->validate($rules);

    try {
      $district->division_id = $request->division_id;
      $district->name = $request->name;
      $district->name_bn = $request->name_bn;
      $district->url = $request->url;
      if ($district->save()) {
        return RedirectHelper::routeSuccess('admin.district.list', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $district = District::find($id);
      if ($district->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
