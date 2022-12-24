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

set_time_limit(120);

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

        $examstartup_id = Examstartup::select('exam_id','merit_id')->where('id', $request->examstartup_id)->first();
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
        $variable['subject_details'] = [];
        $tmp_var['tmp_subject_details'] = [];
        $gpa_array = [];
        $max_total = 0;
        $marit_position = 1;
        foreach ($data as $key => $arr) {

            if (!in_array($arr['student_id'], $stdID)) {
                array_push($stdID, $arr['student_id']);
            }
        }

        foreach ($stdID as $stdKey => $std_value) {
            $variable[$std_value]['pass'] = true;
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
                                    if($exConfig['examcode_id'] == $exam_code_key && $exConfig['examstartups_id'] == $array_value['examstartups_id'])
                                    {
                                        // return $exConfig['subjectmap_id'];
                                        // $examcode = Examcode::select('title')->where('id', $exam_code_key)->first();
                                        $subjectmaps = Subjectmap::select('subject_id')->where('id', $array_value['subjectmap_id'])->first();
                                        $subject = Subject::select('name','id')->where('id', $subjectmaps->subject_id)->first();
                                         
                                        if($exConfig['subjectmap_id'] == $array_value['subjectmap_id']){
                                            $variable[$std_value][$subject->name][$exConfig->examcode->title] = $Submarks;
                                            $variable[$std_value][$subject->name]['total'] = $sub['total_marks'];
                                            $variable[$std_value][$subject->name]['subject_id'] = $subject->id;


                                            if(!in_array($subject->name, $tmp_var['tmp_subject_details'])){
                                                $variable['subject_details'][$subject->name] = [];
                                                array_push($tmp_var['tmp_subject_details'], $subject->name);
                                            }else{
                                                if(!in_array($exConfig->examcode->title, $variable['subject_details'][$subject->name])){
                                                    
                                                    array_push($variable['subject_details'][$subject->name], $exConfig->examcode->title);
                                                }
                                            }
                                        }
                                      
                                    }
                                    
                                }

                                
                            }
                            

                            foreach ($sub['grade'] as $grade_key => $subGrade) {
                                
                                $convert_to_array = explode(',', $examgrade->grade);
                                for($i=0; $i < count($convert_to_array ); $i++) 
                                {
                                    $key_value=explode(':', $convert_to_array [$i]); 
                                    $end_array[$key_value [0]]=$key_value [1]; 
                                }
                                $case = 0; 
                               
                              foreach($end_array as $gradekey => $gradevalue)
                              {
                                if(!in_array($gradekey, $gpa_array)){
                                    array_push($gpa_array, $gradekey); 
                                }
                                $case++;
                                if($subGrade == $gradekey)
                                {
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
                                $newGP = $gp;
                                $variable[$std_value][$subject->name]['grade_point'] = $newGP;
                                $variable[$std_value][$subject->name]['letter_point'] = $sub['grade']['grade'];
                                $GP_total += $newGP;
                                // return $GP_total;
                                
                              if($variable[$std_value][$subject->name]['grade_point'] == 0)
                              {
                                $variable[$std_value]['pass'] = false;
                              }
                            }
                        }
                    }
                    $students = Student::select('name', 'roll')->where('institute_id', Auth::user()->institute_id)
                        ->where('std_id', $array_value['student_id'])->first();

                    $variable[$std_value]['student_name'] = $students->name;
                    $variable[$std_value]['student_roll'] = $students->roll;
                    $variable[$std_value]['examName'] = $exam_name->startup_subcategory_name;
                    $variable[$std_value]['grand_total'] = $total;
                    $variable[$std_value]['gp_total'] = $GP_total;
                    $variable[$std_value]['GPA'] = $GP_total / count($marks_variable[$std_value]['marksmap']);
                    $gp_range = ["5.00-5.00", "4.00-4.99", "3.50-3.99", "3.00-3.49", "2.00-2.99", "1.00-1.99", "0-0"];
                    $grade_points = array_combine($gpa_array, $gp_range);
                    // return $gpa_array;
                    
                        foreach($grade_points as $gradePoint_key => $grade_point)
                        {
                            $gradePoint_range = explode('-', $grade_point);
                            if($variable[$std_value]['GPA'] >= $gradePoint_range[0] && $variable[$std_value]['GPA'] <= $gradePoint_range[1])
                            {
                                if($variable[$std_value]['pass'])
                                {
                                    $variable[$std_value]['letter_grade'] =  $gradePoint_key;
                                    $variable[$std_value]['merit_pos'] =  "P";
                                    
                                }else{
                                    $variable[$std_value]['letter_grade'] =  "F";
                                    $variable[$std_value]['merit_pos'] =  "0";
                                }
                            }
                        }
                }
            }
            if( $variable[$std_value]['pass'] == true)
            {
                if($examstartup_id->merit_id == "1" || $examstartup_id->merit_id == "2"){
                                  
                    $marit[$std_value] = $variable[$std_value]['grand_total'];
                    
                }elseif($examstartup_id->merit_id == "3" || $examstartup_id->merit_id == "4")
                {
        
                }
                $total_pass++;
            }else{
                $total_fail++;
            }
            
        }
        
        foreach($marit as $marit_key => $marit_value)
        {   
            $marit_id = array_keys($marit, max($marit));
            $variable[$marit_id[0]]['merit_pos'] =  $marit_position++;
            unset($marit[$marit_id[0]]);
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
        $variable['common_detail']['pass_percentage'] = ($total_pass/$participants) * 100;
        

        // return $marit_id;
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
