<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paymentupdate;
use App\Models\Payapply;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function dataupdate(Request $request)
     {
        $response = Http::withBody( 
            '{
      "data": {
        "auth_code": "Basic QXV0b01hdGVJVDpBdTN0N28xTTRhc3RlSVQh",
        "session_Token": "3b3a555314930c394e5ddb2b193d94630ff3c6ba831",
        "trax_id": "2211159000004898",
        "invoice_no": "AE221106215100052022"
      }
    }', 'json' 
        ) 
        ->withHeaders([ 
            'Content-Type'=> 'application/json', 
            'Authorization'=> 'Basic QXV0b01hdGVJVDpBdTN0N28xTTRhc3RlSVQh', 
        ]) 
        ->post('https://live.academyims.com/api/dataupdate'); 
    
    echo $response->body();
        // if($result['status'] == 200)
        // {
        //     if($input->save())
        //     {
        //         redirect(route('student.auth.index'))->with('message', 'Payment Success');
        //     }else{
        //         Session::put('payment error', $request->ins_id, $request->std_id);
        //     }
        // }else{

        // }
        
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
