<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\CoreModule;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CoreModuleController extends Controller
{


    public function index()
    {
        $data['data'] = CoreModule::orderby('created_at', 'desc')->get();
        return view('admin.coremodule.list', $data);
    }


    public function create()
    {
        return view('admin.coremodule.create');
    }

    //manage

    public function manage($id = null)
    {
        if ($data['coremodule'] = CoreModule::find($id)) {
            return view('admin.coremodule.manage', $data);
        }
        return RedirectHelper::routeWarningWithParams('coremodule.list', '<strong>Sorry!!!</strong> CoreModule not found');
    }


    public function store(Request $request)
    {
//        dd($request->all());
        $message = '<strong>Congratulations!!!</strong> CoreModule successfully ';
        if ($request->has('id')) {
            $coremodule = CoreModule::find($request->id);
            $rules['name'] = 'nullable|string|max:12';
            $rules['link'] = 'nullable|string';
            $rules['image'] = 'nullable|file|mimes:png,jpg,jpeg,svg';
            $rules['status'] = ['required', 'string', Rule::in(\App\Models\CoreModule::$statusArrays)];
            $message = $message . ' updated';
        } else {
            $coremodule = new CoreModule();
            $rules['name'] = 'nullable|string|max:12';
            $rules['link'] = 'nullable|string';
            $rules['image'] = 'nullable|file|mimes:png,jpg,jpeg,svg';
            $rules['status'] = ['required', 'string', Rule::in(CoreModule::$statusArrays)];
            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $coremodule->name = $request->name;
            $coremodule->link = $request->link;
            $coremodule->status = $request->status;
            $oldImage = $coremodule->image;
//            return $coremodule;
            if ($request->hasFile('image')) {
                $logo = CustomHelper::storeImage($request->file('image'), '/coremodule/');
                if ($logo != false) {
                    $coremodule->image = $logo;
                }
            }
            if ($coremodule->save()) {
                if ($oldImage !== null && isset($logo)) {
                    CustomHelper::deleteFile($oldImage);
                }
                return RedirectHelper::routeSuccessWithParams('admin.coremodule.list', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            return RedirectHelper::backWithInputFromException();
        }

    }


    public function destroy(Request $request) {
        $id = $request->post('id');
        try {
            $user = CoreModule::find($id);
            $oldImage = $user->image;
            if ($user->delete()) {
                if ($oldImage !== null) {
                    CustomHelper::deleteFile($oldImage);
                }
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }


    /**
     * @param Request $request
     * @return string|void
     */
    public function ajaxUpdateStatus(Request $request) {
        if ($request->isMethod("POST")) {
            $id = $request->post('id');
            $postStatus = $request->post('status');
            $status = strtolower($postStatus);
            $user = CoreModule::find($id);
            if ($user->update(['status' => $status])) {
                return "success";
            }
        }
    }

}
