<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'place_id',
        'status',
        'title',
        'sign'  
    ];

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }
}
