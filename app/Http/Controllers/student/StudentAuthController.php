<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Datesetup;
use App\Models\Payment;
use App\Models\SectionAssign;
use App\Models\Feeamount;
use App\Models\Feefineamount;
use Illuminate\Support\Facades\DB;
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
        $request->validate([
            'std_id' => 'required',
            'ins_id' => 'required',
        ]);

        $std_id = $request->std_id;
        $ins_id = $request->ins_id;


        $students = Student::all();
        $datesetups = Datesetup::all();


        foreach ($students as $std) {

            if ($std->institute_id == $ins_id && $std->std_id == $std_id) {
                return view('layouts.student.dashboard', compact('students', 'datesetups'))
                    ->with('std_id', $std_id)
                    ->with('ins_id', $ins_id);
            } else {
                return back()->with('message', 'Wrong Login Details');
            }
        }
    }

    public function makepayment()
    {
        $client = new GuzzleClient(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
       // $client->setHttpClient($client);
        $headers = [
            // 'Access-Control-Allow-Origin' => 'http://127.0.0.1:8000',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ZHVVc2VyMjAxNDpkdVVzZXJQYXltZW50MjAxNA==',
        ];

        $data = "{'AccessUser':{'userName':'duUser2014','password':'duUserPayment2014'},'invoiceNo':'INV155422121443','amount':'400','invoiceDate':'2019-02-26','accounts':[{'crAccount':'0002634313655','crAmount':400}]}";

        $res = $client->request(
            'POST',
            'https://spgapi.sblesheba.com:6314/api/v2/SpgService/GetAccessToken',
            ['headers' => $headers, 'body' => $data]
        );
        // echo $res->getStatusCode(); // 200
        // echo $res->getBody(); //
        $token = json_decode($res->getBody(), true);
        // echo $token['access_token'];
        $data_two = 
        '{ "authentication":{
        "apiAccessUserId": "duUser2014",
        "apiAccessToken": "'.$token['access_token'].'"
        },
        "referenceInfo": {
        "InvoiceNo": "INV155422121443", "invoiceDate": "2019-02-26", "returnUrl": "http://127.0.0.1:8000/Student_Portal/", "totalAmount": "400", "applicentName": "Md. Hasan Monsur", "applicentContactNo": "01710563521", "extraRefNo": "2132"
        }, "creditInformations": [
        {
        "slno": "1",
        "crAccount": "0002634313655", "crAmount": "400", "tranMode": "TRN"}]}';
        
        $res_two = $client->request(
            'POST',
            'https://spgapi.sblesheba.com:6314/api/v2/SpgService/CreatePaymentRequest',
            ['headers' => $headers, 'body' => $data_two]
        );

        $sessiontoken = json_decode($res_two->getBody(), true);

        $data_three = '{
            "session_Token": "'.$sessiontoken['session_token'].'"
            }';
        $res_three = $client->request(
            'POST',
            'https://spgapi.sblesheba.com:6314//api/v2/SpgService/TransactionVerificationWithToken',
            ['headers' => $headers, 'body' => $data_three]
        );

        // dd($res_three);

        // echo 'https://spg.sblesheba.com:6313/SpgLanding/SpgLanding/'.$sessiontoken['session_token'].'/';
        // $session = $client->request(
        //     'GET',
        //     'https://spg.sblesheba.com:6313/SpgLanding/SpgLanding/'.$sessiontoken['session_token'].'/',
        // );
        // dd($session->statusCode);
        // $getStatusCode = json_decode($session->getBody(), true);
        // // dd($getStatusCode);
        // $sessionstatuscode = $client->request(
        //     'GET',
        //     'https://spg.sblesheba.com:6313/SpgLanding/SpgLanding/?session_token='.$sessiontoken['session_token'].'&status='.$getStatusCode['statusCode'].'',
        // );

        // dd($sessionstatuscode);
        // return $session;
        return view('layouts.student.spg_paymentform', compact('sessiontoken'));
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
        //https://spg.sblesheba.com:6313/SpgLanding/SpgLanding/13d295ee71aabb52bac879308eca44f7c3d3ff0b693?_token=HaHRsb6guB0HMcfSq33FSRC9TYHYPao8gGqHpFc1
        //https://spg.sblesheba.com:6313/Sbl/AccountPayment/13d295ee71aabb52bac879308eca44f7c3d3ff0b693
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
