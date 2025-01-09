<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'model_number',
        'name',
        'slug',
        'description',
        'cover',
        'type',
        'status',
        'default_price',
        'default_stock',
        'is_featured',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'unit_id'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class,  'product_id', 'id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'id', 'product_id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter(Builder $query)
    {
        $query->where('name', 'like', '%'.request('search').'%');
    }
}
