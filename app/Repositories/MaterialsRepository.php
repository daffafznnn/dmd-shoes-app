<?php

namespace App\Repositories;

use App\Models\ProductMaterial;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MaterialsRepository extends BaseRepository
{
  protected $rules = [
    'name' => 'required|string|max:255',
    'slug' => 'required|string|max:255|unique:product_materials,slug',
    'status' => 'required|boolean|in:0,1',
  ];

  public function __construct(ProductMaterial $productMaterial)
  {
    parent::__construct($productMaterial);
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
    $validator = Validator::make($data, $this->rules);

    if ($validator->fails()) {
      throw new ValidationException($validator);
    }
  }
}
