<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\FiscalYear;
use App\Models\FiscalPeriod;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FiscalPeriodController extends Controller
{
    public function index() {
        $data['datas'] = FiscalPeriod::with('fiscalYear:id,code')->orderby('created_at', 'desc')->get();
        return view('admin.fiscalPeriod.list', $data);
    }


    public function create() {
        $data['fiscalYears'] = FiscalYear::select('id', 'code')->orderBy('code')->get();
        return view('admin.fiscalPeriod.create', $data);
    }


    public function manage($id = null) {
//        if (in_array($id, [1, 2, 3])) {
//            return RedirectHelper::routeWarning('admin.fiscalPeriod.list', '<strong>Sorry!!!</strong> Fiscal Period update not possible');
//        }
        if ($data['fiscalPeriod'] = FiscalPeriod::find($id)) {
            $data['fiscalYears'] = FiscalYear::select('id', 'code')->orderBy('code')->get();
            return view('admin.fiscalPeriod.manage', $data);
        }
        return RedirectHelper::routeWarning('admin.fiscalPeriod.list', '<strong>Sorry!!!</strong> Fiscal Period not found');
    }


    public function store(Request $request) {
        $message = '<strong>Congratulations!!!</strong> Fiscal Period successfully ';
        $rules = [
            'fiscal_year_id' => 'required|numeric|exists:' . with(new FiscalYear)->getTable() . ',id',
            'start_date' => 'required|date:' . with(new FiscalPeriod)->getTable() . ',start_date,',
            'end_date' => 'nullable|date',
            'month_name' => 'nullable|string',
            'quarter_no' => 'nullable|numeric',
        ];

        if ($request->has('id')) {
            $fiscalPeriod = FiscalPeriod::find($request->id);
            $rules['start_date'] .= $request->id;
            $message = $message . ' updated';
            $fiscalPeriod->updated_by = \auth()->id();
        } else {
            $fiscalPeriod = new FiscalPeriod();
            $message = $message . ' created';
            $fiscalPeriod->created_by = \auth()->id();
        }
        $request->validate($rules);

        try {
            $fiscalPeriod->fiscal_year_id = $request->fiscal_year_id;
            $fiscalPeriod->start_date = $request->start_date;
            $fiscalPeriod->end_date = $request->end_date;
            $fiscalPeriod->month_name = $request->month_name;
            $fiscalPeriod->quarter_no = $request->quarter_no;
            if ($fiscalPeriod->save()) {
                return RedirectHelper::routeSuccess('admin.fiscalPeriod.list', $message);
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
            $fiscalPeriod = FiscalPeriod::find($id);
            if ($fiscalPeriod->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }
}
