<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $table = 'shipping_methods';

    protected $fillable = [
        'name',
        'cost',
        'is_active'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id', 'shipping_method_id');
    }
}
