<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountinfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'crAccount',
        'tranMode',
        'extraRefNo'
    ];
}
