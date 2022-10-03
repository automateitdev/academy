<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartupSubcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'startup_category_id',
        'startup_subcategory_name'
    ];

    public function startupCategory()
    {
        return $this->belongsTo(StartupCategory::class, "startup_category_id");
    }
}
