<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

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

    protected $dates = ['deleted_at']; // Kolom soft delete

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function payment_methods()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function shipping_methods()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id', 'id');
    }

    /**
     * Scope to retrieve only active orders (not soft deleted).
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    /**
     * Scope to retrieve only archived orders (soft deleted).
     */
    public function scopeArchived($query)
    {
        return $query->whereNotNull('deleted_at');
    }
}
