<?php
namespace App\Http\Traits;
use App\Models\Student;
use App\Models\Datesetup;
use App\Models\SectionAssign;
use App\Models\Feeamount;
use App\Models\Payapply;

trait StudentTraits {
    public function index() {
        // Fetch all the students from the 'student' table.
        $student = Student::all();
        return view('welcome')->with(compact('student'));
    }
    public function assign_fee($student_id, $institute_id){

        $students = Student::where('std_id', $student_id)->where('institute_id', $institute_id)->first();
        
        $datesetups = Datesetup::all();
        $section_assigns = SectionAssign::all();
        $feeamounts = Feeamount::all();

        if ($students->std_id == $student_id && $students->institute_id == $institute_id){
            foreach ($section_assigns as $section_assign){
                if ($students->section_id == $section_assign->id){
                    foreach ($feeamounts->unique('feehead_id') as $feeamount){
                        foreach ($datesetups as $datesetup){
                            if ($section_assign->class_id == $datesetup->class_id){
                                if ($students->academic_year_id == $datesetup->academic_year_id){
                                    if ($datesetup->feehead_id == $feeamount->feehead_id){
                                        $input = new Payapply();
                                        $input->institute_id = $institute_id;
                                        $input->student_id = $student_id;
                                        $input->feehead_id = $datesetup->feehead_id;
                                        $input->feesubhead_id = $datesetup->feesubhead_id;
                                        $input->payable = $feeamount->feeamount;
                                        $input->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }                             
                                                                    
    }
}