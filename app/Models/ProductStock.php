<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $table = 'product_stocks';

    protected $fillable = [
        'product_variant_id',
        'stock',
    ];

    public function product_variants()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }
}
