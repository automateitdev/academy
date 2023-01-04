<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Datesetup;
use App\Models\Payapply;
use App\Models\Bankinfo;
use App\Models\Paymentupdate;
use App\Models\User;
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
        $request->validate([
            'std_id' => 'required',
            'ins_id' => 'required',
        ]);

        $std_id = $request->std_id;
        $ins_id = $request->ins_id;

        $inst_id = User::where('institute_id',$ins_id)->first();
        if(!empty($inst_id)){
            $payapplies = Payapply::where('student_id', $std_id)->where('institute_id', $ins_id)->get();
            $student = Student::where('std_id', $std_id)->where('institute_id', $ins_id)->first(); // $student = null;

            // null->institute_id
            if ($student->institute_id == $request->ins_id && $student->std_id == $request->std_id) {
                return view('layouts.student.dashboard', compact('student', 'payapplies'));
            } else {
                return redirect()->back()->with('error', 'Wrong Login Details');
            }
        }else{
            return redirect()->back()->with('error', "Institute doesn't exist");
        }
        
        
    }

    // AE-institute_id-invoicedate-student_id-year-serial_no

    public function makepayment(Request $request)
    {

        $grandTotal = $request->grandTotal + $request->paid;
        $std_id = $request->std_id;
        $ins_id = $request->ins_id;
        Session::put('ins_id', $ins_id);
        Session::put('std_id', $std_id);
        $student = Student::where('std_id', $std_id)->where('institute_id', $ins_id)->first();
        $payapplies = Payapply::where('student_id', $std_id)->where('institute_id', $ins_id)->get();
        $amount = 0;
        $total_payable = 0;
        $todate = \Carbon\Carbon::now();
        foreach ($payapplies as $payapplie) {
            if($payapplie->payment_state == 400 || $payapplie->payment_state == 0 || $payapplie->payment_state == 201 || $payapplie->payment_state == 11){
                if($todate->gte($payapplie->payable_date)){
                    $total_payable += $payapplie->total_amount;
                }
            }
        }

        $year = $request->year;
        $day = $request->day;
        $now = Carbon::now();

        $unique_code = $now->format('ymdHis');
        $unique_invoice = 'AE' . $ins_id . substr($std_id, -4) . $unique_code;
        $unique_invoice = strtoupper($unique_invoice);

        $tableData = json_decode($request->tableData, true);
        
        foreach ($tableData as $data) {
        
            $check_invoice = Payapply:: where([
                ['student_id',  $std_id],
                ['institute_id', $ins_id],
                ['feehead_id', $data['feehead_id']],
                ['feesubhead_id', $data['feesubhead_id']]
            ])->first();
            
            if(empty($check_invoice->invoice) && $check_invoice->payment_state != 200){
                
                $invoice_assign = Payapply::where(
                    [
                        ['student_id',  $std_id],
                        ['institute_id', $ins_id],
                        ['feehead_id', $data['feehead_id']],
                        ['feesubhead_id', $data['feesubhead_id']]
                    ]
                )->update(['invoice' => $unique_invoice]);
                $invoice = $unique_invoice;
            } else {
                $invoice = $check_invoice->invoice;
            }
        }
        // dd($total_payable, $grandTotal);
        if ($grandTotal == $total_payable) {
            $amount = $total_payable;
        } else {
            return redirect(route('student.auth.index'))->with('error', 'Something went wrong. Please, try again');
        }

        $auth = 'Basic QXV0b01hdGVJVDpBdTN0N28xTTRhc3RlSVQh';
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
            "invoiceNo":"' . $invoice . '",
            "amount":"' . $amount . '",
            "invoiceDate":"' . $invoicedate . '",
            "accounts":[{"crAccount":"' . $accountInfo['account'] . '","crAmount":' . $amount . '}]}';

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
                "apiAccessToken": "' . $token['access_token'] . '"
            },
            "referenceInfo": {
                "InvoiceNo": "' . $invoice . '", 
                "invoiceDate": "' . $invoicedate . '", 
                "returnUrl": "https://live.academyims.com/confirmation", 
                "totalAmount": "' . $amount . '", 
                "applicentName": "' . $applicantName['name'] . '", 
                "applicentContactNo": "' . $applicantName['mobile_no'] . '",
                "extraRefNo": "2132"
            }, 
            "creditInformations": [
            {
                "slno": "1",
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
        $ins_id = Session::get('ins_id');
        $std_id = Session::get('std_id');
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

        if(empty($res)){
            return redirect(route('student.auth.index'))->with('error', 'No response! i.e., If your payment has been deducted, Please contact your institute.');
        }
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
            if($result['status'] == 200){
                return redirect(route('student.auth.index'))->with('message', 'Your payments successful.');
            }
            if($result['status'] == 201){
                return redirect(route('student.auth.index'))->with('error', 'Technical issues, Try again later.');
            }
            if($result['status'] == 400){
                return redirect(route('student.auth.index'))->with('message', 'Payment has been canceled.');
            }
            if($result['status'] == 5555){
                return redirect(route('student.auth.index'))->with('error', 'System error, Try again later.');
            }

        }

        // $finalheaders = [
        //     'Content-Type' => 'application/json',
        //     'Authorization' => $auth,
        // ];

        // $final_data = '{ 
        //     "data": {
        //         "auth_code": "' . $auth . '",
        //         "session_Token": "' . $request->session_token . '",
        //         "trax_id": "' . $result['TransactionId'] . '",
        //         "invoice_no": "' . $result['InvoiceNo'] . '",
        //         "status": "' . $result['status'] . '",
        //         "msg": "' . $result['msg'] . '"
        //         } 
        //     }';

        // try {
        //     $resposnedata =
        //         $client->request(
        //             'POST',
        //             'https://live.academyims.com/api/dataupdate',

        //             [
        //                 'headers' => $finalheaders,
        //                 'body' => $final_data,
        //             ]
        //         );
        // } catch (ClientException $e) {
        //     $response = $e->getResponse();
        //     $responseBodyAsString = $response->getBody()->getContents();
        // }
    }
}