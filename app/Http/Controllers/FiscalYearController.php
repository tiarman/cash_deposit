<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\FiscalPeriod;
use App\Models\FiscalYear;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FiscalYearController extends Controller {

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
    return RedirectHelper::routeWarning('admin.fiscal.year.list', '<strong>Sorry!!!</strong> Fiscal Year not found');
  }


  public function store(Request $request) {

    $message = '<strong>Congratulations!!!</strong> Fiscal Year successfully ';
    $rules = [
      'code' => 'required|unique:' . with(new FiscalYear)->getTable() . ',code,',
      'start_date' => 'date|unique:' . with(new FiscalYear)->getTable() . ',start_date,',
      'end_date' => 'date|unique:' . with(new FiscalYear)->getTable() . ',end_date,',
      'status' => 'required|string',
    ];
    if ($request->has('id')) {
      $fiscalYear = FiscalYear::find($request->id);
      $rules['start_date'] .= $request->id;
      $rules['end_date'] .= $request->id;
      $rules['code'] .= $request->id;
      $message = $message . ' updated';
      $fiscalYear->updated_by = \auth()->id();
    } else {
      $fiscalYear = new FiscalYear();
      $message = $message . ' created';
      $fiscalYear->created_by = \auth()->id();
    }
    $request->validate($rules);

DB::beginTransaction();
    try {
      $fiscalYear->code = $request->code;
      $fiscalYear->start_date = $request->start_date;
      $fiscalYear->end_date = $request->end_date;
      $fiscalYear->status = $request->status;

      if ($fiscalYear->save()) {

        if ($fiscalYear->status === FiscalYear::$statusArrayss[1]){
          FiscalYear::where('id', '!=', $fiscalYear->id)->update(['status'=>FiscalYear::$statusArrayss[0]]);
        }

        if ($request->has('id')){
          FiscalPeriod::where('fiscal_year_id', $fiscalYear->id)->delete();
        }

        $tempDate = Carbon::parse($fiscalYear->start_date);
        $endDate = Carbon::parse($fiscalYear->end_date);
        $qut = 1;
        $count = 1;
        while ($tempDate->format('01-m-Y') !== $endDate->format('01-m-Y')){
          $fiscalPeriod = new FiscalPeriod();
          $fiscalPeriod->fiscal_year_id = $fiscalYear->id;
          $fiscalPeriod->month_name = $tempDate->format('F');
          $fiscalPeriod->start_date = $tempDate->startOfMonth()->format('Y-m-d');
          $fiscalPeriod->end_date = $tempDate->endOfMonth()->format('Y-m-d');;
          $fiscalPeriod->quarter_no = $qut;
          $fiscalPeriod->created_by = \auth()->id();
          $fiscalPeriod->save();

          $tempDate->startOfMonth()->addMonth();

          $count+=1;
          if ($count == 4){
            $count = 1;
            $qut +=1;
          }
        }
        $fiscalPeriod1 = new FiscalPeriod();
        $fiscalPeriod1->fiscal_year_id = $fiscalYear->id;
        $fiscalPeriod1->month_name = $endDate->format('F');
        $fiscalPeriod1->start_date = $endDate->startOfMonth()->format('Y-m-d');
        $fiscalPeriod1->end_date = $endDate->endOfMonth()->format('Y-m-d');;
        $fiscalPeriod1->quarter_no = $qut;
        $fiscalPeriod1->created_by = \auth()->id();
        $fiscalPeriod1->save();
        DB::commit();
        return RedirectHelper::routeSuccess('admin.fiscal.year.list', $message);
      }
      DB::rollBack();
      return RedirectHelper::backWithInput();
    } catch (QueryException $e) {
      DB::rollBack();
      return RedirectHelper::backWithInputFromException();
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
      $fiscalYear = FiscalYear::find($id);
      if ($fiscalYear->update(['status' => $status])) {
        if ($fiscalYear->status === FiscalYear::$statusArrayss[1]){
          FiscalYear::where('id', '!=', $fiscalYear->id)->update(['status'=>FiscalYear::$statusArrayss[0]]);
        }
        return 'success';
      }
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
