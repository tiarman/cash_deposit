<?php

namespace App\Http\Controllers;

use App\Models\AgentInterest;
use App\Models\Deposit;
use App\Models\Marquee;
use App\Models\Payment;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(){
        $data['marquee1'] = Marquee::orderby('id', 'desc')->get();
        $user_id=app('request')->user()->id;
        $wid['wid'] = Withdraw::where('user_id',$user_id)->get();
        $data['total_withdraw'] = Withdraw::select('amount')->where('user_id', auth()->id())->where('status','accepted')->get();


//        Transaction
        $data['allDeposits'] = Deposit::where('user_id',$user_id)->get();
//        return $datas;
        $data['total_deposits'] = Deposit::select('amount')->where('user_id', auth()->id())->where('status','accepted')->get();

        // interest
        $data['interest'] = AgentInterest::select('interest_amount')->where('agent_id', auth()->id())->where('status','accepted')->get();
        // return $data['interest'];



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
