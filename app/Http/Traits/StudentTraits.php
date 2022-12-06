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

trait StudentTraits
{

    public function assign_fee($student_id, $institute_id)
    {

        $students = Student::where('std_id', $student_id)->where('institute_id', $institute_id)->first();

        $datesetups = Datesetup::all();
        $section_assigns = SectionAssign::all();
        $feeamounts = Feeamount::all();

        if ($students->std_id == $student_id && $students->institute_id == $institute_id) {

            // check class id is equal in student and section assign table
            foreach ($section_assigns as $section_assign) {

                // we check Student table section ID is equal in section assign ID //we get student class_id
                if ($students->section_id == $section_assign->id) {

                    foreach ($feeamounts as $feeamount) {

                        // we check Student table and Feeamount table
                        // we get class_id, std-category_id and group_id
                        if (
                            $section_assign->class_id == $feeamount->class_id
                            && $students->std_category_id == $feeamount->stdcategory_id
                            && $students->group_id == $feeamount->group_id
                        ) {

                            foreach ($datesetups as $datesetup) {

                                if ($datesetup->class_id == $feeamount->class_id) {

                                    // we check student table, datesetup table and fee amount table, we get feesubhead_id
                                    if (
                                        $students->academic_year_id == $datesetup->academic_year_id
                                    ) {
                                        if ($datesetup->feehead_id == $feeamount->feehead_id) {

                                            // $pay_data = Payapply::where('student_id', $student_id)->where('institute_id', $institute_id)
                                            //             ->where('feesubhead_id',$datesetup->feesubhead_id)
                                            //             ->where('feehead_id', $feeamount->feehead_id)->count();

                                            $today = \Carbon\Carbon::now();

                                            if ($today->lte($datesetup->fineactive_date)) {
                                                $fine = 0;
                                            } else {
                                                $fine = $feeamount->fineamount;
                                            }

                                            // $feeheadremoves = Feeheadremove::where([
                                            //     ['feehead_id', $datesetup->feehead_id],
                                            //     ['student_id', $student_id],
                                            //     ['institute_id', $institute_id]
                                            // ])->first();

                                            // if (empty($feeheadremoves)) {
                                            //     $payment_state = 0;
                                            // } else {
                                            //     $payment_state = 3;
                                            // }

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

    public function assign_subject($institute_id, $student_id, $class_id, $group_id)
    {

        $section_id = SectionAssign::select('id')->where('class_id', $class_id)->get();

        if ($student_id != null) {
            foreach ($section_id as $class) {
                $students = Student::where('std_id', $student_id)
                    ->where('institute_id', $institute_id)
                    ->where('section_id', $class)
                    ->where('group_id', $group_id)
                    ->get();

                if (
                    $students->std_id == $student_id && $students->institute_id == $institute_id
                    && $students->section_id == $class && $students->group_id == $group_id
                ) {
                }
            }
        } else {
            foreach ($section_id as $class) {

                // var_dump($institute_id, $class->id, $group_id);
                // die();
                $students = Student::where('institute_id', $institute_id)
                    ->where('section_id', $class->id)
                    ->where('group_id', $group_id)
                    ->get();

                foreach ($students as $student) {
                    // if ($student->institute_id == $institute_id && $student->section_id == $class && $student->group_id == $group_id) {

                    $subjectmaps = Subjectmap::where([
                        ['institute_id', $institute_id],
                        ['class_id', $class_id],
                        ['group_id', $group_id]
                    ])->get();
                    // dd($subjectmaps);
                        
                    foreach($subjectmaps as $subjectmap){
                        $input = StudentSubjectMap::updateOrCreate(

                            [
                                'institute_id' => $institute_id,
                                'student_id' => $student->std_id,
                                'class_id' => $class->id,
                                'group_id' => $group_id,
                                'subjectmap_id' => $subjectmap->id,
                                'subject_type_id' => $subjectmap->type
                            ]
                        );
                    }
                }
            }
        }
    }
}
