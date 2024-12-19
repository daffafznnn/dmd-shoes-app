<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiSetting extends Model
{
    protected $table = 'api_settings';

    protected $fillable = [
        'setting_id',
        'api_name',
        'api_key',
        'api_secret',
    ];

    public function settings()
    {
        return $this->belongsTo(Setting::class, 'setting_id', 'id');
    }
}
