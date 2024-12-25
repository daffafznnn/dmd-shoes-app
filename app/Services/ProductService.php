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
}
