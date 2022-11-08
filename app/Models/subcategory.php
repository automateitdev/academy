<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'cat_id',
        'subcat_name',
        'subcat_link'
    ];

    public function category()
    {
        return $this->belongsTo(category::class, "cat_id");
    }
}
