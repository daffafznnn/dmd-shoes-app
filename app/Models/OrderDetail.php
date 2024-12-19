<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'sub_total',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
