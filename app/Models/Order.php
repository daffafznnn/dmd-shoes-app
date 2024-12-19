<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'code_order',
        'customer_name',
        'customer_contact',
        'shipping_address',
        'note',
        'status',
        'payment_method_id',
        'payment_proof',
        'shipping_method_id',
        'tracking_number',
        'total',
    ];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'id', 'order_id');
    }

    public function payment_methods()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function shipping_methods()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id', 'id');
    }
}
