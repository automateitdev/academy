<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speech extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'name',
        'designation',
        'serial',
        'message',
        'pro_img'
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class, "designation_id");
    }
}
