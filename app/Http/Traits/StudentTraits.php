<?php

namespace App\Http\Traits;

use App\Models\Student;
use App\Models\Datesetup;
use App\Models\SectionAssign;
use App\Models\Feeamount;
use App\Models\Payapply;
use App\Models\Waivermapping;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator as FacadesValidator;

use function PHPUnit\Framework\isEmpty;

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
                                        echo $datesetup->feehead_id;
                                        if ($datesetup->feehead_id == $feeamount->feehead_id) {
                                            
                                            $pay_data = Payapply::where('student_id', $student_id)->where('institute_id', $institute_id)
                                                        ->where('feesubhead_id',$datesetup->feesubhead_id)
                                                        ->where('feehead_id', $feeamount->feehead_id)->count();
                                            // dd($pay_data);
                                            // if($pay_data == 0){
                                            $today = \Carbon\Carbon::now();

                                            if ($today->lte($datesetup->fineactive_date)) {
                                                $fine = 0;
                                            } else {
                                                $fine = $feeamount->fineamount;
                                            }

                                            // $input = new Payapply();
                                            // $input->institute_id = $institute_id;
                                            // $input->class_id = $datesetup->class_id;
                                            // $input->student_id = $student_id;
                                            // $input->feehead_id = $feeamount->feehead_id;
                                            // $input->feesubhead_id = $datesetup->feesubhead_id;
                                            // $input->fine = $fine;
                                            // $input->fineactive_date = $datesetup->fineactive_date;
                                            // $input->payable = $feeamount->feeamount;
                                            // if($input->save())
                                            // {
                                            //     // FacadesSession::put("message", "Payment Data Uploaded Successfully");
                                            //     // FacadesSession::forget('error');
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
// dd($waiver);
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
                                            // }
                                            // else{
                                                // FacadesSession::put('error', 'Duplicate Entry for Fee');
                                                // FacadesSession::forget('message');
                                                // redirect(route('enrollment.excel.index'))->with('error', 'Duplicate tiutiu');
                                            // }
                                            // redirect(route('enrollment.excel.index'))->with(FacadesSession::get("message"))->with(FacadesSession::get("error"));
                                            // redirect(route('enrollment.excel.index'));
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
