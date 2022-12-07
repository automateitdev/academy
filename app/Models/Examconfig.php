<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examconfig extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'class_id',
        'group_id',
        'subjectmap_id',
        'examstartups_id',
        'examcode_id',
        'total_marks',
        'pass_mark',
        'acceptance'
    ];
}
