<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Division;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DivisionController extends Controller {

  public function index() {
    $data['datas'] = Division::orderby('name', 'desc')->get();
    return view('admin.division.list', $data);
  }


  public function create() {
    return view('admin.division.create');
  }


  public function manage($id = null) {
    if (in_array($id, [1, 2, 3])) {
      return RedirectHelper::routeWarning('admin.division.list', '<strong>Sorry!!!</strong> Division update not possible');
    }
    if ($data['division'] = Division::find($id)) {
      return view('admin.division.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.division.list', '<strong>Sorry!!!</strong> Division not found');
  }


  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> Division successfully ';
    if ($request->has('id')) {
      $division = Division::find($request->id);
      $rules['name'] = 'required|string|unique:' . with(new Division)->getTable() . ',name,' . $request->id;
      $rules['name_bn'] = 'nullable|string|unique:' . with(new Division)->getTable() . ',name_bn,' . $request->id;
      $rules['url'] = 'nullable|string';
      $message = $message . ' updated';
    } else {
      $division = new Division();
      $rules['name'] = 'required|string|unique:' . with(new Division)->getTable() . ',name';
      $rules['name_bn'] = 'nullable|string|unique:' . with(new Division)->getTable() . ',name_bn';
      $rules['url'] = 'nullable|string';
      $message = $message . ' created';
    }
    $request->validate($rules);

    try {
      $division->name = $request->name;
      $division->name_bn = $request->name_bn;
      $division->url = $request->url;
      if ($division->save()) {
        return RedirectHelper::routeSuccess('admin.division.list', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $division = Division::find($id);
      if ($division->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
