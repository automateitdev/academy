<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubjectMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'academic_year_id',
        'student_id',
        'class_id',
        'group_id',
        'subjectmap_id',
        'subject_type_id',
        'marksmap',
        'examstartups_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'std_id');
    }
    public function subjectmap()
    {
        return $this->belongsTo(Subjectmap::class, 'subjectmap_id', 'id');
    }
    public function subjecttype()
    {
        return $this->belongsTo(Subjecttype::class, 'subject_type_id', 'id');
    }
    public function groupassign()
    {
        return $this->belongsTo(GroupAssign::class, 'group_id', 'group_id');
    }
    
}
