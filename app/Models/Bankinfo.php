<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bankinfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'institute_name',
        'account',
        'email',
        'mobile'
    ];
}
