<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examstartup extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'class_id',
        'exam_id',
        'merit_id'
    ];
    public function startup()
    {
        return $this->belongsTo(Startup::class, 'exam_id', 'id');
    }

}
