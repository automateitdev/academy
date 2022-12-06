<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubjectMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'student_id',
        'class_id',
        'group_id',
        'subjectmap_id',
        'subject_type_id'
    ];
}
