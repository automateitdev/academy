<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeamount extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'class_id',
        'group_id',
        'stdcategory_id',
        'feehead_id',
        'feeamount',
        'fineamount',
        'fund_id',
        'fund_amount'
    ];

    public function feehead()
    {
        return $this->belongsTo(FeeHead::class, "feehead_id");
    }
    public function fund()
    {
        return $this->belongsTo(Fund::class, "fund_id");
    }
    
}
