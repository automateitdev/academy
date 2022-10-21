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


    public function headingRow(): int
    {
        return 2;
    }

    public function model(array $rows)
    {

        if (
            !empty($rows['Student ID']) &&
            !empty($rows['Roll']) &&
            !empty($rows['Name']) &&
            !empty($rows['Gender']) &&
            !empty($rows['Religion']) &&
            !empty($rows['Father Name']) &&
            !empty($rows['Mother Name']) &&
            !empty($rows['Mobile No'])
        ) {
            echo "aschi";
            $gender = Gender::where('g_name', $rows['Gender'])->get();
            $religion = Religion::where('r_name', $rows['Religion'])->get();
            
            return new Student([
                'std_id' => $rows['Student ID'],
                'roll' => $rows['Roll'],
                'name' => $rows['Name'],
                'gender_id' => $gender->id,
                'religion_id' => $religion->id,
                'father_name' => $rows['Father Name'],
                'mother_name' => $rows['Mother Name'],
                'mobile_no' => $rows['Mobile No'],
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
