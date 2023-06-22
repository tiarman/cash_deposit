<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Mail\MyDemoMail;
use App\Models\AgentInterest;
use App\Models\Deposit;
use App\Models\Marquee;
use App\Models\Payment;
use App\Models\Payment_number;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Mail;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrIndex(Request $request)
    {

        // for deposit only admin selected method can be load
        $data['user'] = User::whereHas('roles', function ($user) {
            $user->where('roles.name', 'Super Admin');
        })->first();
        $adminId = $data['user']->id;

        $data['payment_numbers'] = Payment::with('numbers')->where('user_id', $adminId)->where('status', 'active')->get();
        // return $data;

        //   get numbers for specific payment method
        $data['bkash_agents'] = Payment::where('user_id', $adminId)->where('name', 'bkash agent')->get();
        $data['bkash_personals'] = Payment::where('user_id', $adminId)->where('name', 'bkash personal')->get();
        $data['nagad_personals'] = Payment::where('user_id', $adminId)->where('name', 'nagad personal')->get();
        $data['rocket_personals'] = Payment::where('user_id', $adminId)->where('name', 'rocket personal')->get();
        $data['upay_personals'] = Payment::where('user_id', $adminId)->where('name', 'upay personal')->get();
        //    user wise deposit data
        $data['deposits'] = Deposit::where('user_id', auth()->id())->get();
        // total deposit
        $data['total_deposits'] = Deposit::select('amount')->where('user_id', auth()->id())->where('status', 'accepted')->get();
        $data['marquee1'] = Marquee::orderby('id', 'desc')->get();
        // return $data['total_deposits'];

        if ($request->isMethod('post')) {
            $message = "Deposit sent Successfully";
            $rules = [
                'payment_no' => 'string|required',
                'transaction_id' => 'string|required',
                'amount' => 'string|required',
            ];
            $request->validate($rules);
            try {
                $deposit = new Deposit();
                $deposit->user_id = auth()->id();
                $deposit->transaction_type = $request->transaction_type;
                $deposit->payment_no = $request->payment_no;
                $deposit->transaction_id = $request->transaction_id;
                $deposit->amount = $request->amount;
                $deposit->status = \App\Models\Deposit::$statusArrays[1];

                // return $deposit;
                if ($deposit->save()) {
                    Mail::to('mdroniahmed9911@gmail.com')
                        ->send(new MyDemoMail($deposit));
                    return RedirectHelper::routeSuccess('admin.deposit', $message);
                }
                return RedirectHelper::backWithInput();
            } catch (QueryException $e) {
                //                return $e;
                return RedirectHelper::backWithInputFromException();
            }
            // return $request;
        }
        //         return $data;
        return view('admin.cash.deposit', $data);
    }


    public function depositList()
    {
        $data['allDeposits'] = Deposit::with('user_methods')->get();
        //        $data['data_user'] = $data['allDeposits'][0]->user_methods->username;
        //        return $datas;
        $data['total_deposits'] = Deposit::select('amount')->where('status', 'accepted')->get();
        //        $data['sub_agent'] = User::with('agent')->whereHas('roles',function( $user){$user->where('roles.name','Sub Agent');})->
        //        return $datas;
        $data['marquee1'] = Marquee::get();
        return view('admin.cashmanage.depositManage', $data);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show(Deposit $deposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit $deposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposit $deposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit $deposit)
    {
        //
    }
    public function ajaxUpdateStatus(Request $request)
    {
        if ($request->isMethod("POST")) {
            $id = $request->post('id');
            $userId = $request->post('userId');
            $postStatus = $request->post('status');
            $status = strtolower($postStatus);
            $deposit = Deposit::find($id);
// status update of deposit and If the deposit by sub agent and accepted by admin , the sub agent's who is under of a agent's interest will be insert, if rejected by admin agent interest status also be update.
            if ($deposit->update(['status' => $status])) {
                // user data load to handle interest
                $agentInfo = User::with('agent')->where('id', $userId)->first();
                // return $agentInfo;
                if ($agentInfo->agent) {
                    $agent_id = $agentInfo?->agent?->id;
                    $agent_interest_percentage = $agentInfo->agent->interest_percentage;
                    // return $deposit->amount;
                    $agent_interest_amount = ( $deposit->amount * ($agent_interest_percentage / 100));
                    return $agent_interest_amount;

                    // $agent_interest = new AgentInterest();
                    AgentInterest::updateOrCreate(
                        ['deposit_id' => $deposit->id],
                        ['agent_id' => $agent_id, 'interest_amount' => $agent_interest_amount, 'status' => $status ]
                    );

                    // $agent_interest = new AgentInterest();
                    // $agent_interest->agent_id = $agent_id;
                    // $agent_interest->interest_amount = ( $deposit->amount * ($agent_interest_percentage / 100));
                    // $agent_interest->status = $status;
                    // $agent_interest->save();
                }
                return "success";
            }
        }
    }
}
