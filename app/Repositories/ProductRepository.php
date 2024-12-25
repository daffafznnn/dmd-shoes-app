<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductRepository extends BaseRepository
{
    protected $rules = [
        'category_id' => 'required|integer|exists:categories,id',
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

    /**
     * Create a new product.
     */
    public function create(array $data)
    {
        $this->validate($data);

        return parent::create($data);
    }

    /**
     * Update an existing product.
     */
    public function update($id, array $data)
    {
        $this->validate($data, $id);

        return parent::update($id, $data);
    }

    /**
     * Validate product data.
     */
    protected function validate(array $data, $id = null)
    {
        $rules = $this->rules;

        // Modify slug rule for updates
        if ($id) {
            $rules['slug'] = 'required|string|max:255|unique:products,slug,' . $id;
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
