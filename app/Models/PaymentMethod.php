<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id', 'payment_method_id');
    }
}
