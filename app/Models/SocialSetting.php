<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialSetting extends Model
{
    protected $table = 'social_settings';

    protected $fillable = [
        'setting_id',
        'name',
        'icon',
        'url'
    ];

    public function settings()
    {
        return $this->belongsTo(Setting::class, 'setting_id', 'id');
    }
}
