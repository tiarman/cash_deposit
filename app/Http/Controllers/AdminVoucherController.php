<?php

namespace App\Http\Controllers;

use App\Models\Marquee;
use App\Models\Voucher;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminVoucherController extends Controller
{
  public function index() {
      $data['marquee1'] = Marquee::orderby('id', 'desc')->get();
      $data['datas'] = Voucher::with('institute', 'year', 'type')->get();
    return view('admin.voucher.listAll', $data);
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
}
