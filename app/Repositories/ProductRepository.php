<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository {

    protected $product;

    public function __construct(Product $product) 
    {
        $this->product = $product;
    }

    public function getAll() 
    {
        return $this->product->get();
    }

    public function getById($id) 
    {
        return $this->product->find($id);
    }

    public function create($data)
    {
        $product = $this->product;

        $product->category_id = $data['category_id'];
        $product->model_number = $data['model_number'];
        $product->name = $data['name'];
        $product->slug = $data['slug'];
        $product->description = $data['description'];
        $product->cover = $data['cover'];
        $product->type = $data['type'];
    }
}