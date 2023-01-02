<?php

namespace App\Http\Controllers\dashboard\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SectionAssign;
use App\Models\Startup;
use App\Models\Student;
use App\Models\GroupAssign;
use App\Models\Payapply;
use App\Models\Quickcollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeeCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.fee_management.feecollection.quick.index', 
        compact('users','sectionAssignes','startups'));
    }

    public function quicksearch(Request $request)
    {
        $this->validate($request,[
            'section_id' => 'required',
            'academic_year_id' => 'required'
        ]);
        $academic_year_id = $request->academic_year_id;
        $users = User::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $groupassigns = GroupAssign::all();
        $students = Student::where('section_id', $request->section_id)
                    ->where('academic_year_id', $request->academic_year_id)
                    ->orderBy('roll', 'asc')
                    ->paginate(100);
        return view('layouts.dashboard.fee_management.feecollection.quick.index', compact('users', 'startups', 'sectionAssignes', 'groupassigns','students','academic_year_id'));
   
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

    public function getStudentdata(Request $request)
    {
        $data = Student::select('std_id', 'roll', 'name', 'group_id', 'std_category_id', 'id')->where('section_id', $request->id)->take(100)->get();
        return response()->json($data);
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
        $student = Student::find($id);
        $users = User::all();
        $payapplies = Payapply::where('institute_id', Auth::user()->institute_id)
                                ->where('student_id', $student->std_id)
                                ->whereNotIn( 'payment_state', [200, 10, 3])
                                // ->where('payment_state', '!=', "200")
                                // ->where('payment_state', '!=', "10")
                                ->get();
        
        return view('layouts.dashboard.fee_management.feecollection.quick.view', compact('student','users', 'payapplies'));
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
