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

  public function deleteVariant($id)
  {
    DB::beginTransaction();
    try {
      $this->productVariantRepository->delete($id);
      DB::commit();

      return true;
    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

  public function getVariantById($id)
  {
    return $this->productVariantRepository->getModel()->findOrFail($id);
  }

  public function getAllVariants(array $filters = [])
  {
    return $this->productVariantRepository->getModel()->get();
  }
}

