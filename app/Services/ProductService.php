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

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            // Create the product
            $product = $this->productRepository->create($data);

            // Generate and update the slug
            $slug = Str::slug($product->name);
            $this->productRepository->update($product->id, ['slug' => $slug]);

            // Handle product images
            if (isset($data['images'])) {
                $this->productRepository->createImages($data['images'], $product->id); // Perbaikan di sini
            }

            // Handle product variants
            if (isset($data['variations'])) {
                $this->productVariantService->createVariantsForProduct($data['variations'], $product->id);
            }

            DB::commit();
            Session::flash('success', 'Produk berhasil ditambahkan.');
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Terjadi kesalahan saat menambahkan produk: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->update($id, $data);

            // Generate and update the slug
            $slug = Str::slug($product->name);
            $this->productRepository->update($product->id, ['slug' => $slug]);

            // Handle product images
            if (isset($data['images'])) {
                $this->productRepository->updateImages($data['images'], $product->id); // Perbaikan di sini
            }

            // Handle product variants
            if (isset($data['variations'])) {
                $this->productVariantService->updateVariantsForProduct($data['variations'], $product->id);
            }

            DB::commit();
            Session::flash('success', 'Produk berhasil diperbarui.');
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Terjadi kesalahan saat memperbarui produk: ' . $e->getMessage());
            throw $e;
        }
    }

    // Menambahkan metode search
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

    // Menambahkan metode getProductDetails
    public function getProductDetails($productId)
    {
        try {
            $product = $this->productRepository->getModel()->find($productId);

            if (!$product) {
                throw new \Exception("Produk tidak ditemukan.");
            }

            // Mendapatkan variasi produk beserta material, ukuran, warna, dan gambar terkait
            $variants = $product->variants()
                ->with(['material', 'size', 'color', 'images'])
                ->get();

            return compact('product', 'variants');
        } catch (\Exception $e) {
            Session::flash('error', 'Produk tidak ditemukan.');
            throw $e;
        }
    }
}
