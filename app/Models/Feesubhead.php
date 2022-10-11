<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feesubhead extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'subhead_name'
    ];
}
