<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datesetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'class_id',
        'feehead_id',
        'feesubhead_id',
        'payable_date',
        'fineactive_date'
    ];
}
