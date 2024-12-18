<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table = 'product_sizes';

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class, 'id', 'size_id');
    }
}
