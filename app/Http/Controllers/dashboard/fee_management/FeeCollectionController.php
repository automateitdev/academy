<?php

namespace App\Http\Controllers\dashboard\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SectionAssign;
use App\Models\Startup;
use App\Models\Student;
use App\Models\Quickcollection;
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
        $sectionAssignes = SectionAssign::all();
        $startups = Startup::all();
        return view('layouts.dashboard.fee_management.feecollection.quick.index', 
        compact('users','sectionAssignes','startups'));
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
        $students = Student::find($id);
        $users = User::all();
        return view('layouts.dashboard.fee_management.feecollection.quick.view', compact('students','users'));
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
