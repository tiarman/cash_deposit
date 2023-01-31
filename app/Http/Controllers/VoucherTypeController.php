<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\VoucherType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherTypeController extends Controller {

    public function index() {
        $data['datas'] = VoucherType::orderby('id', 'desc')->get();
        return view('admin.voucherType.list', $data);
    }
    public function create() {
        return view('admin.voucherType.create');
    }
    public function manage($id = null) {
        if ($data['voucherType'] = VoucherType::find($id)) {
            return view('admin.voucherType.manage', $data);
        }
        return RedirectHelper::routeWarning('admin.voucher.type.list', '<strong>Sorry!!!</strong> VoucherType not found');
    }


    public function store(Request $request) {
        $message = '<strong>Congratulations!!!</strong> Voucher Type successfully ';
        if ($request->has('id')) {
            $voucherType = VoucherType::find($request->id);
            $rules['short_name'] = 'required|string|unique:'. with(new VoucherType)->getTable() . ',short_name,';
            $rules['name'] = 'required|string|unique:' . with(new VoucherType)->getTable() . ',name,' . $request->id;
            $message = $message . ' updated';
        } else {
            $voucherType = new VoucherType();
            $rules['short_name'] = 'required|string|unique:'. with(new VoucherType)->getTable() . ',short_name,';
            $rules['name'] = 'required|string|unique:'. with(new VoucherType)->getTable() . ',name';
            $message = $message . ' created';
        }
        $request->validate($rules);


        try {
            $voucherType->name = $request->name;
            $voucherType->short_name = $request->short_name;
            if ($voucherType->save()) {
                return RedirectHelper::routeSuccess('admin.voucher.type.list', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            return RedirectHelper::backWithInputFromException();
        }

    }

    public function destroy(Request $request) {
        $id = $request->post('id');
        try {
            $voucherType = VoucherType::find($id);
            if ($voucherType->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }
}
