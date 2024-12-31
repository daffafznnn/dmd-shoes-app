<?php

namespace App\Repositories;

use App\Models\ProductVariant;
use App\Models\ProductStock;
use App\Models\ProductVariantImage;
use App\Models\ProductMaterial;
use App\Models\ProductSize;
use App\Models\ProductColor;
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

  public function create(array $data)
  {
    $this->validate($data);

    $variant = parent::create($data);

    // Create or associate related entities
    $this->manageRelatedEntities($variant, $data);

    return $variant;
  }

  public function update($id, array $data)
  {
    $this->validate($data, $id);

    $variant = parent::update($id, $data);

    // Update or associate related entities
    $this->manageRelatedEntities($variant, $data);

    return $variant;
  }

  protected function validate(array $data, $id = null)
  {
    $rules = $this->rules;
    if ($id) {
      // Add unique rules or other customizations for update
    }

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
      throw new ValidationException($validator);
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

    // Associate material
    if (isset($data['material_id'])) {
      $variant->material_id = $data['material_id'];
      $variant->save();
    }

    // Associate size
    if (isset($data['size_id'])) {
      $variant->size_id = $data['size_id'];
      $variant->save();
    }

    // Associate color
    if (isset($data['color_id'])) {
      $variant->color_id = $data['color_id'];
      $variant->save();
    }

    // Manage images
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

