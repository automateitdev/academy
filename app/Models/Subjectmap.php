<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjectmap extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'class_id',
        'group_id',
        'subject_id',
        'type',
        'serial',
        'merge'
    ];
}
