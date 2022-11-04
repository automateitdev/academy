<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Datesetup;
use App\Models\Paymentupdate;
use App\Models\Accountinfo;
use App\Models\Payapply;
use App\Models\Waivermapping;
use GuzzleHttp\Client as GuzzleClient;

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


        $students = Student::where('std_id', $std_id)->get();
        $datesetups = Datesetup::all();
        $waivermappings = Waivermapping::where('student_id', $std_id)
                                    ->where('institute_id', $ins_id)->get();
        


        foreach ($students as $std) {
            // dd($std->std_id == $request->std_id);
            if ($std->institute_id == $request->ins_id && $std->std_id == $request->std_id) {
                return view('layouts.student.dashboard', compact('students', 'datesetups', 'waivermappings'))
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
        $invoice = 'AE'.$ins_id.''.$day.''.$std_id.''.$year.'';
        // dd($ins_id );

    $tableData = json_decode($request->tableData,true);
    // dd($tableData);
       

        
    foreach($tableData as $t_key => $data)
    {
        $payapply = new Payapply();
        foreach ($data as $key => $value) {

            $payapply->institute_id = $request->ins_id;
            $payapply->student_id = $request->std_id;
            $payapply->invoice = $invoice;
            $payapply->$key = $value;
        }
        $payapply->save();  
    
    }  


        $amount = $request->erp;
        $invoicedate = $request->date;
        $accountInfo = Accountinfo::where('institute_id', $ins_id)->first();
        $applicantName = Student::where('institute_id', $ins_id)->where('std_id', $std_id)->first();
        // dd($applicantName['name']);

        

        $client = new GuzzleClient(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic YTJpQHBtbzpzYlBheW1lbnQwMDAy',
        ];

        $data = '{"AccessUser":
            {"userName":"a2i@pmo",
            "password":"sbPayment0002"
            },
            "invoiceNo":"'.$invoice.'",
            "amount":"'.$amount.'",
            "invoiceDate":"'.$invoicedate.'",
            "accounts":[{"crAccount":"'.$accountInfo['crAccount'].'","crAmount":'.$amount.'}]}';

            // dd($data);
        // API 1
        $res = $client->request(
            'POST',
            'https://spgapi.sblesheba.com:6314/api/v2/SpgService/GetAccessToken',
            ['headers' => $headers, 'body' => $data]
        );
        $token = json_decode($res->getBody(), true);

        $data_two =
            '{ "authentication":{
                "apiAccessUserId": "a2i@pmo",
                "apiAccessToken": "' . $token['access_token'] . '"
            },
            "referenceInfo": {
                "InvoiceNo": "'.$invoice.'", 
                "invoiceDate": "'.$invoicedate.'", 
                "returnUrl": "http://127.0.0.2:8000/confirmation", 
                "totalAmount": "'.$amount.'", 
                "applicentName": "'.$applicantName['name'].'", 
                "applicentContactNo": "'.$applicantName['mobile_no'].'", 
                "extraRefNo": "'.$accountInfo['extraRefNo'].'"
            }, 
            "creditInformations": [
            {
                "slno": "1",
                "crAccount": "'.$accountInfo['crAccount'].'", 
                "crAmount": "'.$amount.'", 
                "tranMode": "'.$accountInfo['tranMode'].'"}]}';

            // dd($data_two);
        //API 2
        $res_two = $client->request(
            'POST',
            'https://spgapi.sblesheba.com:6314/api/v2/SpgService/CreatePaymentRequest',
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

        $client = new GuzzleClient(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic YTJpQHBtbzpzYlBheW1lbnQwMDAy',
        ];

        $data = '{"session_Token": "' . $request->session_token . '"}';

        // API 3
        $res = $client->request(
            'POST',
            'https://spgapi.sblesheba.com:6314/api/v2/SpgService/TransactionVerificationWithToken',
            ['headers' => $headers, 'body' => $data]
        );
        $result = json_decode($res->getBody(), true);


        $input = new Paymentupdate();
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
        $input->save();


        $finalheaders = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic YTJpQHBtbzpzYlBheW1lbnQwMDAy',
        ];

        $final_data = '{ 
            "data": {
                "auth_code": "Basic YTJpQHBtbzpzYlBheW1lbnQwMDAy",
                "session_Token": "e683e362c42b13293a3e1c75d41b65535f043706122",
                "trax_id": "1902269000004016",
                "invoice_no": "INV155422121443"
                } 
            }';

        // dd($final_data);

        $final = $client->request(
            'POST',
            'http://127.0.0.1:8000/api/dataupdate',
            ['headers' => $finalheaders, 'body' => $final_data]
        );


        // return redirect();
                // "trax_id": "' . $result['TransactionId'] . '",
                // "invoice_no": "' . $result['InvoiceNo'] . '",
                // "session_token": "' . $request->session_token . '"
        // return view('layouts.student.confirmation', compact('receive_token','status'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        //
        // https://spg.sblesheba.com:6313/Sbl/ConfirmAccountPayment/demo.academyims.com?session_token=86585c3599c8fe86045b506f36fdbd5ec4d7f5e8357&status=success
        //https://spg.sblesheba.com:6313/Sbl/ConfirmAccountPayment/23eb9514a7fb35d8917ad4a19c1e641a0dec62ac689
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
