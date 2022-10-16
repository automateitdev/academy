<?php

namespace App\Http\Controllers\school\stdManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Startup;
use App\Models\Gender;
use App\Models\Religion;
use App\Models\SectionAssign;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Concerns\ToArray;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genders = Gender::all();
        $religions = Religion::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $users = User::all();
        return view('layouts.dashboard.std_management.registration.enrollement.auto.index', compact('startups','genders','religions','sectionAssignes', 'users'));
    }

    public function excel_index()
    {
        $genders = Gender::all();
        $religions = Religion::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $users = User::all();
        return view('layouts.dashboard.std_management.registration.excel.index', compact('startups','genders','religions','sectionAssignes', 'users'));
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
        // dd($request->all());
        foreach($request->roll as $key => $roll)
        {
            $input = new Student();
            $input->institute_id = $request->institute_id;
            $input->std_id = $request->std_id[$key];
            $input->academic_year_id = $request->academic_year_id;
            $input->session_id = $request->session_id;
            $input->section_id = $request->section_id;
            $input->std_category_id = $request->std_category_id;
            $input->group_id = $request->group_id;
            $input->roll = $roll;
            $input->name = $request->name[$key]; 
            $input->gender_id = $request->gender_id[$key]; 
            $input->religion_id = $request->religion_id[$key]; 
            $input->father_name = $request->father_name[$key]; 
            $input->mother_name = $request->mother_name[$key]; 
            $input->mobile_no = $request->mobile_no[$key]; 
            $input->save(); 
        }
        return redirect(route('enrollment.auto.index'));
    }

    public function excel_store(Request $request)
    {
        // $var = 
        // Excel::import(ToArray(), new StudentImport($request->institute_id,$request->academic_year_id,
        //     $request->session_id,$request->section_id,$request->std_category_id,$request->group_id), $request->file('file'));
        
        // Excel::import(new UsersImport, storage_path('users.xlsx'));
        // Excel::toArray(new StudentImport($request->institute_id,$request->academic_year_id,
        //      $request->session_id,$request->section_id,$request->std_category_id,$request->group_id),$request->file('file'));

        // $import = new StudentImport(
        //     $request->institute_id,
        //     $request->academic_year_id,
        //     $request->session_id,
        //     $request->section_id,
        //     $request->std_category_id,
        //     $request->group_id
        // );
        
        // Excel::toCollection($import, $request->file('file'));

        Excel::toCollection(new StudentImport, $request->file('file'));


               // return redirect(route('enrollment.excel.index'));
        
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
