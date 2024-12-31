<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Services\ProductVariantService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductService extends BaseService
{
    protected $productRepository;
    protected $productVariantService;

    public function __construct(
        ProductRepository $productRepository,
        ProductVariantService $productVariantService
    ) {
        parent::__construct($productRepository);
        $this->productRepository = $productRepository;
        $this->productVariantService = $productVariantService;
    }

    /**
     * Create a new product with variations.
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            // Create the product
            $product = $this->productRepository->create($data);

            // Generate the slug from product name
            $slug = Str::slug($product->name);

            // Update the slug
            $this->productRepository->update($product->id, ['slug' => $slug]);

            // Handle product variants
            if (isset($data['variants']) && is_array($data['variants'])) {
                foreach ($data['variants'] as $variantData) {
                    $variantData['product_id'] = $product->id;
                    $this->productVariantService->createVariant($variantData);
                }
            }

            DB::commit();

            // Success message
            Session::flash('success', 'Produk berhasil ditambahkan.');
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();

            // Error message
            Session::flash('error', 'Terjadi kesalahan saat menambahkan produk: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update an existing product with variations.
     */
    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            // Update the product
            $product = $this->productRepository->update($id, $data);

            // Generate the slug from product name
            $slug = Str::slug($product->name);

            // Update the slug
            $this->productRepository->update($product->id, ['slug' => $slug]);

            // Handle product variants
            if (isset($data['variants']) && is_array($data['variants'])) {
                foreach ($data['variants'] as $variantData) {
                    if (isset($variantData['id'])) {
                        $this->productVariantService->updateVariant($variantData['id'], $variantData);
                    } else {
                        $variantData['product_id'] = $product->id;
                        $this->productVariantService->createVariant($variantData);
                    }
                }
            }

            DB::commit();

            // Success message
            Session::flash('success', 'Produk berhasil diperbarui.');
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();

            // Error message
            Session::flash('error', 'Terjadi kesalahan saat memperbarui produk: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get a list of products with optional filtering and pagination.
     */
    public function search(array $filters = [], $perPage = 10)
    {
        return $this->productRepository->getModel()
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

    /**
     * Get product details with its variants, stocks, and images.
     */
    public function getProductDetails($productId)
    {
        try {
            $product = $this->productRepository->getModel()->find($productId);

            if (!$product) {
                throw new \Exception("Produk tidak ditemukan.");
            }

            $variants = $this->productRepository->getModel()
                ->with(['variants.material', 'variants.size', 'variants.color', 'variants.images'])
                ->find($productId)
                ->variants;

            return compact('product', 'variants');
        } catch (\Exception $e) {
            Session::flash('error', 'Produk tidak ditemukan.');
            throw $e;
        }
    }
}
