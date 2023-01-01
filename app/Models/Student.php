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

    public function groupstartups()
    {
        return $this->belongsTo(Startup::class, 'group_id', 'id');
    }
    public function sectionstartups()
    {
        return $this->belongsTo(Startup::class, 'section_id', 'id');
    }
    public function std_cat_startups()
    {
        return $this->belongsTo(Startup::class, 'std_category_id', 'id');
    }
    public function startupcategory()
    {
        return $this->belongsTo(StartupCategory::class);
    }
    public function startupsubcategory()
    {
        return $this->belongsTo(StartupSubcategory::class);
    }
    
    
}
