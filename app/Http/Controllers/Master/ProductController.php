<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productService->getAll();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show a single product by ID.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = $this->productService->getById($id);

        if (!$product) {
            return redirect()->route('master.products.index')->with('error', 'Product not found');
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
        // Fetch categories and units through services
        $categories = app(\App\Services\CategoryService::class)->getAll();
        $units = app(\App\Services\UnitService::class)->getAll();

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
        // Call service to handle validation and storage logic
        $this->productService->create($request->all());

        return redirect()->route('master.products.index')->with('success', 'Product created successfully');
    }

    /**
     * Show the form for editing an existing product.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = $this->productService->getById($id);

        if (!$product) {
            return redirect()->route('master.products.index')->with('error', 'Product not found');
        }

        // Fetch categories and units through services
        $categories = app(\App\Services\CategoryService::class)->getAll();
        $units = app(\App\Services\UnitService::class)->getAll();

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
        // Call service to handle validation and update logic
        $this->productService->update($id, $request->all());

        return redirect()->route('master.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Delete a product from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Call service to handle deletion logic
        $this->productService->delete($id);

        return redirect()->route('master.products.index')->with('success', 'Product deleted successfully');
    }
}
