<?php

namespace App\Http\Controllers\Institute;

use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Models\InstituteType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class InstituteTypeController extends Controller
{

  public function create()
  {
    $data['datas'] = InstituteType::with('createdBy', 'updatedBy')->get();
    return view('admin.instituteType.create', $data);
  }

  public function store(Request $request) {
    if($request->ajax()){
      $instituteTypes = InstituteType::find($request->id);
      if($instituteTypes){
        return response()->json($instituteTypes,200);
      }else{
        $errors = "Something went wrong!";
        return response()->json(['errors' => $errors],200);

      }
    }
    $message = '<strong>Congratulations!!!</strong> Institute Type successfully ';
    if ($request->has('id')) {
      $instituteType = InstituteType::find($request->id);
      $instituteType->updated_by = auth()->id();
      $rules['name'] = 'required|string|unique:' . with(new InstituteType())->getTable() . ',name,' . $request->id;
      $message = $message . ' updated';
    } else {
      $instituteType = new InstituteType();
      $instituteType->created_by = auth()->id();
      $rules['name'] = 'required|string|unique:' . with(new InstituteType())->getTable() . ',name,' . $request->id;
      $message = $message . ' created';
    }
    $request->validate($rules);

    try {
      $instituteType->name = $request->name;
      if ($instituteType->save()) {
        return RedirectHelper::routeSuccess('admin.institute.type.create', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $type = InstituteType::find($id);
      if ($type->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
