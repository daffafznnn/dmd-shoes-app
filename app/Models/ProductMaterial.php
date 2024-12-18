<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMaterial extends Model
{
    protected $table = 'product_materials';

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class, 'id', 'material_id');
    }
}
