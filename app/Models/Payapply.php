<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payapply extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'student_id',
        'class_id',
        'feehead_id',
        'feesubhead_id',
        'payable',
        'fine',
        'payable_date',
        'fineactive_date',
        'total_amount',
        'waiver_id',
        'waiver_amount',
        'trx_id',
        'academic_year_id'
    ];

    public function ye_startup()
    {
        return $this->belongsTo(Startup::class, 'academic_year_id', 'id');
    }
    public function feehead()
    {
        return $this->belongsTo(FeeHead::class, 'feehead_id');
    }
    public function feesubhead()
    {
        return $this->belongsTo(Feesubhead::class, 'feesubhead_id');
    }
}
