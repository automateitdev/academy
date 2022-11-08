<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'subcat_id',
        'id_no',
        'nid',
        'name',
        'f_name',
        'm_name',
        'edu',
        'sex',
        'religion',
        'designation',
        'birth_date',
        'blood',
        'address',
        'mobile',
        'email',
        'join_date',
        'note',
        'photo'
    ];

    public function subcategories()
    {
        return $this->belongsTo(subcategory::class, "subcat_id");
    }

}
