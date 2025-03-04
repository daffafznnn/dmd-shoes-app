<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'category_id');
    }
}
