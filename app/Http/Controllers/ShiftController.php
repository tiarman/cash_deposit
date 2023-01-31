<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Shift;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ShiftController extends Controller {

  public function create() {
    $data['datas'] = Shift::orderby('id', 'desc')->get();
    return view('admin.technologyShiftSemester.shift', $data);
  }

  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> Shift Successfully ';
    if ($request->has('id')) {
      $shift = Shift::find($request->id);

      $shift->updated_by = auth()->id();
      $rules['name'] = 'required|string|unique:' . with(new Shift())->getTable() . ',name,' . $request->id;
      $rules['updated_by'] = 'nullable';
      $rules['status'] = 'required|string';
      $message = $message . ' updated';
    } else {
      $shift = new Shift();

      $shift->created_by = auth()->id();
      $rules['name'] = 'required|string|unique:' . with(new Shift)->getTable() . ',name';
      $rules['created_by'] = 'nullable';
      $rules['status'] = 'required|string';
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $shift->name = $request->name;
      $shift->status = $request->status;
      // return $shift;
      if ($shift->save()) {
        return RedirectHelper::routeSuccess('admin.shift.create', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return $e;
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $shift = Shift::find($id);
      if ($shift->delete()) {
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
      $shift = Shift::find($id);
      if ($shift->update(['status' => $status])) {

        return "success";
      }
    }
  }
}
