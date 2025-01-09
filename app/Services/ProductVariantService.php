<?php

namespace App\Services;

use App\Repositories\ProductVariantRepository;
use Illuminate\Support\Facades\DB;

class ProductVariantService extends BaseService
{
  protected $productVariantRepository;

  public function __construct(ProductVariantRepository $productVariantRepository)
  {
    parent::__construct($productVariantRepository);
    $this->productVariantRepository = $productVariantRepository;
  }

  public function createVariantsForProduct(array $variations, $productId)
  {
    foreach ($variations as $variationData) {
      $variationData['product_id'] = $productId;
      $this->createVariant($variationData);
    }
  }

  public function updateVariantsForProduct(array $variations, $productId)
  {
    foreach ($variations as $variationData) {
      if (isset($variationData['id'])) {
        $this->updateVariant($variationData['id'], $variationData);
      } else {
        $variationData['product_id'] = $productId;
        $this->createVariant($variationData);
      }
    }
  }

  public function createVariant(array $data)
  {
    DB::beginTransaction();
    try {
      $variant = $this->productVariantRepository->create($data);
      DB::commit();
      return $variant;
    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

  public function updateVariant($id, array $data)
  {
    DB::beginTransaction();
    try {
      $variant = $this->productVariantRepository->update($id, $data);
      DB::commit();
      return $variant;
    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }
}
