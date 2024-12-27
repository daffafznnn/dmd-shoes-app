<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
    }

    /**
     * Override create to include additional logic if necessary.
     */
    public function create(array $data)
    {
        // Additional logic before creation (if needed)
        return parent::create($data);
    }

    /**
     * Override update to include additional logic if necessary.
     */
    public function update($id, array $data)
    {
        // Additional logic before update (if needed)
        return parent::update($id, $data);
    }

    /**
     * Get a list of products with optional filtering and pagination.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(array $filters = [], $perPage = 10)
    {
        return $this->repository->getModel()
            ->when(isset($filters['search']), function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('model_number', 'like', '%' . $filters['search'] . '%');
            })
            ->when(isset($filters['category']), function ($query) use ($filters) {
                $query->where('category_id', $filters['category']);
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->paginate($perPage);
    }

}
