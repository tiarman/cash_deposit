<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\SubComponent;
use App\Models\Component;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubComponentController extends Controller
{
  public function index() {
    $data['datas'] = SubComponent::with('component:id,name')->orderby('name', 'desc')->get();
    return view('admin.subComponent.list', $data);
  }


  public function create() {
    $data['components'] = Component::select('id', 'name')->orderBy('name')->get();
    return view('admin.subComponent.create', $data);
  }


  public function manage($id = null) {

    if ($data['subComponent'] = SubComponent::find($id)) {
      $data['components'] = Component::select('id', 'name')->orderBy('name')->get();
      return view('admin.subComponent.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.subComponent.list', '<strong>Sorry!!!</strong> SubComponent not found');
  }


  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> SubComponent successfully ';
    if ($request->has('id')) {
      $subComponent = SubComponent::find($request->id);
      $rules['component_id'] = 'required|numeric|exists:' . with(new Component)->getTable() . ',id';
      $rules['name'] = 'required|string|unique:' . with(new SubComponent)->getTable() . ',name,' . $request->id;
      $rules['code'] = 'nullable|string';
      $message = $message . ' updated';
      $subComponent->updated_by = Auth::user()->id;
    } else {
      $subComponent = new SubComponent();
      $rules['component_id'] = 'required|numeric|exists:' . with(new Component)->getTable() . ',id';
      $rules['name'] = 'required|string|unique:' . with(new SubComponent)->getTable() . ',name';
      $rules['code'] = 'nullable|string';
      $message = $message . ' created';
      $subComponent->created_by = Auth::user()->id;
    }
    $request->validate($rules);

    try {
      $subComponent->component_id = $request->component_id;
      $subComponent->name = $request->name;
      $subComponent->code = $request->code;
      if ($subComponent->save()) {
        return RedirectHelper::routeSuccess('admin.subComponent.list', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $subComponent = SubComponent::find($id);
      if ($subComponent->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}
