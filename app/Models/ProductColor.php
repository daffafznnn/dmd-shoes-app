<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $table = 'product_colors';

    protected $fillable = [
        'name',
        'slug',
        'status'
    ];

    public function product_variants()
    {
        return $this->hashMany(ProductVariant::class, 'id', 'color_id');
    }
}
