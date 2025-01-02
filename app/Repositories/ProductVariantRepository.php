<?php

namespace App\Repositories;

use App\Models\ProductVariant;
use App\Models\ProductStock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductVariantRepository extends BaseRepository
{
  protected $rules = [
    'product_id' => 'required|integer|exists:products,id',
    'color_id' => 'nullable|integer|exists:product_colors,id',
    'size_id' => 'nullable|integer|exists:product_sizes,id',
    'material_id' => 'nullable|integer|exists:product_materials,id',
    'price' => 'required|numeric|min:0',
    'stock' => 'required|integer|min:0',
    'images' => 'nullable|array',
    'images.*' => 'nullable|image|max:2048',
  ];

  public function __construct(ProductVariant $productVariant)
  {
    parent::__construct($productVariant);
  }

  public function createVariantsForProduct(array $variations, $productId)
  {
    foreach ($variations as $variationData) {
      $variationData['product_id'] = $productId;
      $variant = $this->create($variationData);
      $this->manageRelatedEntities($variant, $variationData);
    }
  }

  public function updateVariantsForProduct(array $variations, $productId)
  {
    foreach ($variations as $variationData) {
      if (isset($variationData['id'])) {
        $this->update($variationData['id'], $variationData);
      } else {
        $variationData['product_id'] = $productId;
        $this->create($variationData);
      }
    }
  }

  protected function manageRelatedEntities(ProductVariant $variant, array $data)
  {
    // Manage stock
    if (isset($data['stock'])) {
      ProductStock::updateOrCreate(
        ['product_variant_id' => $variant->id],
        ['quantity' => $data['stock']]
      );
    }

    // Handle images
    if (isset($data['images']) && is_array($data['images'])) {
      $variant->product_variant_images()->delete();
      foreach ($data['images'] as $image) {
        $variant->product_variant_images()->create([
          'path' => $image->store('public/product_variant_images'),
        ]);
      }
    }
  }
}
