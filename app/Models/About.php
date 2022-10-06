<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'subcat_id',
        'message',
        'about_img'
    ];

    public function subcategories()
    {
        return $this->belongsTo(subcategory::class, "subcat_id");
    }
}
