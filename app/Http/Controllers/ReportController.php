<?php

namespace App\Http\Controllers;

use App\Models\SubsidiaryComponent;
use App\Models\Voucher;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function subsidiaryComponentCodeWiseReport(Request $request)
    {
        if (!empty($request->from_date) && !empty($request->to_date)) {
            $report = SubsidiaryComponent::whereHas('voucherinfo')->with('voucherinfo', 'component')->whereBetween('created_at', [$request->from_date, $request->to_date])->get()->groupBy('code')->map(function ($item) {
                return $item->groupBy('component_id');
            });
        } else {
            $report = SubsidiaryComponent::whereHas('voucherinfo')->with('voucherinfo', 'component')->get()->groupBy('code')->map(function ($item) {
                return $item->groupBy('component_id');
            });
        }
//        return $report;
        return view('admin.report.subsidiary-component-code-wise', compact('report'));
    }

    public function subsidiaryComponentQuarterWiseReport(Request $request)
    {
        if (!empty($request->from_date) && !empty($request->to_date)) {
            $report = SubsidiaryComponent::whereHas('voucherinfo')->with('voucherinfo', 'component')->whereBetween('created_at', [$request->from_date, $request->to_date])->get()->groupBy('code')->map(function ($item) {
                return $item->groupBy('component_id');
            });
        } else {
            $report = Voucher::with('details.subsidaryComponent.component')->get()->groupBy('fiscal_year_id')->map(function ($voucher){
                return $voucher->groupBy('quarter')
                ->map(function ($sVoucher){
                    $data = [];
                    foreach ($sVoucher as $ssVoucher){
                        foreach($ssVoucher->details as $ss){
                            $newSTD = new \stdClass();
                            $newSTD->dr_amount = $ss->dr_amount;
                            $newSTD->cr_amount = $ss->cr_amount;
                            $newSTD->code = $ss->subsidaryComponent?->code;
                            $newSTD->component = $ss->subsidaryComponent?->component?->name;
                            $newSTD->component_id = $ss->subsidaryComponent?->component_id;
                            $data[] = $newSTD;
                        }
                    }
                    return collect($data)->groupBy('code')->map(function ($item) {
                    return $item->groupBy('component');
                });
                });
            });

        }
//        return $report;
        return view('admin.report.subsidiary-component-quarter-wise', compact('report'));
    }
}
