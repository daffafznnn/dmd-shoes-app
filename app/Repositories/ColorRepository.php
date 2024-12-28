<?php

namespace App\Repositories;

use App\Models\ProductColor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ColorRepository extends BaseRepository
{
    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:product_colors,slug',
        'status' => 'required|boolean',
    ];

    public function __construct(ProductColor $productColor)
    {
        parent::__construct($productColor);
    }

    public function create(array $data)
    {
        $this->validate($data);

        return parent::create($data);
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);

        return parent::update($id, $data);
    }

    protected function validate(array $data, $id = null)
    {
        $rules = $this->rules;

        if ($id) {
            $rules['slug'] = 'required|string|max:255|unique:product_colors,slug,' . $id;
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}

