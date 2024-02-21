<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 1) {
            $data=Payment::where('restaurant',NULL)->get();
        } else {
            $data=Payment::where('restaurant',Auth::user()->id)->get();
        }  

        return view('admin.payment.index',compact('data'));
    }

    public function show($id)
    {
        $paymentdetails = Payment::where('id', $id)->get()->first();
        return view('admin.payment.manage-payment', compact('paymentdetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $payment = new Payment;
        $payment->exists = true;
        $payment->id = $request->id;

        if(Auth::user()->id == "1") {
            $restid = NULL;
        } else {
            $restid = Auth::user()->id;
        }
        $payment->restaurant = $restid;
        $payment->environment =$request->environment;
        $payment->public_key =$request->public_key;
        $payment->secret_key =$request->secret_key;
        $payment->bank_name =$request->bank_name;
        $payment->account_number =$request->account_number;
        $payment->account_holder_name =$request->account_holder_name;
        $payment->ifsc =$request->ifsc;
        $payment->save();

        if ($payment) {
            return redirect()->route('payments')->with('success',trans('messages.success'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    public function status(Request $request)
    {
        $data['status']=$request->status;
        Payment::where('id',$request->id)->update($data);
        if ($data) {
            return 1;
        } else {
            return 2;
        }      
    }
}
