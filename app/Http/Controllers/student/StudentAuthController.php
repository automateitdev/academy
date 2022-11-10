<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Datesetup;
use App\Models\Paymentupdate;
use App\Models\Accountinfo;
use App\Models\Payapply;
use App\Models\Bankinfo;
use App\Models\Waivermapping;
use GuzzleHttp\Client as GuzzleClient;
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
        $invoice = 'AE' . $ins_id . ''.$day.'' . $std_id . '' . $year . '';
        Session::put('ins_id', $ins_id);
        Session::put('std_id', $std_id);

        $tableData = json_decode($request->tableData, true);

        foreach ($tableData as $key => $data) {
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
        $accountInfo = Bankinfo::where('institute_id', $ins_id)->first();
        $applicantName = Student::where('institute_id', $ins_id)->where('std_id', $std_id)->first();
        // dd($applicantName['name']);



        $client = new GuzzleClient(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic QXV0b01hdGVJVDpBdTN0N28xTTRhc3RlSVQh',
        ];

        $data = '{"AccessUser":
            {"userName":"AutoMateIT",
            "password":"Au3t7o1M4asteIT!"
            },
            "invoiceNo":"' . $invoice . '",
            "amount":"' . $amount . '",
            "invoiceDate":"' . $invoicedate . '",
            "accounts":[{"crAccount":"' . $accountInfo['account'] . '","crAmount":' . $amount . '}]}';

        // dd($data);
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
                "apiAccessToken": "' . $token['access_token'] . '"
            },
            "referenceInfo": {
                "InvoiceNo": "' . $invoice . '", 
                "invoiceDate": "' . $invoicedate . '", 
                "returnUrl": "http://127.0.0.2:8000/confirmation", 
                "totalAmount": "' . $amount . '", 
                "applicentName": "' . $applicantName['name'] . '", 
                "applicentContactNo": "' . $applicantName['mobile_no'] . '"
            }, 
            "creditInformations": [
            {
                "crAccount": "' . $accountInfo['account'] . '", 
                "crAmount": "' . $amount . '", 
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

        $client = new GuzzleClient(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic QXV0b01hdGVJVDpBdTN0N28xTTRhc3RlSVQh',
        ];

        $data = '{"session_Token": "' . $request->session_token . '"}';

        // API 3
        $res = $client->request(
            'POST',
            'https://spg.com.bd:6314/api/v2/SpgService/TransactionVerificationWithToken',
            ['headers' => $headers, 'body' => $data]
        );
        


        $finalheaders = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic QXV0b01hdGVJVDpBdTN0N28xTTRhc3RlSVQh',
        ];

        $final_data = '{ 
            "data": {
                "ins_id": "'.$ins_id.'",
                "std_id": "'.$std_id.'",
                "auth_code": "Basic QXV0b01hdGVJVDpBdTN0N28xTTRhc3RlSVQh",
                "session_Token": "'.$request->session_token.'",
                "result": "'.$res.'",
                } 
            }';

        $final = $client->request(
            'POST',
            'http://127.0.0.1:8000/api/dataupdate',
            ['headers' => $finalheaders, 'body' => $final_data]
        );


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
