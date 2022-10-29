<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        
    ];

    public function feehead()
    {
        return $this->belongsTo(FeeHead::class);
    }
}
