<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_category_id',
        'account_group'
    ];

    public function accountCategory()
    {
        return $this->belongsTo(AccountCategory::class, "account_category_id");
    }
}
