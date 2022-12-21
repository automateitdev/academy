<?php

namespace App\Http\Controllers\dashboard\examManagement;

use App\Http\Controllers\Controller;
use App\Models\Examcode;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SectionAssign;
use App\Models\Startup;
use App\Models\Examstartup;
use App\Models\Subjectmap;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Examconfig;
use App\Models\StudentSubjectMap;
use App\Models\StartupSubcategory;
use Illuminate\Support\Facades\Auth;

class TabulationController extends Controller
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
        $examstartups = Examstartup::where('institute_id', Auth::user()->institute_id)->get();
        $subjectmaps = Subjectmap::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.exam_management.report.tabulation.index', compact('users', 'sectionAssignes', 'startups', 'examstartups', 'subjectmaps'));
    }

    public function processResult(Request $request)
    {
        // dd($request);
        // $class_id = SectionAssign::select('id', 'class_id', 'section_id', 'shift_id')
        //                 ->where('institute_id', Auth::user()->institute_id)
        //                 ->where('id', $request->class_id)
        //                 ->first();
        $class_id = SectionAssign::select('class_id')->where('id', $request->class_id)->first();
        $class = Startup::select('startup_subcategory_id')->where('id', $class_id->class_id)->first();
        $class_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $class->startup_subcategory_id)->first();

        $shift_id = SectionAssign::select('shift_id')->where('id', $request->class_id)->first();
        $shift = Startup::select('startup_subcategory_id')->where('id', $shift_id->shift_id)->first();
        $shift_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $shift->startup_subcategory_id)->first();

        $section_id = SectionAssign::select('section_id')->where('id', $request->class_id)->first();
        $section = Startup::select('startup_subcategory_id')->where('id', $section_id->section_id)->first();
        $section_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $section->startup_subcategory_id)->first();

        $examstartup_id = Examstartup::select('exam_id')->where('id', $request->examstartup_id)->first();
        $startup_subcategory = Startup::select('startup_subcategory_id')->where('id', $examstartup_id->exam_id)->first();
        $exam_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $startup_subcategory->startup_subcategory_id)->first();

        $academic_yr_id = Startup::select('startup_subcategory_id')->where('id', $request->academic_year_id)->first();
        $academic_yr = StartupSubcategory::select('startup_subcategory_name')->where('id', $academic_yr_id->startup_subcategory_id)->first();

        $institute_name = User::select('institute_name')->where('institute_id', Auth::user()->institute_id)->first();
        $institute_add = User::select('address')->where('institute_id', Auth::user()->institute_id)->first();

        $data = StudentSubjectMap::where('institute_id', Auth::user()->institute_id)
            ->where('class_id', $request->class_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->where('examstartups_id', $request->examstartup_id)
            ->get();

        $examconfigs = Examconfig::where('institute_id', Auth::user()->institute_id)
            ->where('class_id', $class_id->class_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->where('examstartups_id', $request->examstartup_id)
            ->get();
            
        $data = json_decode($data, true);
        foreach ($data as $key => $arr) {
            foreach($examconfigs as $exConfig)
            {
                if($arr['subjectmap_id'] == $exConfig['subjectmap_id'] && $arr['examstartups_id'] == $exConfig['examstartups_id'])
                {
                    $examcode = Examcode::select('title')->where('id', $exConfig['examcode_id'])->first();
                }
            }
            $students = Student::select('name', 'roll')->where('institute_id', Auth::user()->institute_id)
                            ->where('std_id',$arr['student_id'])->first();

            $subjectmaps = Subjectmap::select('subject_id')->where('id', $arr['subjectmap_id'])->first();
            $subject = Subject::select('name')->where('id', $subjectmaps->subject_id)->first();

            $data[$key]['student_name'] = $students->name;
            $data[$key]['student_roll'] = $students->roll;
            $data[$key]['subject_name'] = $subject->name;
            $data[$key]['exam_code_title'] = $examcode->title;
            $data[$key]['exam_name'] = $exam_name->startup_subcategory_name;
            $data[$key]['class_name'] = $class_name->startup_subcategory_name;
            $data[$key]['section_name'] = $section_name->startup_subcategory_name;
            $data[$key]['shift_name'] = $shift_name->startup_subcategory_name;
            $data[$key]['academic_yr'] = $academic_yr->startup_subcategory_name;
            $data[$key]['institute_name'] = $institute_name->institute_name;
            $data[$key]['institute_add'] = $institute_add->address;
        }
        // $data = json_encode($data);
        return response()->json($data);
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
