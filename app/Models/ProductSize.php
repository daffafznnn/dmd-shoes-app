<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table = 'product_sizes';

    protected $fillable = [
        'size_number',
        'size_chart',
        'slug',
        'status',
    ];

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class, 'id', 'size_id');
    }
}
