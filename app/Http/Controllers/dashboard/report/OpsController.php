<?php

namespace App\Http\Controllers\dashboard\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payapply;
use App\Models\Student;
use App\Models\SectionAssign;
use App\Models\Startup;
use App\Models\StartupSubcategory;
use Illuminate\Support\Facades\Auth;

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
    public function show($id)
    {
        $users  = User::all();
        return view('layouts/dashboard/fee_management/report/opsview',compact('users'));
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
