<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalGrade extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'class_id',
        'grade'
    ];
}
