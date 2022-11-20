<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Datesetup;
use App\Models\Payapply;
use App\Models\Bankinfo;
use App\Models\Paymentupdate;
use App\Models\Waivermapping;
use Carbon\Carbon;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Session;

class StudentAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.student.index');
    }


    public function authentication(Request $request)
    {
        // dd($request->ins_id);
        $request->validate([
            'std_id' => 'required',
            'ins_id' => 'required',
        ]);

        $std_id = $request->std_id;
        $ins_id = $request->ins_id;

        $payapplies = new Payapply();
        $students = Student::where('std_id', $std_id)->where('institute_id', $ins_id)->get();
        $datesetups = Datesetup::all();
        $waivermappings = Waivermapping::where('student_id', $std_id)
            ->where('institute_id', $ins_id)->get();



        foreach ($students as $std) {
            // dd($std->std_id == $request->std_id);
            if ($std->institute_id == $request->ins_id && $std->std_id == $request->std_id) {
                return view('layouts.student.dashboard', compact('students', 'datesetups', 'waivermappings', 'payapplies'))
                    ->with('std_id', $std_id)
                    ->with('ins_id', $ins_id);
            } else {
                return back()->with('message', 'Wrong Login Details');
            }
        }
    }

    // AE-institute_id-invoicedate-student_id-year-serial_no

    public function makepayment(Request $request)
    {

        $std_id = $request->std_id;
        $ins_id = $request->ins_id;
        $year = $request->year;
        $day = $request->day;
        $now = Carbon::now();
        $unique_code = $now->format('ymdHis');
        $invoice = 'AE' . $ins_id . substr($std_id, -4) . $unique_code;
        $invoice = strtoupper($invoice);
        $auth = 'Basic QXV0b01hdGVJVDpBdTN0N28xTTRhc3RlSVQh';
        
        // $invoice = 'INV155422121443';
        Session::put('ins_id', $ins_id);
        Session::put('std_id', $std_id);

        $tableData = json_decode($request->tableData, true);

        foreach ($tableData as $data) {
            $invoice_assign = Payapply::where(
                [
                    ['student_id',  $std_id],
                    ['institute_id', $ins_id],
                    ['feehead_id', $data['feehead_id']],
                    ['feesubhead_id', $data['feesubhead_id']]
                ]
            )->update(['invoice' => $invoice]);
        }
        $amount = $request->erp;
        $invoicedate = \Carbon\Carbon::now()->format('Y-m-d');
        $accountInfo = Bankinfo::where('institute_id', $ins_id)->first();
        $applicantName = Student::where('institute_id', $ins_id)->where('std_id', $std_id)->first();
        

        $client = new GuzzleClient(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        $headers = [
            'Content-Type' => 'application/JSON',
            'Authorization' => $auth,
           ];

        $data = '{"AccessUser":
            {"userName":"AutoMateIT",
            "password":"Au3t7o1M4asteIT!"
            },
            "invoiceNo":"'.$invoice.'",
            "amount":"'.$amount.'",
            "invoiceDate":"'.$invoicedate.'",
            "accounts":[{"crAccount":"'.$accountInfo['account'].'","crAmount":'.$amount.'}]}';

        //dd($data);
        // API 1
        $res = $client->request(
            'POST',
            'https://spg.com.bd:6314/api/v2/SpgService/GetAccessToken',
            ['headers' => $headers, 'body' => $data]
        );
        $token = json_decode($res->getBody(), true);

        $data_two =
            '{ "authentication":{
                "apiAccessUserId": "AutoMateIT",
                "apiAccessToken": "'.$token['access_token'].'"
            },
            "referenceInfo": {
                "InvoiceNo": "'.$invoice.'", 
                "invoiceDate": "'.$invoicedate.'", 
                "returnUrl": "https://live.academyims.com/confirmation", 
                "totalAmount": "'.$amount.'", 
                "applicentName": "'.$applicantName['name'].'", 
                "applicentContactNo": "'.$applicantName['mobile_no'].'",
                "extraRefNo": "2132"
            }, 
            "creditInformations": [
            {
                "slno": "1",
                "crAccount": "'.$accountInfo['account'].'", 
                "crAmount": "'.$amount.'", 
                "tranMode": "TRN"}]}';

        // dd($data_two);
        //API 2
        $res_two = $client->request(
            'POST',
            'https://spg.com.bd:6314/api/v2/SpgService/CreatePaymentRequest',
            ['headers' => $headers, 'body' => $data_two]
        );

        $sessiontoken = json_decode($res_two->getBody(), true);

        // dd($sessiontoken);

        return view('layouts.student.spg_paymentform', compact('sessiontoken'));
    }


    public function confirmation(Request $request)
    {
        $receive_token = $request->session_token;
        $status = $request->status;
        $ins_id= Session::get('ins_id');
        $std_id= Session::get('std_id');
        $auth = 'Basic QXV0b01hdGVJVDpBdTN0N28xTTRhc3RlSVQh';

        $client = new GuzzleClient(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $auth
            
        ];

        $data = '{"session_Token": "' . $request->session_token . '"}';

        // API 3
        $res = $client->request(
            'POST',
            'https://spg.com.bd:6314/api/v2/SpgService/TransactionVerificationWithToken',
            ['headers' => $headers, 'body' => $data]
        );

        $result = json_decode($res->getBody(), true);


        $input = new Paymentupdate();
        $input->institute_id = $ins_id;
        $input->student_id = $std_id;
        $input->session_token = $request->session_token;
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
        if ($input->save()) {
            $updateDetails = [
                'payment_state' => $result['status'],
                'trx_id' => $result['TransactionId']
            ];

            $up_payapply = Payapply::where('invoice', $result['InvoiceNo'])
                ->update($updateDetails);
        }

        $finalheaders = [
            'Content-Type' => 'application/json',
            'Authorization' => $auth,
        ];

        $final_data = '{ 
            "data": {
                "auth_code": "'.$auth.'",
                "session_Token": "'.$request->session_token. '",
                "trax_id": "'.$result['TransactionId'].'",
                "invoice_no": "'.$result['InvoiceNo'].'",
                "status": "'.$result['status'].'",
                "msg": "'.$result['msg'].'"
                } 
            }';

        try {
            $resposnedata = 
            $client->request(
                'POST',
                'https://live.academyims.com/api/dataupdate',

                [
                    'headers' => $finalheaders,
                    'body' => $final_data,
                ]
            ); 
            }
            catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
            }
        


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
        //cadmin_academy
        //Academy$1234
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
