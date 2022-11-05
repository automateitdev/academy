<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'std_id',
        'academic_year_id',
        'session_id',
        'section_id',
        'std_category_id',
        'group_id',
        'roll',
        'name',
        'gender_id',
        'religion_id',
        'father_name',
        'mother_name',
        'mobile_no'
    ];

    public function startupcategory()
    {
        return $this->belongsTo(StartupCategory::class);
    }
    public function startupsubcategory()
    {
        return $this->belongsTo(StartupSubcategory::class);
    }
    
    
}
