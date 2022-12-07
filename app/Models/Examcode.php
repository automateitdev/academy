<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examcode extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'class_id',
        'title',
    ];

    public function exam_startup()
    {
        return $this->belongsTo(Examstartup::class);
    }
    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }
    public function startupSubcategory()
    {
        return $this->belongsTo(startupSubcategory::class);
    }
}
