<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';


    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class, 'id', 'product_id');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'id', 'product_id');
    }
}
