<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeFineMaping extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'feehead_id',
        'ledger_id',
        'fund_id'
    ];

    public function feehead()
    {
        return $this->belongsTo(FeeHead::class, "feehead_id");
    }
    public function fund()
    {
        return $this->belongsTo(Fund::class, "fund_id");
    }
    public function ledger()
    {
        return $this->belongsTo(Ledger::class, "ledger_id");
    }
}
