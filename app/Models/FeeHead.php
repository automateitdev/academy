<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeHead extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'head_name'
    ];

    public function feesubheads()
    {
        return $this->hasMany(Feesubhead::class);
    }
    public function ledger()
    {
        return $this->hasOne(Ledger::class);
    }
    public function funds()
    {
        return $this->hasMany(Fund::class);
    }

}
