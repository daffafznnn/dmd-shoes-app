<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantImage extends Model
{
    protected $table = 'product_variant_images';

    protected $fillable = [
        'product_variant_id',
        'image',
    ];

    public function product_variants()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }
}
