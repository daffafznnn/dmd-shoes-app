<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService extends BaseService
{
  public function __construct(CategoryRepository $categoryRepository)
  {
    parent::__construct($categoryRepository);
  }
}
