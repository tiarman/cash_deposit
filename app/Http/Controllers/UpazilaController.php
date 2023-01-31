<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
  public function index() {
    $data['datas'] = Upazila::with('district:id,name')->orderby('name', 'desc')->get();
    return view('admin.upazila.list', $data);
  }


  public function create() {
    $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
    return view('admin.upazila.create', $data);
  }


  public function manage($id = null) {
    if (in_array($id, [1, 2, 3])) {
      return RedirectHelper::routeWarning('admin.upazila.list', '<strong>Sorry!!!</strong> District update not possible');
    }
    if ($data['upazila'] = Upazila::find($id)) {
      $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
      return view('admin.upazila.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.upazila.list', '<strong>Sorry!!!</strong> District not found');
  }


  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> District successfully ';
    if ($request->has('id')) {
      $upazila = Upazila::find($request->id);
      $rules['district_id'] = 'required|numeric|exists:' . with(new District)->getTable() . ',id';
      $rules['name'] = 'required|string|unique:' . with(new Upazila)->getTable() . ',name,' . $request->id;
      $rules['name_bn'] = 'nullable|string|unique:' . with(new Upazila)->getTable() . ',name_bn,' . $request->id;
      $rules['url'] = 'nullable|string';
      $message = $message . ' updated';
    } else {
      $upazila = new Upazila();
      $rules['district_id'] = 'required|numeric|exists:' . with(new District)->getTable() . ',id';
      $rules['name'] = 'required|string|unique:' . with(new Upazila)->getTable() . ',name';
      $rules['name_bn'] = 'nullable|string|unique:' . with(new Upazila)->getTable() . ',name_bn';
      $rules['url'] = 'nullable|string';
      $message = $message . ' created';
    }
    $request->validate($rules);

    try {
      $upazila->district_id = $request->district_id;
      $upazila->name = $request->name;
      $upazila->name_bn = $request->name_bn;
      $upazila->url = $request->url;
      if ($upazila->save()) {
        return RedirectHelper::routeSuccess('admin.upazila.list', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $upazila = Upazila::find($id);
      if ($upazila->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
