<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'fund_name'
    ];

    public function feehead()
    {
        return $this->belongsTo(FeeHead::class);
    }
}
