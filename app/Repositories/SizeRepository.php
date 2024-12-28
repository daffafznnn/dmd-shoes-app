<?php

namespace App\Repositories;

use App\Models\ProductSize;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SizeRepository extends BaseRepository
{

    protected $rules = [
        'size_number' => 'required|string|max:255',
        'size_chart' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:product_sizes,slug',
        'status' => 'required|boolean',
    ];

    public function __construct(ProductSize $productSize)
    {
        parent::__construct($productSize);
    }

    /**
     * Create a new size.
     */
    public function create(array $data)
    {
        $this->validate($data);

        return parent::create($data);
    }

    /**
     * Update an existing size.
     */
    public function update($id, array $data)
    {
        $this->validate($data, $id);

        return parent::update($id, $data);
    }

    /**
     * Validate size data.
     */
    protected function validate(array $data, $id = null)
    {
        $rules = $this->rules;

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}

