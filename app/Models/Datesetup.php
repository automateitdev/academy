<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datesetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'class_id',
        'feehead_id',
        'feesubhead_id',
        'payable_date',
        'fineactive_date'
    ];

    public function feehead()
    {
        return $this->belongsTo(FeeHead::class, 'feehead_id');
    }
    public function feesubhead()
    {
        return $this->belongsTo(Feesubhead::class, 'feesubhead_id');
    }
}
