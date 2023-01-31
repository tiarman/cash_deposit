<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\FiscalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FiscalBudgetController extends Controller
{
    public function index() {
        $data['datas'] = FiscalYear::with('creator:id,name_en', 'editor:id,name_en')->orderby('id', 'desc')->get();
        return view('admin.fiscalYear.list', $data);
    }


    public function create() {
        return view('admin.fiscalYear.create');
    }


    public function manage($id = null) {
        if ($data['fiscalYear'] = FiscalYear::find($id)) {
            return view('admin.fiscalYear.manage', $data);
        }
        return RedirectHelper::routeWarning('admin.fiscalYear.list', '<strong>Sorry!!!</strong> FiscalYear not found');
    }


    public function store(Request $request) {

        $message = '<strong>Congratulations!!!</strong> Fiscal Year successfully ';
        $rules = [
            'code' => 'required|unique:' . with(new FiscalYear)->getTable() . ',code,',
            'start_date' => 'date|before:end_date',
            'end_date' => 'date|after:start_date',
            'status' => 'required|string',
        ];
        if ($request->has('id')) {
            $fiscalYear = FiscalYear::find($request->id);
            $rules['code'] .= $request->id;
            $message = $message . ' updated';
            $fiscalYear->updated_by = \auth()->id();
        } else {
            $fiscalYear = new FiscalYear();
            $message = $message . ' created';
            $fiscalYear->created_by = \auth()->id();
        }
        $request->validate($rules);


        try {
            $fiscalYear->code = $request->code;
            $fiscalYear->start_date = $request->start_date;
            $fiscalYear->end_date = $request->end_date;
            $fiscalYear->status = $request->status;
            if ($fiscalYear->save()) {
                return RedirectHelper::routeSuccess('admin.fiscalYear.list', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            return RedirectHelper::backWithInputFromException();
        }

    }

    public function destroy(Request $request) {
        $id = $request->post('id');
        try {
            $fiscalYear = FiscalYear::find($id);
            if ($fiscalYear->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }
}
