<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Semester;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function create(){
        $data['datas'] = Semester::orderby('id', 'desc')->get();
        return view('admin.technologyShiftSemester.Semester',$data);
    }
    public function store(Request $request) {
        $message = '<strong>Congratulations!!!</strong> Semester Successfully ';
        if ($request->has('id')) {
            $semester = Semester::find($request->id);

            $semester->updated_by = auth()->id();
            $rules['name'] = 'required|string|unique:' . with(new Semester())->getTable() . ',name,' . $request->id;
            $rules['updated_by'] = 'nullable';
            $rules['status'] = 'required|string';
            $message = $message . ' updated';
        } else {
            $semester = new Semester();

            $semester->created_by = auth()->id();
            $rules['name'] = 'required|string|unique:' . with(new Semester)->getTable() . ',name';
            $rules['created_by'] = 'nullable';
            $rules['status'] = 'required|string';
            $message = $message . ' created';
        }
        $request->validate($rules);
        try {
            $semester->name = $request->name;
            $semester->status = $request->status;
            // return $semester;
            if ($semester->save()) {
                return RedirectHelper::routeSuccess('admin.semester.create', $message);
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
            $semester = Semester::find($id);
            if ($semester->delete()) {
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
          $semester = Semester::find($id);
          if ($semester->update(['status' => $status])) {

            return "success";
          }
        }
      }
}
