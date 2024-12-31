<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductRepository extends BaseRepository
{
    protected $rules = [
        'category_id' => 'required|integer|exists:categories,id',
        'unit_id' => 'required|integer|exists:units,id',
        'model_number' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug',
        'description' => 'nullable|string',
        'cover' => 'nullable|string',
        'type' => 'required|string',
    ];

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    protected function validate(array $data, $id = null)
    {
        $rules = $this->rules;

        if ($id) {
            $rules['slug'] = 'required|string|max:255|unique:products,slug,' . $id;
        }

        return Validator::make($data, $rules);
    }

    public function create(array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $product = parent::create($data);

        return $product;
    }

    public function update($id, array $data)
    {
        $validator = $this->validate($data, $id);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $product = parent::update($id, $data);

        return $product;
    }
   
}


