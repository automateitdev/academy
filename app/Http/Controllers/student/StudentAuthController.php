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


        foreach($students as $std){

            if($std->institute_id == $ins_id && $std->std_id == $std_id)
            {
                return view('layouts.student.dashboard',compact('students', 'datesetups'))
                ->with('std_id', $std_id)
                ->with('ins_id', $ins_id);
            }
            else{
                return back()->with('message','Wrong Login Details');
            }
        }

    }

    public function makepayment()
    {
        $headers = [ 'Content-Type' => 'application/json', 
            'Authorization' => 'Basic ZHVVc2VyMjAxNDpkdVVzZXJQYXltZW50MjAxNA==', ]; 
        $client = new GuzzleClient(); 
        $body = '{ "AccessUser":{
            "userName":"duUser2014",
            "password":"duUserPayment2014" },
            "invoiceNo":"INV155422121443", "amount":"400", "invoiceDate":"2019-02-26", "accounts": [
            {
            "crAccount": "0002634313655", "crAmount": 200
            }, {
            "crAccount": "0002634313651", "crAmount": 200
            } ]
            }'; 
        $r = $this->$client->request('POST', 'https://spgapi.sblesheba.com:6314/api/v2/SpgService/GetAccessToken', ['headers' => $headers, 'body' => $body ]); 
        $response = $r->getBody()->getContents();
        dd($response);
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
