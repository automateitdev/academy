<?php

namespace App\Http\Controllers\dashboard\examManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SectionAssign;
use App\Models\Startup;
use App\Models\Examstartup;
use App\Models\Subjectmap;
use App\Models\GroupAssign;
use App\Models\Subject;
use App\Models\Examconfig;
use App\Models\Student;
use App\Models\StudentSubjectMap;
use App\Models\Examgrade;
use Illuminate\Support\Facades\Auth;

class MarkUpdateController extends Controller
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
        return view('layouts.dashboard.exam_management.mark_update.index', compact('users', 'sectionAssignes', 'startups', 'examstartups', 'subjectmaps'));
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
        // dd($secId->class_id);
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
        $students = Student::where('institute_id', Auth::user()->institute_id)
            ->where('section_id', $secId->id)
            ->where('group_id', $grpId->group_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->get();
        $std_subject_map = StudentSubjectMap::where('institute_id', Auth::user()->institute_id)
            ->where('class_id', $secId->id)
            ->where('group_id', $grpId->group_id)
            ->where('academic_year_id', $academic_year_id)
            ->where('examstartups_id', $request->examstartup_id)
            ->where('subjectmap_id', $request->subject_id)
            ->get();
            
        return view(
            'layouts.dashboard.exam_management.mark_update.index',
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
                }
                $totalmark = array_sum($marks);

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
                $result['grade'] = $grade;
                $result['individual_marks'] = $marks;
                $result['total_marks'] = $totalmark;
                $individualResult[$key] = [];
                array_push($individualResult[$key], $result);
            }
        }
        foreach($individualResult as $individualR_key => $individualR_value){
            $input = StudentSubjectMap::updateOrCreate(
                [
                    'institute_id' => Auth::user()->institute_id,
                    'academic_year_id' => $request->academic_year_id,
                    'student_id' => $individualR_key,
                    'subjectmap_id' => $request->subjectmap_id
                ],
                [
                    'marksmap' => $individualR_value,
                    'examstartups_id' => $request->examstartups_id,
                ]
            );
        }
        return redirect(route('markupdate'))->with('message', 'Data update successfully.');
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
