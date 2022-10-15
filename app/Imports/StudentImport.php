<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentImport implements  ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // private $institute_id;
    // private $academic_year_id;
    // private $session_id;
    // private $section_id;
    // private $std_category_id;
    // private $group_id;
    // public function __construct(  $institute_id) 
    // {
    //     $this->institute_id = $institute_id;
    // }
    // public function __construct(  $institute_id,   $academic_year_id
    // ,   $session_id,   $section_id,  $std_category_id,   $group_id) 
    // {
    //     $this->institute_id = $institute_id;
    //     $this->academic_year_id = $academic_year_id;
    //     $this->session_id = $session_id;
    //     $this->section_id = $section_id;
    //     $this->std_category_id= $std_category_id;
    //     $this->group_id = $group_id;
    
    // }


    public function collection(Collection $rows)
    {
        var_dump($rows);
        die();

        return new Student([
            // 'std_id'=> $row['std_id'],
            // 'roll' => $row['Roll'],
            // 'name' => $row['Name'],
            // 'gender_id' => $row['Gender'],
            // 'religion_id' => $row['Religion'],
            // 'father_name' => $row['Father Name'],
            // 'mother_name' => $row['Mother Name'],
            // 'mobile_no' => $row['Mobile No'],
            // 'institute_id' => $this->institute_id,
            // 'academic_year_id' => $this->academic_year_id,
            // 'session_id' => $this->session_id,
            // 'section_id' => $this->section_id,
            // 'std_category_id' => $this->std_category_id,
            // 'group_id' => $this->group_id,
        ]);
    }
}
