<?php

namespace App\Http\Controllers\dashboard\examManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\Examstartup;
use App\Models\StartupSubcategory;
use App\Models\Examconfig;
use App\Models\Subjectmap;
use App\Models\Subject;
use App\Models\SectionAssign;
use App\Models\GroupAssign;
use App\Models\Student;
use App\Models\Examgrade;
use App\Models\StudentSubjectMap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MarkInputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('institute_id', Auth::user()->institute_id)->get();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $examstartups = Examstartup::where('institute_id', Auth::user()->institute_id)->get();
        $subjectmaps = Subjectmap::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.exam_management.mark_input.index', compact('users', 'sectionAssignes', 'startups', 'examstartups', 'subjectmaps'));
    }
    public function getgroupforexaminput(Request $request)
    {
        $startup_id = [];
        $groupname = [];
        $groupassign_id = [];
        $secId = SectionAssign::select('class_id')->where('id', $request->id)->first();
        $data = GroupAssign::select('id', 'group_id')->where('class_id', $secId->class_id)->get();
        foreach ($data as $d) {
            $startups = Startup::select('startup_subcategory_id')->where('id', $d->group_id)->get();
            array_push($groupassign_id, $d->id);
            foreach ($startups as $startup) {
                array_push($startup_id, $startup->startup_subcategory_id);
                $subName = StartupSubcategory::select('startup_subcategory_name')->where('id', $startup->startup_subcategory_id)->get();
                foreach ($subName as $name) {
                    array_push($groupname, $name->startup_subcategory_name);
                }
            }
        }
        $groupdata = array_combine($groupassign_id, $groupname);
        return $groupdata;
    }
    public function getexamfromexamcreate(Request $request)
    {
        // $startup_id = [];
        $getexamname = [];
        $getexamID = [];
        $secId = SectionAssign::select('class_id')->where('id', $request->id)->first();
        $data = Examstartup::select('id', 'exam_id')->where('class_id', $secId->class_id)->get();
        // return $data;
        foreach ($data as $d) {
            $startups = Startup::select('startup_subcategory_id')->where('id', $d->exam_id)->get();
            array_push($getexamID, $d->id);
            foreach ($startups as $startup) {
                // array_push($startup_id, $startup->startup_subcategory_id);
                $subName = StartupSubcategory::select('startup_subcategory_name')->where('id', $startup->startup_subcategory_id)->get();
                foreach ($subName as $name) {
                    array_push($getexamname, $name->startup_subcategory_name);
                }
            }
        }
        // return $getexamID;
        $groupdata = array_combine($getexamID, $getexamname);
        return $groupdata;

    }
    public function getsubjectinfo(Request $request)
    {
        $data_id = [];
        $data_name = [];
        $secId = SectionAssign::select('class_id')->where('id', $request->id)->first();
        // $grId = GroupAssign::where('class_id', $secId->class_id)
        $examconfig = Examconfig::select('subjectmap_id')
        ->where('class_id', $secId->class_id)->get();
        foreach ($examconfig as $sbjmap_id) {
            $data = Subjectmap::select('id', 'subject_id')->where('id', $sbjmap_id->subjectmap_id)->get();

            foreach ($data as $d) {
                array_push($data_id, $d->id);
                $subjects = Subject::select('name')->where('id', $d->subject_id)->get();
                foreach ($subjects as $subject) {
                    array_push($data_name, $subject->name);
                }
            }
        }
        $alldata = array_combine($data_id, $data_name);

        return $alldata;
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'class_id' => 'required',
            'group_id' => 'required',
            'academic_year_id' => 'required',
            'examstartup_id' => 'required',
            'subject_id' => 'required'
        ]);

        $examstartup_id = $request->examstartup_id;
        $academic_year_id = $request->academic_year_id;
        $class_id = $request->class_id;
        $group_id = $request->group_id;
        $secId = SectionAssign::select('class_id', 'id')->where('id', $request->class_id)->first();
        $grpId = GroupAssign::select('group_id', 'id')->where('id', $request->group_id)->first();

        $subjectId = Subjectmap::select('id', 'subject_id')->where('id', $request->subject_id)->first();
        $subjectName = Subject::select('name')->where('id', $subjectId->subject_id)->first();
        // dd($subjectId->id);
        $users = User::where('institute_id', Auth::user()->institute_id)->get();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $examconfigs = Examconfig::where('institute_id', Auth::user()->institute_id)
            ->where('class_id', $secId->class_id)
            ->where('group_id', $request->group_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->where('examstartups_id', $request->examstartup_id)
            ->where('subjectmap_id', $request->subject_id)
            ->get();
        $students = DB::table('students')
            ->where('institute_id', Auth::user()->institute_id)
            ->where('section_id', $secId->id)
            ->where('group_id', $grpId->group_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->orderBy('roll', 'asc')
            ->get();
        // dd($students);
        $std_subject_map = StudentSubjectMap::where('institute_id', Auth::user()->institute_id)
            ->where('class_id', $request->class_id)
            ->where('group_id', $grpId->group_id)
            ->where('academic_year_id', $academic_year_id)
            ->where('subjectmap_id', $request->subject_id)
            ->get();
        //dd($std_subject_map);
        return view(
            'layouts.dashboard.exam_management.mark_input.index',
            compact(
                'users',
                'sectionAssignes',
                'startups',
                'examconfigs',
                'students',
                'subjectId',
                'examstartup_id',
                'academic_year_id',
                'class_id',
                'group_id',
                'std_subject_map',
                'subjectName'
            )
        );
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
         //dd($request);
        $grpId = GroupAssign::select('group_id', 'id')->where('id', $request->group_id)->first();
        $secId = SectionAssign::select('class_id', 'id')->where('id', $request->class_id)->first();
        $gradepoint = Examgrade::select('grade')->where('institute_id', Auth::user()->institute_id)
            ->where('class_id', $secId->class_id)
            ->first();
        $individualResult = [];
        $marks = [];
        $grade = [];
        $passMark = Examconfig::where('institute_id', Auth::user()->institute_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->where('class_id', $secId->class_id)
            ->where('group_id', $request->group_id)
            ->where('subjectmap_id', $request->subjectmap_id)
            ->where('examstartups_id', $request->examstartups_id)
            ->first();
        if ($passMark->pass_mark != 0) {
            foreach ($request->subject as $key => $sub) {
                foreach ($sub as $subkey => $subvalue) {
                    $examconfig = Examconfig::where('institute_id', Auth::user()->institute_id)
                        ->where('academic_year_id', $request->academic_year_id)
                        ->where('class_id', $secId->class_id)
                        ->where('group_id', $request->group_id)
                        ->where('subjectmap_id', $request->subjectmap_id)
                        ->where('examstartups_id', $request->examstartups_id)
                        ->where('examcode_id', $subkey)
                        ->first();

                    $individualMark = $subvalue * $examconfig->acceptance;
                    $marks[$subkey] = round($individualMark);
                    if ($subvalue < $examconfig->pass_mark) {
                        $grade['grade'] = 'F';
                        $grade['fail_exam_code'] = $subkey;
                    }
                }
                $totalmark = array_sum($marks);
                if (!in_array('F', $grade)) {

                    $convert_to_array = explode(',', $gradepoint->grade);
                    for ($i = 0; $i < count($convert_to_array); $i++) {
                        $key_value = explode(':', $convert_to_array[$i]);
                        $end_array[$key_value[0]] = $key_value[1];
                    }
                    foreach ($end_array as $gkey => $g_value) {
                        $range = explode('-', $g_value);
                        if ($totalmark >= $range[0] && $totalmark <= $range[1]) {
                            $grade['grade'] = $gkey;
                        }
                    }
                }
                $result['grade'] = $grade;
                $result['individual_marks'] = $marks;
                $result['total_marks'] = $totalmark;
                $individualResult[$key] = [];


                array_push($individualResult[$key], $result);
                $grade = [];
            }
        } else {
            $total_exam_mark = [];
            $temp_total_exam_mark = [];

            $individual_input_mark = [];
            $temp_individual_input_mark = [];
            foreach ($request->subject as $key => $sub) {
                foreach ($sub as $subkey => $subvalue) {
                    $examconfig = Examconfig::where('institute_id', Auth::user()->institute_id)
                        ->where('academic_year_id', $request->academic_year_id)
                        ->where('class_id', $secId->class_id)
                        ->where('group_id', $request->group_id)
                        ->where('subjectmap_id', $request->subjectmap_id)
                        ->where('examstartups_id', $request->examstartups_id)
                        ->where('examcode_id', $subkey)
                        ->first();

                    if($examconfig->acceptance >1 || $examconfig->acceptance < 0)
                    {
                        return redirect(route('markinput'))->with('error', 'Acceptance cannot be more than 1 and negative value');
                    }else{
                       
                        $marks[$subkey] = round($subvalue);


                        $mul_acceptance_examMark = $examconfig->total_marks * $examconfig->acceptance;
                        array_push($temp_total_exam_mark,$mul_acceptance_examMark);

                        $mul_individualMark = $subvalue * $examconfig->acceptance;
                        array_push($temp_individual_input_mark,$mul_individualMark);

                        array_push($total_exam_mark,$examconfig->total_marks);
                        array_push($individual_input_mark, $marks[$subkey]);
                    }
                }
                
                $totalmark = array_sum($marks);
                $mul_assigned_exam_mark = array_sum($temp_total_exam_mark);
                $mul_obtained_exam_mark = array_sum($temp_individual_input_mark);

                $obtained_mark_percentage = ($mul_obtained_exam_mark/$mul_assigned_exam_mark) * 100;
                // dd($mul_assigned_exam_mark,$mul_obtained_exam_mark, $obtained_mark_percentage); 

                $convert_to_array = explode(',', $gradepoint->grade);
                for ($i = 0; $i < count($convert_to_array); $i++) {
                    $key_value = explode(':', $convert_to_array[$i]);
                    $end_array[$key_value[0]] = $key_value[1];
                }
                foreach ($end_array as $gkey => $g_value) {
                    $range = explode('-', $g_value);
                    //dd($obtained_mark_percentage);
                    if ($obtained_mark_percentage >= $range[0] && $obtained_mark_percentage <= $range[1]) {
                        $grade['grade'] = $gkey;
                    }
                }
                //dd($grade);
                $result['grade'] = $grade;
                $result['individual_marks'] = $marks;
                $result['total_marks'] = $totalmark;
                $individualResult[$key] = [];
                array_push($individualResult[$key], $result);
            }
        }
        //dd($individualResult);
        foreach ($individualResult as $individualR_key => $individualR_value) {
            $vv = json_encode($individualR_value);
          
            $input = StudentSubjectMap::updateOrCreate(
                [
                    'institute_id' => Auth::user()->institute_id,
                    'academic_year_id' => $request->academic_year_id,
                    'student_id' => $individualR_key,
                    'subjectmap_id' => $request->subjectmap_id
                ],
                [
                    'class_id' => $request->class_id,
                    'group_id' => $grpId->group_id,
                    'marksmap' => $vv,
                    'examstartups_id' => $request->examstartups_id
                ]
            );
        }
        return redirect(route('markinput'))->with('message', 'Data uploaded successfully.');
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
