<?php

namespace App\Http\Controllers\dashboard\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payapply;
use App\Models\Student;
use App\Models\SectionAssign;
use App\Models\Startup;
use App\Models\Basic;
use App\Models\StartupSubcategory;
use Illuminate\Support\Facades\Auth;
use NumberFormatter;

class OpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users  = User::all();
        $payapplies = Payapply::all();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $startupsubcategories = StartupSubcategory::all();
        $sectionassigns = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $students = Student::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts/dashboard/fee_management/report/ops', 
            compact('users', 'payapplies','students','sectionassigns', 'startups', 'startupsubcategories'));
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            'from' => 'required',
            'to' => 'required',
        ]);
        $from = $request->from;
        $to = $request->to;
        $users = User::all();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $startupsubcategories = StartupSubcategory::all();
        $sectionassigns = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $students = Student::where('institute_id', Auth::user()->institute_id)->get();
        $payapplies = Payapply::where('updated_at', '>=', $from)
                    ->where('updated_at', '<=', $to)
                    ->get();
        return view('layouts/dashboard/fee_management/report/ops', compact('users', 'payapplies','students','sectionassigns', 'startups', 'startupsubcategories'));
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
    public function show($invoice)
    {
        $users  = User::all();
        $institute_id = Payapply::select('institute_id')->where('invoice', $invoice)->first();
        $student_id = Payapply::select('student_id')->where('invoice', $invoice)->first();
       
        $data = Payapply::
                join('fee_heads', 'fee_heads.id', '=', 'payapplies.feehead_id')
                ->join('feesubheads', 'feesubheads.id', '=', 'payapplies.feesubhead_id')
                ->where('payapplies.invoice', $invoice)
                ->get([ 'payapplies.student_id', 'payapplies.payable', 'payapplies.fine','payapplies.invoice', 'payapplies.waiver_amount', 'payapplies.total_amount', 'payapplies.updated_at', 'fee_heads.head_name', 'feesubheads.subhead_name']);

        $institute_name = User::select('institute_name')->where('institute_id', $institute_id->institute_id)->first();
        
        $institute_add = User::select('address')->where('institute_id', $institute_id->institute_id)->first();
        $institute_logo = Basic::select('logo')->where('institute_id', $institute_id->institute_id)->first();

        $roll = Student::select('roll')->where('std_id', $student_id->student_id)->where('institute_id', $institute_id->institute_id)->first();
        $name = Student::select('name')->where('std_id', $student_id->student_id)->where('institute_id', $institute_id->institute_id)->first();
      
        $academic_yr_id = Student::select('academic_year_id')->where('std_id', $student_id->student_id)->where('institute_id', $institute_id->institute_id)->first();
        $academic_yr = Startup::select('startup_subcategory_id')->where('id', $academic_yr_id->academic_year_id)->first();
        $academic_yr_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $academic_yr->startup_subcategory_id)->first();
        

        $std_session_id = Student::select('session_id')->where('std_id', $student_id->student_id)->where('institute_id', $institute_id->institute_id)->first();
        $session = Startup::select('startup_subcategory_id')->where('id', $std_session_id->session_id)->first();
        $session_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $session->startup_subcategory_id)->first();

        $std_class = Student::select('section_id')->where('std_id', $student_id->student_id)->where('institute_id', $institute_id->institute_id)->first();
        $class_id = SectionAssign::select('class_id')->where('id', $std_class->section_id)->first();
        $class = Startup::select('startup_subcategory_id')->where('id', $class_id->class_id)->first();
        $class_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $class->startup_subcategory_id)->first();

        $shift_id = SectionAssign::select('shift_id')->where('id', $std_class->section_id)->first();
        $shift = Startup::select('startup_subcategory_id')->where('id', $shift_id->shift_id)->first();
        $shift_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $shift->startup_subcategory_id)->first();

        $section_id = SectionAssign::select('section_id')->where('id', $std_class->section_id)->first();
        $section = Startup::select('startup_subcategory_id')->where('id', $section_id->section_id)->first();
        $section_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $section->startup_subcategory_id)->first();
        
        $total = Payapply::where('invoice', $invoice)->sum('total_amount');
        $amountInWords = ucwords((new NumberFormatter('en_IN', NumberFormatter::SPELLOUT))->format($total));

        $data = json_decode($data, true);
        foreach ($data as $key => $arr) {
            $data[$key]['roll'] = $roll->roll;
            $data[$key]['name'] = $name->name;
            $data[$key]['class_name'] = $class_name->startup_subcategory_name;
            $data[$key]['session_name'] = $session_name->startup_subcategory_name;  
            $data[$key]['section_name'] = $section_name->startup_subcategory_name;
            $data[$key]['shift_name'] = $shift_name->startup_subcategory_name;
            $data[$key]['academic_yr_name'] = $academic_yr_name->startup_subcategory_name;
            $data[$key]['institute_name'] = $institute_name->institute_name;
            $data[$key]['institute_add'] = $institute_add->address;
            $data[$key]['institute_logo'] = $institute_logo->logo;
            $data[$key]['total'] = $total;
            $data[$key]['amountInWords'] = $amountInWords;
        }
        $data = json_encode($data);
        return view('layouts/dashboard/fee_management/report/opsview',compact('users', 'data'));
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
