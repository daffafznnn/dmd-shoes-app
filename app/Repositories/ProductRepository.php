<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\ProductVariantRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductRepository extends BaseRepository
{
    protected $rules = [
        'category_id' => 'required|integer|exists:categories,id',
        'unit_id' => 'required|integer|exists:units,id',
        'model_number' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug',
        'description' => 'nullable|string',
        'cover' => 'nullable|string',
        'type' => 'required|string',
    ];

    protected $productVariantRepository;

    public function __construct(Product $product, ProductVariantRepository $productVariantRepository)
    {
        parent::__construct($product);
        $this->productVariantRepository = $productVariantRepository;
    }

    protected function validate(array $data, $id = null)
    {
        $rules = $this->rules;

        if ($id) {
            $rules['slug'] = 'required|string|max:255|unique:products,slug,' . $id;
        }

        return Validator::make($data, $rules);
    }

    public function create(array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $product = parent::create($data);

        // Handle product images
        if (isset($data['images'])) {
            $this->createImages($data['images'], $product->id);
        }

        // Handle product variations
        if (isset($data['variations'])) {
            $this->productVariantRepository->createVariantsForProduct($data['variations'], $product->id);
        }

        return $product;
    }

    public function update($id, array $data)
    {
        $validator = $this->validate($data, $id);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $product = parent::update($id, $data);

        // Handle product images
        if (isset($data['images'])) {
            $this->updateImages($data['images'], $product->id);
        }

        // Handle product variations
        if (isset($data['variations'])) {
            $this->productVariantRepository->updateVariantsForProduct($data['variations'], $product->id);
        }

        return $product;
    }

    public function createImages(array $images, $productId)
    {
        foreach ($images as $image) {
            $path = $image->store('public/products');
            ProductImage::create([
                'product_id' => $productId,
                'image_path' => $path,
                'is_main' => isset($image['is_main']) ? $image['is_main'] : false,
                'sort_order' => $image['sort_order'] ?? 0,
            ]);
        }
    }

    public function updateImages(array $images, $productId)
    {
        // Delete old images
        ProductImage::where('product_id', $productId)->delete();

        // Create new images
        $this->createImages($images, $productId);
    }
}
