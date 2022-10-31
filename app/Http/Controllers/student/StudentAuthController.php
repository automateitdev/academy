<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Datesetup;
use GuzzleHttp\Client as GuzzleClient;

use function Ramsey\Uuid\v1;

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


        foreach ($students as $std) {
            // dd($std->std_id == $request->std_id);
            if ($std->institute_id == $request->ins_id && $std->std_id == $request->std_id) {
                return view('layouts.student.dashboard', compact('students', 'datesetups'))
                    ->with('std_id', $std_id)
                    ->with('ins_id', $ins_id);
            } else {
                return back()->with('message', 'Wrong Login Details');
            }
        }
    }

    public function makepayment(Request $request)
    {
        $client = new GuzzleClient(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic YTJpQHBtbzpzYlBheW1lbnQwMDAy',
        ];

        $data = "{'AccessUser':{'userName':'a2i@pmo','password':'sbPayment0002'},'invoiceNo':'INV155422121443','amount':'400','invoiceDate':'2019-02-26','accounts':[{'crAccount':'0002601020871','crAmount':400}]}";

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
        "apiAccessToken": "'.$token['access_token'].'"
        },
        "referenceInfo": {
        "InvoiceNo": "INV155422121443", "invoiceDate": "2019-02-26", "returnUrl": "demo.academyims.com", "totalAmount": "400", "applicentName": "Md. Hasan Monsur", "applicentContactNo": "01710563521", "extraRefNo": "2132"
        }, "creditInformations": [
        {
        "slno": "1",
        "crAccount": "0002601020871", "crAmount": "400", "tranMode": "TRN"}]}';
        
        //API 2
        $res_two = $client->request(
            'POST',
            'https://spgapi.sblesheba.com:6314/api/v2/SpgService/CreatePaymentRequest',
            ['headers' => $headers, 'body' => $data_two]
        );

        $sessiontoken = json_decode($res_two->getBody(), true);

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

        $data = '{"session_Token": "'.$request->session_token.'"}';
        
        // API 3
        $res = $client->request(
            'POST',
            'https://spgapi.sblesheba.com:6314/api/v2/SpgService/TransactionVerificationWithToken',
            ['headers' => $headers, 'body' => $data]
        );
        $result = json_decode($res->getBody(), true);
        
        $finalheaders = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic YTJpQHBtbzpzYlBheW1lbnQwMDAy',
        ];

        $final_data = '{ "Credentials": {
            "userName":"a2i@pmo", 
            "password":"sbPayment0002"
            }, 
            "data": {
                "session_Token": "'.$request->session_token.'" ,
                "TransactionId": "'.$result['TransactionId'].'", 
                "TransactionDate": "'.$result['TransactionDate'].'", 
                "InvoiceNo": "'.$result['InvoiceNo'].'", 
                "InvoiceDate": "'.$result['InvoiceDate'].'",
                "BrCode": "'.$result['BrCode'].'",
                "ApplicantName": "'.$result['ApplicantName'].'", 
                "ApplicantContactNo": "'.$result['ApplicantContactNo'].'", 
                "TotalAmount": "'.$result['TotalAmount'].'", 
                "PaymentStatus": "'.$result['PaymentStatus'].'",
                "PayMode": "'.$result['PayMode'].'",
                "PayAmount": "'.$result['PayAmount'].'",
                "Vat": "'.$result['Vat'].'",
                "Commission": "'.$result['Commission'].'",
                "ScrollNo": "'.$result['ScrollNo'].'"
                } 
            }';

            
        $final = $client->request(
            'POST',
            'demo.academyims.com/api/DataUpdate',
            ['headers' => $finalheaders, 'body' => $final_data]
        );
        dd($final);
        
        // return redirect();
        // return view('layouts.student.confirmation', compact('receive_token','status'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function dataupdate(Request $request)
     {
        // dd($request);
        return $request;
     }

    public function create()
    {
        //
       // https://spg.sblesheba.com:6313/Sbl/ConfirmAccountPayment/demo.academyims.com?session_token=86585c3599c8fe86045b506f36fdbd5ec4d7f5e8357&status=success
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
