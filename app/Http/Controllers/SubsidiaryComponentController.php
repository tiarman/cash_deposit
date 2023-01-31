<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Component;
use App\Models\SubComponent;
use App\Models\SubsidiaryComponent;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubsidiaryComponentController extends Controller
{
    public function index() {
        $data['datas'] = SubsidiaryComponent::with('subComponent:id,name')->orderby('name', 'desc')->get();
        return view('admin.subsidiaryComponent.list', $data);
    }


    public function create() {
        $data['components'] = Component::with('subcomponents:id,component_id,name,code')->select('id', 'name', 'code')->orderBy('name')->get();
        return view('admin.subsidiaryComponent.create', $data);
    }


    public function manage($id = null) {

        if ($data['subsidiaryComponent'] = SubsidiaryComponent::find($id)) {
          $data['components'] = Component::with('subcomponents:id,component_id,name,code')->select('id', 'name', 'code')->orderBy('name')->get();
            return view('admin.subsidiaryComponent.manage', $data);
        }
        return RedirectHelper::routeWarning('admin.subsidiaryComponent.list', '<strong>Sorry!!!</strong> SubsidiaryComponent not found');
    }


    public function store(Request $request) {
        $message = '<strong>Congratulations!!!</strong> SubsidiaryComponent successfully ';
        $componentid = SubComponent::find($request->sub_component_id);
        if ($request->has('id')) {
            $subsidiaryComponent = SubsidiaryComponent::find($request->id);
            $rules['sub_component_id'] = 'required|numeric|exists:' . with(new SubComponent)->getTable() . ',id';
            $rules['name'] = 'required|string|unique:' . with(new SubsidiaryComponent)->getTable() . ',name,' . $request->id;
            $rules['code'] = 'nullable|string';
            $message = $message . ' updated';
            $subsidiaryComponent->updated_by = Auth::user()->id;
        } else {
            $subsidiaryComponent = new SubsidiaryComponent();
            $rules['sub_component_id'] = 'required|numeric|exists:' . with(new SubComponent)->getTable() . ',id';
            $rules['name'] = 'required|string|unique:' . with(new SubsidiaryComponent)->getTable() . ',name';
            $rules['code'] = 'nullable|string';
            $message = $message . ' created';
            $subsidiaryComponent->created_by = Auth::user()->id;
        }
        $request->validate($rules);

        try {
            $subsidiaryComponent->component_id = $componentid->component_id;
            $subsidiaryComponent->sub_component_id = $request->sub_component_id;
            $subsidiaryComponent->name = $request->name;
            $subsidiaryComponent->code = $request->code;
            if ($subsidiaryComponent->save()) {
                return RedirectHelper::routeSuccess('admin.subsidiaryComponent.list', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            return RedirectHelper::backWithInputFromException();
        }

    }

    public function destroy(Request $request) {
        $id = $request->post('id');
        try {
            $subsidiaryComponent = SubsidiaryComponent::find($id);
            if ($subsidiaryComponent->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }
}
