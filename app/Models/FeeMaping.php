<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeMaping extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'feehead_id',
        'feesubhead_id',
        'ledger_id',
        'fund_id'
    ];
}
