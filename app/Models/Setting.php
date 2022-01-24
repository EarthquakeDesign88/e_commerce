<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'logo',
        'phone',
        'email',
        'address',
        'facebook_url',
        'instagram_url',
        'line_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
        'meta_url',
        'apple_touch_icon',
        'icon_sm',
        'icon_md',
        'paypal_sandbox',

    ];
}
