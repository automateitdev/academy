<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examconfig extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'academic_year_id',
        'class_id',
        'group_id',
        'subjectmap_id',
        'examstartups_id',
        'examcode_id',
        'total_marks',
        'pass_mark',
        'acceptance'
    ];

    public function subjectmap()
    {
        return $this->belongsTo(Subjectmap::class, 'subjectmap_id');
    }
    public function examstartup()
    {
        return $this->belongsTo(Examstartup::class, 'examstartups_id');
    }
    public function examcode()
    {
        return $this->belongsTo(Examcode::class, 'examcode_id');
    }
}
