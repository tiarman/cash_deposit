<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Technology;
use App\Models\Training;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TechnologyController extends Controller {

  public function create() {
    $data['datas'] = Technology::orderby('id', 'desc')->get();
    return view('admin.technologyShiftSemester.technology', $data);
  }

  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> Technology Successfully ';
    if ($request->has('id')) {
      $technology = Technology::find($request->id);

      $technology->updated_by = auth()->id();
      $rules['name'] = 'required|string|unique:' . with(new Technology())->getTable() . ',name,' . $request->id;
      $rules['updated_by'] = 'nullable';
      $rules['status'] = 'required|string';
      $message = $message . ' updated';
    } else {
      $technology = new Technology();

      $technology->created_by = auth()->id();
      $rules['name'] = 'required|string|unique:' . with(new Technology)->getTable() . ',name';
      $rules['created_by'] = 'nullable';
      $rules['status'] = 'required|string';
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $technology->name = $request->name;
      $technology->status = $request->status;
      // return $technology;
      if ($technology->save()) {
        return RedirectHelper::routeSuccess('admin.technology.create', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $technology = Technology::find($id);
      if ($technology->delete()) {
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
      $technology = Technology::find($id);
      if ($technology->update(['status' => $status])) {
        return "success";
      }
    }
  }
}
