<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\UnitService;
use App\Services\MaterialService;
use App\Services\ColorService;
use App\Services\SizeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $unitService;
    protected $materialService;
    protected $colorService;
    protected $sizeService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        UnitService $unitService,
        MaterialService $materialService,
        ColorService $colorService,
        SizeService $sizeService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->unitService = $unitService;
        $this->materialService = $materialService;
        $this->colorService = $colorService;
        $this->sizeService = $sizeService;
    }

    public function index(Request $request)
    {
        try {
            $filters = $request->only(['search', 'category', 'status']);
            $perPage = $request->get('perPage', 10);
            $products = $this->productService->search($filters, $perPage);
            $categories = $this->categoryService->getAll();

            return view('admin.products.index', compact('products', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat daftar produk: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $productDetails = $this->productService->getProductDetails($id);

            return view('admin.products.show', $productDetails);
        } catch (\Exception $e) {
            return redirect()->route('master.products.index')->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $categories = $this->categoryService->getAll();
            $units = $this->unitService->getAll();
            $materials = $this->materialService->getAll();
            $sizes = $this->sizeService->getAll();
            $colors = $this->colorService->getAll();

            return view('admin.products.create', compact('categories', 'units', 'materials', 'sizes', 'colors'));
        } catch (\Exception $e) {
            return redirect()->route('master.products.index')->with('error', 'Gagal memuat data untuk form pembuatan: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'variations' => 'nullable|array',
            'variations.*.material' => 'required|string|max:255',
            'variations.*.size' => 'required|string|max:50',
            'variations.*.color' => 'required|string|max:50',
            'variations.*.images' => 'nullable|array',
            'variations.*.images.*' => 'nullable|image|max:2048', // Validasi gambar variasi
        ]);

        // Handle file uploads for variation images
        $validated['variations'] = collect($validated['variations'] ?? [])->map(function ($variation) use ($request) {
            if (isset($variation['images']) && is_array($variation['images'])) {
                $uploadedImages = [];
                foreach ($variation['images'] as $index => $image) {
                    $uploadedImages[] = $image->store('public/product_images'); // Simpan ke folder "product_images"
                }
                $variation['images'] = $uploadedImages; // Update path gambar
            }
            return $variation;
        })->toArray();

        try {
            $this->productService->create($validated);
            return redirect()->route('master.products.index')->with('success', 'Produk berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan produk: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $productDetails = $this->productService->getProductDetails($id);
            $categories = $this->categoryService->getAll();
            $units = $this->unitService->getAll();
            $materials = $this->materialService->getAll();
            $sizes = $this->sizeService->getAll();
            $colors = $this->colorService->getAll();

            return view('admin.products.edit', array_merge($productDetails, compact('categories', 'units', 'materials', 'sizes', 'colors')));
        } catch (\Exception $e) {
            return redirect()->route('master.products.index')->with('error', 'Gagal memuat data produk: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing product in the database.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'variations' => 'nullable|array',
            'variations.*.material' => 'required|string|max:255',
            'variations.*.size' => 'required|string|max:50',
            'variations.*.color' => 'required|string|max:50',
            'variations.*.images' => 'nullable|array',
            'variations.*.images.*' => 'nullable|image|max:2048', // Validasi gambar variasi
        ]);

        // Handle file uploads for variation images
        $validated['variations'] = collect($validated['variations'] ?? [])->map(function ($variation) use ($request) {
            if (isset($variation['images']) && is_array($variation['images'])) {
                $uploadedImages = [];
                foreach ($variation['images'] as $index => $image) {
                    $uploadedImages[] = $image->store('public/product_images'); // Simpan ke folder "product_images"
                }
                $variation['images'] = $uploadedImages; // Update path gambar
            }
            return $variation;
        })->toArray();

        try {
            $this->productService->update($id, $validated);
            return redirect()->route('master.products.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui produk: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->delete($id);

            return redirect()->route('master.products.index')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('master.products.index')->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}


