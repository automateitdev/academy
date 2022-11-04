<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payapply extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'student_id',
        'feehead_id',
        'feesubhead_id',
        'payable',
        'fine',
        'waiver'
    ];
}
