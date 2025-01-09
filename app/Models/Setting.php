<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'name',
        'alias',
        'logo',
        'favicon',
        'description',
        'email',
        'phone',
        'address',
        'latitude',
        'longitude',
        'is_maintenance',
        'app_key'
    ];
}
