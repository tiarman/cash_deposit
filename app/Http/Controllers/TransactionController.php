<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(){
        $user_id=app('request')->user()->id;
        $activewith = Withdraw::select(DB::raw("SUM(`amount`) as `sum_total`"))
            ->where('status', '=', Withdraw::$statusArrays[1])->groupby('withdraw_id')->where('user_id',$user_id)->get();
        $data['sum_total'] = $activewith[0]['sum_total'] ?? "";

        $data['user'] = User::whereHas('roles',function( $user){$user->where('roles.name','Agent','Sub Agent');})->first();
        $data['bkash'] = Payment::where('name','bkash personal')->get();
        $wid['wid'] = Withdraw::where('user_id',$user_id)->get();
        $data['total_withdraw'] = Withdraw::select('amount')->where('user_id', auth()->id())->where('status','accepted')->get();

        return view('admin.cash.transaction', $data, $wid);

    }
}
