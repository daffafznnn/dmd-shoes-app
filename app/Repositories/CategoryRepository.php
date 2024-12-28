<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoryRepository extends BaseRepository
{

  protected $rules = [
    'name' => 'required|string|max:255',
    'slug' => 'required|string|max:255|unique:categories,slug',
    'status' => 'required|boolean|in:0,1',
  ];

  public function __construct(Category $category)
  {
    parent::__construct($category);
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

