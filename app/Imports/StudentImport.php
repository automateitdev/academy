<?php

namespace App\Imports;

use App\Models\Gender;
use App\Models\Religion;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $institute_id;
    private $academic_year_id;
    private $session_id;
    private $section_id;
    private $std_category_id;
    private $group_id;

    public function __construct(
        $institute_id,
        $academic_year_id,
        $session_id,
        $section_id,
        $std_category_id,
        $group_id
    ) {
        $this->institute_id = $institute_id;
        $this->academic_year_id = $academic_year_id;
        $this->session_id = $session_id;
        $this->section_id = $section_id;
        $this->std_category_id = $std_category_id;
        $this->group_id = $group_id;
    }


    // public function headingRow(): int
    // {
    //     return 2;
    // }

    public function model(array $rows)
    {
        // dd($rows);

        if (
            !empty($rows['student_id']) &&
            !empty($rows['roll']) &&
            !empty($rows['name']) &&
            !empty($rows['gender']) &&
            !empty($rows['religion']) &&
            !empty($rows['father_name']) &&
            !empty($rows['mother_name']) &&
            !empty($rows['mobile_no'])
        ) {
            // echo "aschi";
            $gender = Gender::where('g_name', $rows['gender'])->first();
            // dd($gender);
            $religion = Religion::where('r_name', $rows['religion'])->first();
            
            return new Student([
                'std_id' => $rows['student_id'],
                'roll' => $rows['roll'],
                'name' => $rows['name'],
                'gender_id' => $gender->id,
                'religion_id' => $religion->id,
                'father_name' => $rows['father_name'],
                'mother_name' => $rows['mother_name'],
                'mobile_no' => $rows['mobile_no'],
                'institute_id' => $this->institute_id,
                'academic_year_id' => $this->academic_year_id,
                'session_id' => $this->session_id,
                'section_id' => $this->section_id,
                'std_category_id' => $this->std_category_id,
                'group_id' => $this->group_id,
            ]);
        }
    }
}
