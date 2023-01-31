<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\Education;
use App\Models\User;
use App\Rules\MaxWordsRule;
use App\Rules\MinWordsRule;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EducationController extends Controller
{
  public function index() {
    $data['datas'] = Education::orderby('id', 'desc')->get();
    return view('admin.trainee.education.list', $data);
  }

  public function create() {
    $data['educations'] = Education::where('user_id',auth()->user()->id)->get();
    return view('admin.trainee.education.create', $data);
  }


  public function manage($id = null) {
    if ($data['education'] = Education::find($id)) {
      return view('admin.trainee.education.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.trainee.education.list', '<strong>Sorry!!!</strong> Education not found');
  }


  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> Education successfully ';

    $rules = [
      'exam_name' => 'required|string',
      'institute' => 'required|string',
      'board' => 'required|string',
      'department' => 'required|string',
      'year' => 'required|string',
    ];
    if ($request->has('id')) {
      $education = Education::find($request->id);
      $message = $message . ' updated';
    } else {
      $education = new Education();
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $education->user_id = auth()->user()->id;
      $education->exam_name = $request->exam_name;
      $education->institute = $request->institute;
      $education->board = $request->board;
      $education->department = $request->department;
      $education->year = $request->year;
      $education->status = Education::$statusArrays[0];
      if ($education->save()) {
        return RedirectHelper::routeSuccess('admin.education.create', $message);
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
      $education = Education::find($id);
      if ($education->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}

