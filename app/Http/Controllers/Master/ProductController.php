<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\UnitService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $unitService;

    public function __construct(ProductService $productService, CategoryService $categoryService, UnitService $unitService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->unitService = $unitService;
    }

    /**
     * Display a listing of products with filters and pagination.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $products = $this->productService->search(
            $request->only(['search', 'category', 'status']),
            $request->get('perPage', 10)
        );

        $categories = $this->categoryService->getAll();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show a single product by ID.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $product = $this->productService->getById($id);

        if (!$product) {
            return redirect()->route('master.products.index')->with('error', 'Produk tidak ditemukan.');
        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        $units = $this->unitService->getAll();

        return view('admin.products.create', compact('categories', 'units'));
    }

    /**
     * Store a newly created product in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
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
        ]);

        $this->productService->create($validated);

        return redirect()->route('master.products.index')->with('success', 'Produk berhasil dibuat.');
    }

    /**
     * Show the form for editing an existing product.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $product = $this->productService->getById($id);

        if (!$product) {
            return redirect()->route('master.products.index')->with('error', 'Produk tidak ditemukan.');
        }

        $categories = $this->categoryService->getAll();
        $units = $this->unitService->getAll();

        return view('admin.products.edit', compact('product', 'categories', 'units'));
    }

    /**
     * Update an existing product in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
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
        ]);

        $this->productService->update($id, $validated);

        return redirect()->route('master.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Delete a product from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->productService->delete($id);

        return redirect()->route('master.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
