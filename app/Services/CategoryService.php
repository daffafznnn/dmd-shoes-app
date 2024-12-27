<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService extends BaseService
{
  public function __construct(CategoryRepository $categoryRepository)
  {
    parent::__construct($categoryRepository);
  }

  public function search(array $filters = [], $perPage = 10)
  {
    return $this->repository->getModel()
      ->when(isset($filters['search']), function ($query) use ($filters) {
        $query->where('name', 'like', '%' . $filters['search'] . '%');
      })
      ->when(isset($filters['status']), function ($query) use ($filters) {
        $query->where('status', $filters['status']);
      })
      ->paginate($perPage);
  }

}
