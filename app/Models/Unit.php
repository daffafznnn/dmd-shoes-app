<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';

    protected $fillable = [
        'acronym',
        'name',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'unit_id');
    }
}
