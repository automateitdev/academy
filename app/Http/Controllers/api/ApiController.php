<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paymentupdate;
use App\Models\Payapply;
use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{
    public function dataupdate(Request $request)
     {

        $result = json_decode($request->res->getBody(), true);


        $input = new Paymentupdate();
        $input->institute_id =  $request->ins_id;
        $input->student_id = $request->std_id;
        $input->session_token = $request->session_Token;
        $input->status = $result['status'];
        $input->msg = $result['msg'];
        $input->transaction_id = $result['TransactionId'];
        $input->transaction_date = $result['TransactionDate'];
        $input->invoice_no = $result['InvoiceNo'];
        $input->invoice_date = $result['InvoiceDate'];
        $input->br_code = $result['BrCode'];
        $input->applicant_name = $result['ApplicantName'];;
        $input->applicant_no = $result['ApplicantContactNo'];
        $input->total_amount = $result['TotalAmount'];
        $input->pay_status = $result['PaymentStatus'];
        $input->pay_mode = $result['PayMode'];
        $input->pay_amount = $result['PayAmount'];
        $input->vat = $result['Vat'];
        $input->comission = $result['Commission'];
        $input->scroll_no = $result['ScrollNo'];

        if($result['status'] == 200)
        {
            if($input->save())
            {
                
            }else{
                Session::put('payment_error', $request->ins_id, $request->std_id);
            }
        }else{

        }
        
        return redirect(route('student.auth.submit'));
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
