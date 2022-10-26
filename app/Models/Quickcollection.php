<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quickcollection extends Model
{
    use HasFactory;

    protected $fillable = [
        
    ];

    public function startups()
    {
        return $this->belongsTo(Startup::class);
    }
    public function startupsubcat()
    {
        return $this->belongsTo(StartupSubcategoryart::class);
    }
}
