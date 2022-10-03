<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartupCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'startup_category_name',
    ];
}
