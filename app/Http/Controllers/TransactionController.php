<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Payment;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(){
        $user_id=app('request')->user()->id;
//        $activewith = Withdraw::select(DB::raw("SUM(`amount`) as `sum_total`"))
//            ->where('status', '=', Withdraw::$statusArrays[1])->groupby('withdraw_id')->where('user_id',$user_id)->get();
//        $data['sum_total'] = $activewith[0]['sum_total'] ?? "";
//        $data['user'] = User::whereHas('roles',function( $user){$user->where('roles.name','Agent','Sub Agent');})->first();
//        $data['bkash'] = Payment::where('name','bkash personal')->get();



        $wid['wid'] = Withdraw::where('user_id',$user_id)->get();
//        return $wid;
        $data['total_withdraw'] = Withdraw::select('amount')->where('user_id', auth()->id())->where('status','accepted')->get();


//        Transaction
        $data['allDeposits'] = Deposit::where('user_id',$user_id)->get();
//        return $datas;
        $data['total_deposits'] = Deposit::select('amount')->where('user_id', auth()->id())->where('status','accepted')->get();



//        $data = Withdraw::table('users')->join('state', 'state.country_id', '=', 'country.country_id')
//            ->join('city', 'city.state_id', '=', 'state.state_id')
//            ->get(['country.country_name', 'state.state_name', 'city.city_name']);



//        return $datas;
//        $datas = DB::table('withdraws')
//
//            ->select('withdraws.withdraw_id','withdraws.transaction_type','deposits.transaction_id')
//
//            ->join('deposits','deposits.id','=','withdraws.id')
//
////            ->where(['something' => 'something', 'otherThing' => 'otherThing'])
//
//            ->get();
//        return $datas;

        return view('admin.cash.transaction', $data, $wid);

    }
}
