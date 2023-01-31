<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Component;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComponentController extends Controller {

  public function index() {
    $data['datas'] = Component::with('creator:id,name_en', 'editor:id,name_en')->orderby('name', 'desc')->get();
    return view('admin.component.list', $data);
  }
  public function create() {
    return view('admin.component.create');
  }
  public function manage($id = null) {
    if ($data['component'] = Component::find($id)) {
      return view('admin.component.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.component.list', '<strong>Sorry!!!</strong> Component not found');
  }


  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> Component successfully ';
    if ($request->has('id')) {
      $component = Component::find($request->id);
      $rules['name'] = 'required|string|unique:' . with(new Component)->getTable() . ',name,' . $request->id;
      $message = $message . ' updated';
        $component->updated_by = Auth::user()->id;
    } else {
      $component = new Component();
      $rules['name'] = 'required|string|unique:' . with(new Component)->getTable() . ',name';
      $message = $message . ' created';
        $component->created_by = Auth::user()->id;
    }
    $request->validate($rules);

    try {
      $component->name = $request->name;
      $component->code = $request->code;
      if ($component->save()) {
        return RedirectHelper::routeSuccess('admin.component.list', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $component = Component::find($id);
      if ($component->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
