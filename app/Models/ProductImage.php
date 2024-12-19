<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'image_path',
        'is_main',
        'sort_order',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
