<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Deposit;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrIndex(Request $request)
    {
//        return $request;
           $data['user'] = User::whereHas('roles',function( $user){$user->where('roles.name','Super Admin');})->first();
           $adminId = $data['user']->id;
//        $adminId=app('request')->user()->id;
           $data['bkash_agents'] = Payment::where('user_id', $adminId)->where('name','bkash agent')->get();
//           return $adminId;
           $data['deposits'] = Deposit::where('user_id', auth()->id())->get();
        //    return $data['deposits'];
        //    $data['bkash_pers'] = Payment::where('user_id', $adminId)->where('name','bkash agent')->get();
        //    $data['bkash_agents'] = Payment::where('user_id', $adminId)->where('name','bkash agent')->get();
        //    $data['bkash_agents'] = Payment::where('user_id', $adminId)->where('name','bkash agent')->get();

        if($request->isMethod('post')){
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
                    return RedirectHelper::routeSuccess('admin.deposit', $message);
                }
                return RedirectHelper::backWithInput();
            } catch (QueryException $e) {
//                return $e;
                return RedirectHelper::backWithInputFromException();
            }
            // return $request;
        }
        // return $data;
        return view('admin.cash.deposit',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $postStatus = $request->post('status');
            $status = strtolower($postStatus);
            $semester = Deposit::find($id);
            if ($semester->update(['status' => $status])) {

                return "success";
            }
        }
    }
}
