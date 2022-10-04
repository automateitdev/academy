<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'institute_title',
        'web_link',
        'google_map',
        'fb_link',
        'youtube_link',
        'twitter_link',
        'insta_link',
        'pi_link',
        'logo'
    ];
}
