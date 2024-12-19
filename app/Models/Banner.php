<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'alt_text',
        'target_url',
        'status',
        'sort_order',
        'start_date',
        'end_date',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}