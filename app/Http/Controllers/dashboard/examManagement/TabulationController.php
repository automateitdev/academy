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
use App\Models\Examgrade;
use App\Models\GroupAssign;
use App\Models\StudentSubjectMap;
use App\Models\StartupSubcategory;
use Illuminate\Support\Facades\Auth;

set_time_limit(240);

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

        $group_assign_id = GroupAssign::select('id', 'group_id')
            ->where('id', $request->group_id)
            ->first();

        $class_id = SectionAssign::select('class_id')->where('id', $request->class_id)->first();
        $class = Startup::select('startup_subcategory_id')->where('id', $class_id->class_id)->first();
        $class_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $class->startup_subcategory_id)->first();

        $shift_id = SectionAssign::select('shift_id')->where('id', $request->class_id)->first();
        $shift = Startup::select('startup_subcategory_id')->where('id', $shift_id->shift_id)->first();
        $shift_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $shift->startup_subcategory_id)->first();

        $section_id = SectionAssign::select('section_id')->where('id', $request->class_id)->first();
        $section = Startup::select('startup_subcategory_id')->where('id', $section_id->section_id)->first();
        $section_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $section->startup_subcategory_id)->first();

        $examstartup_id = Examstartup::select('exam_id', 'merit_id')->where('id', $request->examstartup_id)->first();
        $startup_subcategory = Startup::select('startup_subcategory_id')->where('id', $examstartup_id->exam_id)->first();
        $exam_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $startup_subcategory->startup_subcategory_id)->first();

        $academic_yr_id = Startup::select('startup_subcategory_id')->where('id', $request->academic_year_id)->first();
        $academic_yr = StartupSubcategory::select('startup_subcategory_name')->where('id', $academic_yr_id->startup_subcategory_id)->first();

        $institute_name = User::select('institute_name')->where('institute_id', Auth::user()->institute_id)->first();
        $institute_add = User::select('address')->where('institute_id', Auth::user()->institute_id)->first();

        $data = StudentSubjectMap::where('institute_id', Auth::user()->institute_id)
            ->where('class_id', $request->class_id)
            ->where('group_id', $group_assign_id->group_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->where('examstartups_id', $request->examstartup_id)
            ->get();
        // dd(StudentSubjectMap);
        $examconfigs = Examconfig::where('institute_id', Auth::user()->institute_id)
            ->where('class_id', $class_id->class_id)
            ->where('group_id', $group_assign_id->id)
            ->where('academic_year_id', $request->academic_year_id)
            ->where('examstartups_id', $request->examstartup_id)
            ->get();

        $examgrade = Examgrade::where('institute_id', Auth::user()->institute_id)
            ->where('class_id', $class_id->class_id)
            ->first();

        $total_student = Student::where('institute_id', Auth::user()->institute_id)
            ->where('section_id', $request->class_id)
            ->where('group_id', $group_assign_id->group_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->count();


        $data = json_decode($data, true);
        $stdID = [];
        $total_pass = 0;
        $total_fail = 0;
        $c = 0;
        $variable['subject_details'] = [];
        $tmp_var['tmp_subject_details'] = [];
        $gpa_array = [];
        $opt_gp = 0;
        foreach ($data as $key => $arr) {

            if (!in_array($arr['student_id'], $stdID)) {
                array_push($stdID, $arr['student_id']);
            }
        }

        foreach ($stdID as $stdKey => $std_value) {
           
            foreach ($data as $arrKey => $array_value) {
                if ($array_value['student_id'] == $std_value) {
                    $marks_variable[$std_value]['marksmap'][] = $array_value['marksmap'];
                    $total = 0;
                    $GP_total = 0;
                    foreach ($marks_variable[$std_value]['marksmap'] as $marks_data) {
                        $individual_sub =  json_decode($marks_data, true);
                        foreach ($individual_sub as $subKey => $sub) {
                            $total += $sub['total_marks'];
                            foreach ($sub['individual_marks'] as $exam_code_key => $Submarks) {

                                foreach ($examconfigs as $exConfig) {
                                    if ($exConfig['examcode_id'] == $exam_code_key && $exConfig['examstartups_id'] == $array_value['examstartups_id']) {
                                        // return $exConfig['subjectmap_id'];
                                        // $examcode = Examcode::select('title')->where('id', $exam_code_key)->first();
                                        $subjectmaps = Subjectmap::select('subject_id')->where('id', $array_value['subjectmap_id'])->first();
                                        $subject = Subject::select('name', 'id')->where('id', $subjectmaps->subject_id)->first();



                                        if ($exConfig['subjectmap_id'] == $array_value['subjectmap_id']) {
                                            $variable[$std_value][$subject->name][$exConfig->examcode->title] = $Submarks;
                                            $variable[$std_value][$subject->name]['total'] = $sub['total_marks'];
                                            $variable[$std_value][$subject->name]['subject_id'] = $subject->id;


                                            if (!in_array($subject->name, $tmp_var['tmp_subject_details'])) {
                                                $variable['subject_details'][$subject->name] = [];
                                                array_push($tmp_var['tmp_subject_details'], $subject->name);
                                            } else {
                                                if (!in_array($exConfig->examcode->title, $variable['subject_details'][$subject->name])) {
                                                    array_push($variable['subject_details'][$subject->name], $exConfig->examcode->title);
                                                }
                                            }
                                        }
                                    }
                                }
                            }



                            foreach ($sub['grade'] as $grade_key => $subGrade) {
                                $convert_to_array = explode(',', $examgrade->grade);
                                for ($i = 0; $i < count($convert_to_array); $i++) {
                                    $key_value = explode(':', $convert_to_array[$i]);
                                    $end_array[$key_value[0]] = $key_value[1];
                                }
                                $case = 0;
                                foreach ($end_array as $gradekey => $gradevalue) {
                                    if (!in_array($gradekey, $gpa_array)) {
                                        array_push($gpa_array, $gradekey);
                                    }
                                    $case++;
                                    if ($subGrade == $gradekey) {
                                        switch ($case) {
                                            case 1:
                                                $gp = 5.00;
                                                break;
                                            case 2:
                                                $gp = 4.00;
                                                break;
                                            case 3:
                                                $gp = 3.5;
                                                break;
                                            case 4:
                                                $gp = 3.00;
                                                break;
                                            case 5:
                                                $gp = 2.00;
                                                break;
                                            case 6:
                                                $gp = 1.00;
                                                break;
                                            case 7:
                                                $gp = 0;
                                                break;
                                        }
                                    }
                                }

                                $new_gp = $gp;
                                $variable[$std_value][$subject->name]['grade_point'] = $new_gp;
                                $variable[$std_value][$subject->name]['letter_point'] = $sub['grade']['grade'];
                                $GP_total += $new_gp;
                            }

                            if ($array_value['subject_type_id'] == 5 || $array_value['subject_type_id'] == 4) {
                                $variable[$std_value][$subject->name]['optional'] = true;
                                $opt_gp = $gp;
                                $variable[$std_value]['optional_gp'] = $opt_gp;
                                $variable[$std_value]['optional_subject'] = $subject->name;
                            }
                        }
                    }
                    
                    $students = Student::select('name', 'roll')->where('institute_id', Auth::user()->institute_id)
                        ->where('std_id', $array_value['student_id'])->first();

                    $variable[$std_value]['student_name'] = $students->name;
                    $variable[$std_value]['student_roll'] = $students->roll;
                    $variable[$std_value]['examName'] = $exam_name->startup_subcategory_name;
                    $variable[$std_value]['grand_total'] = $total;
                    if (isset($variable[$std_value]['optional_gp'])) {
                        $GP_total = $GP_total - $variable[$std_value]['optional_gp'];
                        if ($variable[$std_value]['optional_gp'] > 2) {
                            $GP_total = $GP_total + ($variable[$std_value]['optional_gp'] - 2);
                        }
                    }
                    $variable[$std_value]['gp_total'] = $GP_total;

                    $totalSubjects = count($marks_variable[$std_value]['marksmap']);
                    if ($array_value['subject_type_id'] == 5 || $array_value['subject_type_id'] == 4) {
                        $totalSubjects--;
                    }
                    $variable[$std_value]['GP_total'] = $GP_total;
                    $GPA_calc = $GP_total / $totalSubjects;
                    if ($GPA_calc > 5) {
                        $GPA_calc = 5.00;
                    }
                    $variable[$std_value]['GPA'] = round((float)$GPA_calc, 2);
                    $gp_range = ["5.00-5.00", "4.00-4.99", "3.50-3.99", "3.00-3.49", "2.00-2.99", "1.00-1.99", "0-0"];
                    $grade_points = array_combine($gpa_array, $gp_range);
                    // return $gpa_array;

                    foreach ($grade_points as $gradePoint_key => $grade_point) {
                        $gradePoint_range = explode('-', $grade_point);
                        if ($variable[$std_value]['GPA'] >= $gradePoint_range[0] && $variable[$std_value]['GPA'] <= $gradePoint_range[1]) {
                            $variable[$std_value]['letter_grade'] =  $gradePoint_key;
                        }
                    }
                }
            }
        }



        $students_ids = [];
        foreach ($variable as $var_key => $var_value) {
            if ($var_key !== "subject_details" && $var_key !== "common_detail") {
                $variable[$var_key]['pass'] = true;
                foreach ($var_value as $innerkey => $innervalue) {
                    if (isset($innervalue['grade_point'])) {
                        if ($innervalue['grade_point'] == 0) {
                            if (!isset($innervalue['optional'])) {
                                $variable[$var_key]['pass'] = false;
                            }
                        }
                    }
                }

                if ($variable[$var_key]['pass'] == true) {
                    $marks_array[$total_pass]['id'] = $var_key;
                    $marks_array[$total_pass]['total'] = $variable[$var_key]['grand_total'];

                    $merit_gpa_array[$total_pass]['id'] = $var_key;
                    $merit_gpa_array[$total_pass]['gpa'] = $variable[$var_key]['GPA'];

                    $marit_data['merit'][$total_pass]['std_id'] = $var_key;
                    $marit_data['merit'][$total_pass]['total_marks'] = $variable[$var_key]['grand_total'];
                    $marit_data['merit'][$total_pass]['avg_gp'] = $variable[$var_key]['GPA'];
                    $total_pass++;
                }

                if ($variable[$var_key]['pass'] == false) {
                    $variable[$var_key]['merit_pos'] = 0;
                    $total_fail++;
                    $variable[$var_key]['letter_grade'] = "F";
                }
            }
        }


        if (isset($marks_array) && isset($merit_gpa_array)) {
            if ($examstartup_id->merit_id == "1" || $examstartup_id->merit_id == "2") {
                $sorted_totalmarks = [];
                foreach ($marks_array as $sortkey => $row) {
                    $sorted_totalmarks[$sortkey] = $row['total'];
                }
                array_multisort($sorted_totalmarks, SORT_DESC, $marks_array);
                $position = 0;
                foreach ($marks_array as $mark_key => $mark_value) {
                    $position++;
                    $variable[$mark_value['id']]['merit_pos'] = $position;
                }
            } else if ($examstartup_id->merit_id == "3" || $examstartup_id->merit_id == "4") {
                $sorted_gradepoints = [];
                foreach ($merit_gpa_array as $gpakey => $row) {
                    $sorted_gradepoints[$gpakey] = $row['gpa'];
                }
                array_multisort($sorted_gradepoints, SORT_DESC, $merit_gpa_array);
                // return $merit_gpa_array;
                $position = 0;
                foreach ($merit_gpa_array as $gpakey => $gpa_value) {
                    $position++;
                    $variable[$gpa_value['id']]['merit_pos'] = $position;
                }
            }
        }

        $participants =  count($stdID);
        $variable['common_detail']['exam_name'] = $exam_name->startup_subcategory_name;
        $variable['common_detail']['class_name'] = $class_name->startup_subcategory_name;
        $variable['common_detail']['section_name'] = $section_name->startup_subcategory_name;
        $variable['common_detail']['shift_name'] = $shift_name->startup_subcategory_name;
        $variable['common_detail']['academic_yr'] = $academic_yr->startup_subcategory_name;
        $variable['common_detail']['institute_name'] = $institute_name->institute_name;
        $variable['common_detail']['institute_add'] = $institute_add->address;
        $variable['common_detail']['total_student'] = $total_student;
        $variable['common_detail']['participants'] = $participants;
        $variable['common_detail']['total_pass'] = $total_pass;
        $variable['common_detail']['total_fail'] = $total_fail;
        
        if($participants == 0){       
          $variable['common_detail']['pass_percentage'] = 0;
        }else{
          $variable['common_detail']['pass_percentage'] = round((float)(($total_pass / $participants) * 100), 2);
        }

        // return $merit_gpa_array;
        // return $c;
        // return $variable;


        $data = json_encode($variable);
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
        // $total = 0;
        //             foreach ($examconfigs as $exConfig) {

        //                 $mark_array = json_decode($arr['marksmap'], true);
        //                 foreach ($mark_array as $mark_key => $marks) {
        //                     $total += $marks['total_marks'];
        //                     $finalmark = $marks['individual_marks'];
        //                     foreach ($finalmark as $fkey => $fMark) {
        //                         if ($fkey == $exConfig['examcode_id']) {
        //                             $examcode = Examcode::select('title')->where('id', $exConfig['examcode_id'])->first();
        //                         }
        //                     }
        //                 }
        //                 if ($arr['subjectmap_id'] == $exConfig['subjectmap_id'] && $arr['examstartups_id'] == $exConfig['examstartups_id']) {
        //                     $examcode = Examcode::select('title')->where('id', $exConfig['examcode_id'])->first();
        //                 }
        //             }
        //             $students = Student::select('name', 'roll')->where('institute_id', Auth::user()->institute_id)
        //                 ->where('std_id', $arr['student_id'])->first();

        //             $subjectmaps = Subjectmap::select('subject_id')->where('id', $arr['subjectmap_id'])->first();
        //             $subject = Subject::select('name')->where('id', $subjectmaps->subject_id)->first();

        //             $data[$key][$examcode->title] = $fMark;
        //             $data[$key]['subject_wise_mark'] = $marks['total_marks'];
        //             $data[$key]['grand_total'] = $total;
        //             $data[$key]['student_name'] = $students->name;
        //             $data[$key]['student_roll'] = $students->roll;
        //             $data[$key]['subject_name'] = $subject->name;
        //             $data[$key]['exam_code_title'] = $examcode->title;
        //             $data[$key]['exam_name'] = $exam_name->startup_subcategory_name;
        //             $data[$key]['class_name'] = $class_name->startup_subcategory_name;
        //             $data[$key]['section_name'] = $section_name->startup_subcategory_name;
        //             $data[$key]['shift_name'] = $shift_name->startup_subcategory_name;
        //             $data[$key]['academic_yr'] = $academic_yr->startup_subcategory_name;
        //             $data[$key]['institute_name'] = $institute_name->institute_name;
        //             $data[$key]['institute_add'] = $institute_add->address;
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

