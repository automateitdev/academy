<?php

namespace App\Http\Traits;

use App\Models\Student;
use App\Models\Datesetup;
use App\Models\SectionAssign;
use App\Models\Feeamount;
use App\Models\Payapply;

trait StudentTraits
{
    public function index()
    {
        // Fetch all the students from the 'student' table.
        $student = Student::all();
        return view('welcome')->with(compact('student'));
    }
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

                    foreach ($feeamounts->unique('feehead_id') as $feeamount) {
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
                                            $payData = Payapply::where('class_id', $datesetup->class_id)->get();
                                            dd($payData);
                                            foreach ($payData as $data) {
                                                
                                                if ($data->feesubhead_id !== $datesetup->feesubhead_id) {
                                                    $input = new Payapply();
                                                    $input->institute_id = $institute_id;
                                                    $input->class_id = $datesetup->class_id;
                                                    $input->student_id = $student_id;
                                                    $input->feehead_id = $feeamount->feehead_id;
                                                    $input->feesubhead_id = $datesetup->feesubhead_id;
                                                    $input->payable = $feeamount->feeamount;
                                                    $input->save();
                                                } else {
                                                    redirect(route('enrollment.excel.index'))->with('error', 'Duplicate Payment');
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
        }
    }
}
