<?php

namespace App\Repositories;

use App\Models\Category;

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
  
}
