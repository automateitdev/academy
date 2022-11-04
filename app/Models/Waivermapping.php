<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waivermapping extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'student_id',
        'feehead_id',
        'waiver_category_id',
        'amount'
    ];

    public function waiver()
    {
        return $this->belongsTo(Waiver::class, 'waiver_category_id');
    }
}
