<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\FiscalPeriod;
use App\Models\FiscalYear;
use App\Models\SubComponent;
use App\Models\SubsidiaryComponent;
use App\Models\Voucher;
use App\Models\VoucherDetails;
use App\Models\VoucherType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller {

  public function index() {
    $data['datas'] = Voucher::with('institute', 'year', 'type')->where('institute_id', auth()->user()->institute_id)->get();
    return view('admin.voucher.list', $data);
  }

  public function create(Request $request, $id = 0) {
    if (!($fiscalYear = FiscalYear::where('status', FiscalYear::$statusArrayss[1])->first())) {
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Fiscal year not found.');
    }
    if (!($period = FiscalPeriod::where('fiscal_year_id', $fiscalYear->id)->where('month_name', now()->format('F'))->first())) {
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Fiscal period not found.');
    }

    if ($request->isMethod('POST')) {
      $vType = VoucherType::find($request->type);
      DB::beginTransaction();
      try {

        $voucher = new Voucher();
        $voucher->institute_id = auth()->user()->institute_id;
        $voucher->fiscal_year_id = $fiscalYear->id;
        $voucher->voucher_type_id = $vType->id;
        $voucher->fiscal_period_id = $period->id;
        $voucher->quarter = $period->quarter_no;
        $voucher->amount = 0;
        $voucher->narration = '';
        $voucher->statue = Voucher::$statusArrays[0];
        $voucher->created_by = auth()->id();
        if ($voucher->save()) {
          $subsidary = SubsidiaryComponent::with('subcomponent:id,component_id,name')->find($request->dr_component);
//          return $subsidary;
          $vDetails = new VoucherDetails();
          $vDetails->voucher_id = $voucher->id;
          $vDetails->component_id = $subsidary->subcomponent->component_id;
          $vDetails->sub_component_id = $subsidary->sub_component_id;
          $vDetails->subsidiary_component_id = $request->dr_component;
          $vDetails->type = 'DR';
          $vDetails->dr_amount = $request->amount;
//          $vDetails->cr_amount = '';
          $vDetails->order = 1;
//          $vDetails->cheque_no = '';
//          $vDetails->cheque_date = '';
//          $vDetails->cheque_amount = '';
          $vDetails->statue = VoucherDetails::$statusArrays[0];
          $vDetails->created_by = auth()->id();
          $vDetails->save();
//          $vDetails->updated_by = '';

          $crSubsidary = SubsidiaryComponent::with('subcomponent:id,component_id,name')->find($request['cr_component']);
//          return $subsidary;
          $crVDetails = new VoucherDetails();
          $crVDetails->voucher_id = $voucher->id;
          $crVDetails->component_id = $crSubsidary->subcomponent->component_id;
          $crVDetails->sub_component_id = $crSubsidary->sub_component_id;
          $crVDetails->subsidiary_component_id = $request['cr_component'];
          $crVDetails->type = 'CR';
//          $crVDetails->dr_amount = $request['amount'][$k];
          $crVDetails->cr_amount = $request['amount'];
          $crVDetails->order = 2;
          $crVDetails->cheque_no = $request['cheque_no'] ?? null;
          $crVDetails->cheque_date = $request['date'] ?? null;
          $crVDetails->cheque_amount = $request['amount'] ?? null;
          $crVDetails->statue = VoucherDetails::$statusArrays[0];
          $crVDetails->created_by = auth()->id();
          $crVDetails->save();

          $voucher->no = $this->createVoucherNo($voucher->id, $fiscalYear->code, $vType->short_name);
          $voucher->amount = $request['amount'];
          $voucher->save();
          DB::commit();
          return RedirectHelper::routeSuccessWithParams('admin.voucher.manage', '<strong>Congratulations!!!</strong>Voucher successfully created.', ['id'=>$voucher->id]);
        }
        DB::rollBack();
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
      } catch (\Exception $e) {
        DB::rollBack();
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');

      }

    }

    $data['types'] = VoucherType::select('id', 'name', 'short_name')->get();
    $data['subcomponents'] = SubComponent::with('component:id,name', 'subsidiaries:id,sub_component_id,code,name')
      ->whereHas('subsidiaries')->select('id', 'component_id', 'name', 'code')->get();
    return view('admin.voucher.createNew', $data);
  }


  public function manage(Request $request, $id = 0) {
    if (!($fiscalYear = FiscalYear::where('status', FiscalYear::$statusArrayss[1])->first())) {
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Fiscal year not found.');
    }
    if (!($voucher = Voucher::where('id', $id)->where('created_by', auth()->id())->first())) {
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Fiscal year not found.');
    }

    if ($request->isMethod('POST')) {
      DB::beginTransaction();
      try {
        $order = 0;
        $totalAmount = 0;
        foreach ($voucher->details as $details) {
          if ($order < $details->order) {
            $order = $details->order;
          }
          if ($details->type == 'DR') {
            $totalAmount = ($totalAmount+$details->dr_amount);
          }
        }
        $subsidary = SubsidiaryComponent::with('subcomponent:id,component_id,name')->find($request->dr_component);
//          return $subsidary;
        $vDetails = new VoucherDetails();
        $vDetails->voucher_id = $voucher->id;
        $vDetails->component_id = $subsidary->subcomponent->component_id;
        $vDetails->sub_component_id = $subsidary->sub_component_id;
        $vDetails->subsidiary_component_id = $request->dr_component;
        $vDetails->type = 'DR';
        $vDetails->dr_amount = $request->amount;
//          $vDetails->cr_amount = '';
        $vDetails->order = ($order+1);
//          $vDetails->cheque_no = '';
//          $vDetails->cheque_date = '';
//          $vDetails->cheque_amount = '';
        $vDetails->statue = VoucherDetails::$statusArrays[0];
        $vDetails->created_by = auth()->id();
        $vDetails->save();
//          $vDetails->updated_by = '';

        $crSubsidary = SubsidiaryComponent::with('subcomponent:id,component_id,name')->find($request['cr_component']);
//          return $subsidary;
        $crVDetails = new VoucherDetails();
        $crVDetails->voucher_id = $voucher->id;
        $crVDetails->component_id = $crSubsidary->subcomponent->component_id;
        $crVDetails->sub_component_id = $crSubsidary->sub_component_id;
        $crVDetails->subsidiary_component_id = $request['cr_component'];
        $crVDetails->type = 'CR';
//          $crVDetails->dr_amount = $request['amount'][$k];
        $crVDetails->cr_amount = $request['amount'];
        $crVDetails->order = ($vDetails->order+1);
        $crVDetails->cheque_no = $request['cheque_no'] ?? null;
        $crVDetails->cheque_date = $request['date'] ?? null;
        $crVDetails->cheque_amount = $request['amount'] ?? null;
        $crVDetails->statue = VoucherDetails::$statusArrays[0];
        $crVDetails->created_by = auth()->id();
        $crVDetails->save();

        $voucher->amount = $totalAmount;
        $voucher->save();
        DB::commit();
        return RedirectHelper::back('<strong>Congratulations!!!</strong>Voucher successfully created.');
      } catch (\Exception $e) {
        DB::rollBack();
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');

      }

    }
    $data['voucher'] = $voucher;
    $data['types'] = VoucherType::select('id', 'name', 'short_name')->get();
    $data['subcomponents'] = SubComponent::with('component:id,name', 'subsidiaries:id,sub_component_id,code,name')
      ->whereHas('subsidiaries')->select('id', 'component_id', 'name', 'code')->get();
    return view('admin.voucher.manageNew', $data);
  }

  public function view($id) {
    if ($voucher = Voucher::with('institute:id,name,phone,email', 'year:id,start_date,code', 'type:id,short_name,name', 'creator:id,name_en,email,phone', 'details.component:id,name', 'details.subComponent:id,name', 'details.subsidaryComponent:id,name')->findOrFail($id)) {
      if (\request('print') == 'pdf') {
        ini_set('max_execution_time', 600);
        $data['voucher'] = $voucher;
//        return view('pdf.voucherDetails', $data);
        return Pdf::loadView('pdf.voucherDetails', $data)->setPaper('a4')
//          ->stream('Voucher ' . $voucher->no . ' (' . now()->format('d_m_Y h_i_A') . ').pdf');
          ->download('Voucher ' . $voucher->no . ' (' . now()->format('d_m_Y h_i_A') . ').pdf');
      }
      return view('admin.voucher.view', compact('voucher'));
    }
  }

  /**
   * @param $id
   * @param $typeCode
   * @return string
   */
  private function createVoucherNo($id, $yearCode, $typeCode): string {
    return $yearCode . '-' . $typeCode . '-' . CustomHelper::fillLeft($id);
  }

  public function store(Request $request) {
//    return $request;
    if ($request->isMethod('POST'))
      $vType = VoucherType::find($request->type);
    $fiscalYear = FiscalYear::where('status', FiscalYear::$statusArrayss[1])->first();

    DB::beginTransaction();
    try {
      $voucher = new Voucher();
      $voucher->institute_id = auth()->user()->institute_id;
      $voucher->fiscal_year_id = $fiscalYear->id;
      $voucher->voucher_type_id = $vType->id;
      $voucher->amount = 0;
      $voucher->narration = '';
      $voucher->statue = Voucher::$statusArrays[0];
      $voucher->created_by = auth()->id();
      if ($voucher->save()) {
        $total = 0;
        foreach ($request->dr_component as $k => $dr) {
          $subsidary = SubsidiaryComponent::with('subcomponent:id,component_id,name')->find($dr);
//          return $subsidary;
          $vDetails = new VoucherDetails();
          $vDetails->voucher_id = $voucher->id;
          $vDetails->component_id = $subsidary->subcomponent->component_id;
          $vDetails->sub_component_id = $subsidary->sub_component_id;
          $vDetails->subsidiary_component_id = $dr;
          $vDetails->type = 'DR';
          $vDetails->dr_amount = $request['amount'][$k];
//          $vDetails->cr_amount = '';
          $vDetails->order = $k;
//          $vDetails->cheque_no = '';
//          $vDetails->cheque_date = '';
//          $vDetails->cheque_amount = '';
          $vDetails->statue = VoucherDetails::$statusArrays[0];
          $vDetails->created_by = auth()->id();
          $vDetails->save();
//          $vDetails->updated_by = '';

          $crSubsidary = SubsidiaryComponent::with('subcomponent:id,component_id,name')->find($request['cr_component'][$k]);
//          return $subsidary;
          $crVDetails = new VoucherDetails();
          $crVDetails->voucher_id = $voucher->id;
          $crVDetails->component_id = $crSubsidary->subcomponent->component_id;
          $crVDetails->sub_component_id = $crSubsidary->sub_component_id;
          $crVDetails->subsidiary_component_id = $request['cr_component'][$k];
          $crVDetails->type = 'CR';
//          $crVDetails->dr_amount = $request['amount'][$k];
          $crVDetails->cr_amount = $request['amount'][$k];
          $crVDetails->order = (count($request['cr_component']) + $k);
          $crVDetails->cheque_no = $request['cheque_no'][$k] ?? null;
          $crVDetails->cheque_date = $request['date'][$k] ?? null;
          $crVDetails->cheque_amount = $request['amount'][$k] ?? null;
          $crVDetails->statue = VoucherDetails::$statusArrays[0];
          $crVDetails->created_by = auth()->id();
          $crVDetails->save();
          $total = ($total + $request['amount'][$k]);
        }
        $voucher->no = $this->createVoucherNo($voucher->id, $fiscalYear->code, $vType->short_name);
        $voucher->amount = $total;
        $voucher->save();
        DB::commit();
        return RedirectHelper::routeSuccess('admin.voucher.list', '<strong>Congratulations!!!</strong>Voucher successfully created.');
      }
      DB::rollBack();
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
    } catch (\Exception $e) {
      DB::rollBack();
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');

    }
  }
}
