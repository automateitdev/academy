<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiver extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'waiver_name',
    ];

    public function waivermappings()
    {
        return $this->hasMany(Waivermapping::class);
    }
}
