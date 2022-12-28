<?php

namespace App\Http\Traits;

use App\Models\Student;
use App\Models\Datesetup;
use App\Models\SectionAssign;
use App\Models\Feeamount;
use App\Models\Payapply;
use App\Models\Waivermapping;
use App\Models\StudentSubjectMap;
use App\Models\Subjectmap;
use App\Models\GroupAssign;

trait StudentTraits
{

    public function assign_fee($student_id, $institute_id)
    {

        $students = Student::where('std_id', $student_id)->where('institute_id', $institute_id)->first();

        $datesetups = Datesetup::all();
        $section_assigns = SectionAssign::all();
        $feeamounts = Feeamount::all();

        if ($students->std_id == $student_id && $students->institute_id == $institute_id) {

            foreach ($section_assigns as $section_assign) {

                if ($students->section_id == $section_assign->id) {

                    foreach ($feeamounts as $feeamount) {

                        if (
                            $section_assign->class_id == $feeamount->class_id
                            && $students->std_category_id == $feeamount->stdcategory_id
                            && $students->group_id == $feeamount->group_id
                        ) {

                            foreach ($datesetups as $datesetup) {

                                if ($datesetup->class_id == $feeamount->class_id) {

                                    if (
                                        $students->academic_year_id == $datesetup->academic_year_id
                                    ) {
                                        if ($datesetup->feehead_id == $feeamount->feehead_id) {

                                            $today = \Carbon\Carbon::now();

                                            if ($today->lte($datesetup->fineactive_date)) {
                                                $fine = 0;
                                            } else {
                                                $fine = $feeamount->fineamount;
                                            }


                                            $waiver = Waivermapping::where([
                                                ['feehead_id', $datesetup->feehead_id],
                                                ['student_id', $student_id],
                                                ['institute_id', $institute_id]
                                            ])->first();

                                            if (empty($waiver)) {
                                                $waiver_amount = 0;
                                                $waiver_category = null;
                                            } else {
                                                $waiver_amount = $waiver->amount;
                                                $waiver_category = $waiver->waiver_category_id;
                                            }
                                            $total_amount = ($feeamount->feeamount + $fine) - $waiver_amount;
                                            $payapply = Payapply::updateOrCreate(
                                                ['class_id' => $datesetup->class_id, 'student_id' => $student_id, 'feehead_id' => $feeamount->feehead_id, 'feesubhead_id' => $datesetup->feesubhead_id],
                                                [
                                                    'institute_id' => $institute_id,
                                                    'fine' => $fine,
                                                    'payable_date' => $datesetup->payable_date,
                                                    'fineactive_date' => $datesetup->fineactive_date,
                                                    'waiver_id' => $waiver_category,
                                                    'waiver_amount' => $waiver_amount,
                                                    'payable' => $feeamount->feeamount,
                                                    'total_amount' => $total_amount
                                                ]
                                            );
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

    public function assign_subject($institute_id, $student_id, $class_id, $group_id, $academic_year_id)
    {
         // dd($institute_id, $student_id, $class_id, $group_id, $academic_year_id);
        if ($student_id != null) {
            
            $section_id = SectionAssign::select('id','class_id')->where('id', $class_id)->first();
            $groupassign_group_id = GroupAssign::select('id')
                                ->where('class_id', $section_id->class_id)
                                ->where('group_id', $group_id)->first();
            // foreach ($section_id as $class) {
                // dd($class);
                $students = Student::where('std_id', $student_id)
                    ->where('institute_id', $institute_id)
                    ->where('section_id', $class_id)
                    ->where('group_id', $group_id)
                    ->where('academic_year_id',$academic_year_id)
                    ->get();
            
                // dd($students);
                foreach($students as $student)
                    {
                    $subjectmaps = Subjectmap::where([
                        ['institute_id', $institute_id],
                        ['class_id', $section_id->class_id],
                        ['group_id', $groupassign_group_id->id],
                        ['academic_year_id', $academic_year_id]
                    ])->get();
                    // dd($class->class_id, $groupassign_group_id->id);
                    foreach($subjectmaps as $subjectmap){
                        $input = StudentSubjectMap::updateOrCreate(
                            [
                                'institute_id' => $institute_id,
                                'academic_year_id' => $academic_year_id,
                                'student_id' => $student->std_id,
                                'class_id' => $class_id,
                                'group_id' => $group_id,
                                'subjectmap_id' => $subjectmap->id,
                                'subject_type_id' => $subjectmap->type,
                            ]
                        );
                    }

                    
                }
            // }
        } else {
            
            $groupassign_group_id = GroupAssign::select('group_id')->where('id', $group_id)->first();
            $section_id = SectionAssign::where('class_id', $class_id)->get();
            foreach ($section_id as $class) {
                $students = Student::where('institute_id', $institute_id)
                    ->where('section_id', $class->id)
                    ->where('group_id', $groupassign_group_id->group_id)
                    ->where('academic_year_id',$academic_year_id)
                ->get();
                foreach ($students as $student) {
                    $subjectmaps = Subjectmap::where([
                        ['institute_id', $institute_id],
                        ['class_id', $class_id],
                        ['group_id', $group_id],
                        ['academic_year_id', $academic_year_id]
                    ])->get();
                    foreach($subjectmaps as $subjectmap){
                        $input = StudentSubjectMap::updateOrCreate(
                            [
                                'institute_id' => $institute_id,
                                'academic_year_id' => $academic_year_id,
                                'student_id' => $student->std_id,
                                'subjectmap_id' => $subjectmap->id,
                            ],
                            [
                                'class_id' => $class->id,
                                'group_id' => $groupassign_group_id->group_id,
                                'subject_type_id' => $subjectmap->type
                            ]
                        );
                    }
                }
            }
        }
    }
}
