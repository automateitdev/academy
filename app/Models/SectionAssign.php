<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionAssign extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'class_id',
        'section_id',
        'shift_id'
    ];

    public function startup()
    {
        return $this->belongsTo(Startup::class, "institute_id");
    }
}
