<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Helper\CustomHelper;

class CertificateController extends Controller
{
  public function index() {
    $data['datas'] = Certificate::orderby('id', 'desc')->get();
    return view('admin.trainee.certificate.list', $data);
  }

  public function create() {
    $data['certificates'] = Certificate::where('user_id',auth()->user()->id)->get();
    return view('admin.trainee.certificate.create', $data);
  }

  public function manage($id = null) {
    if ($data['certificate'] = Certificate::find($id)) {
      return view('admin.trainee.certificate.manage', $data);
    }
    return RedirectHelper::routeWarning('admin.trainee.certificate.list', '<strong>Sorry!!!</strong> Certificate not found');
  }
  public function store(Request $request) {
    $message = '<strong>Congratulations!!!</strong> Certificate successfully ';
    $rules = [
      'name' => 'required|string',
      'type' => 'required|string',
      'attachment' => 'required',
    ];
    if ($request->has('id')) {
      $certificate = Certificate::find($request->id);
      $message = $message . ' updated';
    } else {
      $certificate = new Certificate();
      $message = $message . ' created';
    }
    $request->validate($rules);
    try {
      $certificate->user_id = auth()->user()->id;
      $certificate->name = $request->name;
      $certificate->type = $request->type;
      $certificate->attachment = $request->attachment;
      if ($request->hasFile('attachment')) {
        $attachment = CustomHelper::storeImage($request->file('attachment'), '/certificate/' . now()->format('d_m_Y') . '/5/');
        if ($attachment != false) {
          $certificate->attachment = $attachment;
        }
      }
      $certificate->status = Certificate::$statusArrays[0];
      if ($certificate->save()) {
        return RedirectHelper::routeSuccess('admin.certificate.create', $message);
      }
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      return RedirectHelper::backWithInputFromException();
    }

  }

  public function destroy(Request $request) {
    $id = $request->post('id');
    try {
      $certificate = Certificate::find($id);
      if ($certificate->delete()) {
        CustomHelper::deleteFile($certificate->attachment);
        return 'success';
      }
    } catch (\Exception $e) {
    }
  }
}

