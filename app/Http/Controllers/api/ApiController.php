<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paymentupdate;

class ApiController extends Controller
{
    public function dataupdate(Request $request)
     {
        // dd($request);
        // $paymentupdates = Paymentupdate::where('transaction_id', $request->TransactionId)->get();

        // foreach($paymentupdates as $pay)
        // {
        //     // dd($request);
        //     if($pay->session_token == $request->session_Token 
        //         && $pay->transaction_id == $request->TransactionId
        //         && $pay->invoice_no == $request->InvoiceNo
        //         && $pay->applicant_no == $request->ApplicantContactNo
        //         && $pay->total_amount == $request->TotalAmount
        //         && $pay->pay_status == $request->PaymentStatus
        //      )
        //      {
        //         echo "success";
        //      }
        //      else{
        //         echo "fail";
        //      }
        // }
        return $request;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
