<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\TrainingBatch;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TrainingBatchController extends Controller {

  public function index() {
    $data['datas'] = TrainingBatch::orderby('name', 'desc')->where('user_id',auth()->id())->get();
    return view('admin.trainingBatch.list', $data);
  }


  public function create() {
    return view('admin.trainingBatch.create');
  }


  public function manage($id = null) {

    if ($data['trainingBatch'] = TrainingBatch::find($id)) {
      return view('admin.trainingBatch.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.training.batch.list', '<strong>Sorry!!!</strong> TrainingBatch not found');
  }


  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> TrainingBatch successfully ';
    if ($request->has('id')) {
      $trainingBatch = TrainingBatch::find($request->id);
      $rules['name'] = 'required|string|unique:' . with(new TrainingBatch)->getTable() . ',name,' . $request->id;
      $message = $message . ' updated';
    } else {
      $trainingBatch = new TrainingBatch();
      $rules['name'] = 'required|string';
      $message = $message . ' created';
    }
    $request->validate($rules);

    try {
      $trainingBatch->user_id = auth()->id();
      $trainingBatch->name = $request->name;
      if ($trainingBatch->save()) {
        return RedirectHelper::routeSuccess('admin.training.batch.list', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $trainingBatch = TrainingBatch::find($id);
      if ($trainingBatch->delete()) {
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }

    public function assignToBatch(Request $request)
    {
        return $request;
    }
}
