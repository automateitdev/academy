<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $institute_id;
    protected $academic_year_id;
    protected $session_id;
    protected $section_id;
    protected $std_category_id;
    protected $group_id;

    public function __construct(  $institute_id,   $academic_year_id
    ,   $session_id,   $section_id,  $std_category_id,   $group_id) 
    {
        $this->institute_id = $institute_id;
        $this->academic_year_id = $academic_year_id;
        $this->session_id = $session_id;
        $this->section_id = $section_id;
        $this->std_category_id= $std_category_id;
        $this->group_id = $group_id;
    }

    public function model(array $row)
    {
        return new Student([
            
            'std_id'=> $row[1],
            'roll' => $row[2],
            'name' => $row[3],
            'gender_id' => $row[4],
            'religion_id' => $row[5],
            'father_name' => $row[6],
            'mother_name' => $row[7],
            'mobile_no' => $row[8],
            'institute_id' => $this->institute_id,
            'academic_year_id' => $this->academic_year_id,
            'session_id' => $this->session_id,
            'section_id' => $this->section_id,
            'std_category_id' => $this->std_category_id,
            'group_id' => $this->group_id,
        ]);
    }
}
