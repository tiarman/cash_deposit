<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\TrainingType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingTypeController extends Controller
{
    // public function index() {
    //     $data['datas'] = TrainingType::orderby('id', 'desc')->get();
    //     return view('admin.trainingType.list', $data);
    // }
    public function create() {
        $data['datas'] = TrainingType::orderby('id', 'desc')->get();
        return view('admin.trainingType.create', $data);
    }
    // public function manage($id = null) {
    //     if ($data['trainingType'] = TrainingType::find($id)) {
    //         return view('admin.trainingType.manage', $data);
    //     }
    //     return RedirectHelper::routeWarning('admin.trainingType.list', '<strong>Sorry!!!</strong> Training Type not found');
    // }


    public function store(Request $request) {
        $message = '<strong>Congratulations!!!</strong> Training Type Successfully ';
        if ($request->has('id')) {
            $trainingType = TrainingType::find($request->id);
            $rules['name'] = 'required|string|unique:' . with(new TrainingType)->getTable() . ',name,' . $request->id;
            $message = $message . ' updated';
        } else {
            $trainingType = new TrainingType();
            $rules['name'] = 'required|string|unique:' . with(new TrainingType)->getTable() . ',name';
            $message = $message . ' created';
        }
        $request->validate($rules);
        try {
            $trainingType->name = $request->name;
            if ($trainingType->save()) {
                return RedirectHelper::routeSuccess('admin.trainingType.create', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            // return $e;
            return RedirectHelper::backWithInputFromException();
        }

    }

    public function destroy(Request $request) {
        $id = $request->post('id');
        try {
            $trainingType = TrainingType::find($id);
            if ($trainingType->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }


}
