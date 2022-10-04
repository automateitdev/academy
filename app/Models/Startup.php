<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'startup_category_id',
        'startup_subcategory_id'
    ];

    public function startupcategory()
    {
        return $this->belongsTo(StartupCategory::class, "startup_category_id");
    }

    public function startupsubcategory()
    {
        return $this->belongsTo(StartupSubcategory::class, "startup_subcategory_id");
    }
}
