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
        'class_id',
        'feehead_id',
        'feesubhead_id',
        'payable',
        'fine',
        'fineactive_date',
        'total_amount',
        'waiver_id',
        'waiver_amount',
        'trx_id'
    ];
}
