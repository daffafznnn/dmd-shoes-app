<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categories = $this->categoryService->search(
            $request->only(['search', 'category', 'status']),
            $request->get('perPage', 10)
        );
        $isLoading = $categories == null ? true : false;
        return view('admin.category.index', compact('categories', 'isLoading'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.category.partials.create');
    }

    /**
     * Store a newly created category in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $result = $this->categoryService->create($request->all());

        if ($result === false) {
            // Jika gagal, ambil pesan dari service dan arahkan kembali dengan pesan error
            return redirect()->route('master.categories.index')->with('error', $this->categoryService->getMessage());
        }

        // Jika berhasil, ambil pesan dari service dan arahkan kembali dengan pesan sukses
        return redirect()->route('master.categories.index')->with('success', $this->categoryService->getMessage());
    }

    /**
     * Show the form for editing an existing category.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->categoryService->getById($id);
        return view('admin.category.partials.edit', compact('category'));
    }

    /**
     * Update the specified category in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->categoryService->update($id, $request->all());
        return redirect()->route('master.categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    /**
     * Remove the specified category from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('master.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
