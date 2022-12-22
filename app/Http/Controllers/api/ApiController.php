<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paymentupdate;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Payapply;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    public function dataupdate(Request $request)
    {


        if (isset($request->Credentials) && !empty($request->Credentials)) {
            if ($request->Credentials['userName'] == "AutoMateIT" && $request->Credentials['password'] == "Au3t7o1M4asteIT!") {
                $paymentupdate_data = Paymentupdate::where('session_token', $request->data['session_Token'])
                    ->where('transaction_id', $request->data['TransactionId'])
                    ->first();
                if (!empty($paymentupdate_data)) {
                    if ($paymentupdate_data->status == 200) {
                        $data = [
                            "status" => "200",
                            "msg" => "success",
                            "TransactionId" => $request->data['TransactionId']
                        ];
                        return response()->json($data);
                    } else {
                        $data = [
                            "status" => "201",
                            "msg" => "fail",
                            "TransactionId" => $request->data['TransactionId'],
                            "session_Token" => $request->data['session_Token']
                        ];
                        return response()->json($data);
                    }
                } else {
                    $auth = 'Basic QXV0b01hdGVJVDpBdTN0N28xTTRhc3RlSVQh';

                    $client = new GuzzleClient(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
                    $headers = [
                        'Content-Type' => 'application/json',
                        'Authorization' => $auth

                    ];

                    $data = '{"session_Token": "' . $request->data['session_Token'] . '"}';

                    // API 3
                    $res = $client->request(
                        'POST',
                        'https://spg.com.bd:6314/api/v2/SpgService/TransactionVerificationWithToken',
                        ['headers' => $headers, 'body' => $data]
                    );


                    $result = json_decode($res->getBody(), true);

                    if (!empty($result['TransactionId'])) {
                        $payapplies_data = Payapply::select('institute_id', 'student_id')->where('invoice', $result['InvoiceNo'])->first();
                        if (!empty($payapplies_data)) {
                            $input = new Paymentupdate();
                            $input->institute_id = $payapplies_data->institute_id;
                            $input->student_id = $payapplies_data->student_id;
                            $input->session_token = $request->data['session_Token'];
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
                                if ($up_payapply) {
                                    $data = [
                                        "status" => "200",
                                        "msg" => "success",
                                        "TransactionId" => $request->data['TransactionId']
                                    ];
                                    return response()->json($data);
                                } else {
                                    $data = [
                                        "status" => "201",
                                        "msg" => "fail",
                                        "TransactionId" => $request->data['TransactionId'],
                                        "session_Token" => $request->data['session_Token']
                                    ];
                                    return response()->json($data);
                                }
                            } else {
                                $data = [
                                    "status" => "201",
                                    "msg" => "fail",
                                    "session_Token" => $request->data['session_Token']
                                ];
                                return response()->json($data);
                            }
                        } else {
                            $data = [
                                "status" => "201",
                                "msg" => "fail",
                                "session_Token" => $request->data['session_Token']
                            ];
                            return response()->json($data);
                        }
                    } else {
                        $data = [
                            "status" => "201",
                            "msg" => "fail",
                            "session_Token" => $request->data['session_Token']
                        ];
                        return response()->json($data);
                    }
                }
            } else {
                return response("Unauthorized", Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return response("Unauthorized", Response::HTTP_UNAUTHORIZED);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function generate_pdf(Request $request)
    {
        $path = $request->path;
        $data = $request->data;
        $pdfname = $request->pdfname . '.pdf';

        // dd($request);

        $pdf = Pdf::setOption([
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true
        ])->loadView($path, compact('data'));
        $savepath = storage_path('pdf/');
        $der = $pdf->save($savepath . '/' . $pdfname);
        $pdf_path = storage_path('pdf/' . $pdfname);

        return response()->download($pdf_path);
    }

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
