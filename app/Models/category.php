<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'name',
        'link_name'
    ];

    public function subcategories()
    {
        return $this->hasMany(subcategory::class, 'cat_id');
    }
}
