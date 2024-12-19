<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variants';

    protected $fillable = [
        'product_id', 
        'color_id', 
        'size_id', 
        'material_id',
        'price',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function product_colors()
    {
        return $this->belongsTo(ProductColor::class, 'color_id', 'id');
    }

    public function product_sizes()
    {
        return $this->belongsTo(ProductSize::class, 'size_id', 'id');
    }

    public function product_materials()
    {
        return $this->belongsTo(ProductMaterial::class, 'material_id', 'id');
    }

    public function product_stocks()
    {
        return $this->hasMany(ProductStock::class, 'id', 'product_variant_id');
    }

    public function product_variant_images()
    {
        return $this->hasMany(ProductVariantImage::class, 'id', 'product_variant_id');
    }
}
