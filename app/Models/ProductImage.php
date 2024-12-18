<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
