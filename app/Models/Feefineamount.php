<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feefineamount extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'class_id',
        'period_id',
        'amount'
    ];
}
