<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\MaterialService;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    protected $materialService;

    public function __construct(MaterialService $materialService)
    {
        $this->materialService = $materialService;
    }

    /**
     * Display a listing of the materials.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $materials = $this->materialService->search(
            $request->only(['search', 'status']),
            $request->get('perPage', 10)
        );
        $isLoading = $materials == null ? true : false;
        return view('admin.materials-products.index', compact('materials', 'isLoading'));
    }

    /**
     * Show the form for creating a new material.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.materials-products.partials.create');
    }

    /**
     * Store a newly created material in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $result = $this->materialService->create($request->all());

        if ($result === false) {
            // Jika gagal, ambil pesan dari service dan arahkan kembali dengan pesan error
            return redirect()->route('master.materials.index')->with('error', $this->materialService->getMessage());
        }

        // Jika berhasil, ambil pesan dari service dan arahkan kembali dengan pesan sukses
        return redirect()->route('master.materials.index')->with('success', $this->materialService->getMessage());
    }

    /**
     * Show the form for editing an existing material.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $material = $this->materialService->getById($id);
        return view('admin.materials-products.partials.edit', compact('material'));
    }

    /**
     * Update the specified material in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->materialService->update($id, $request->all());
        return redirect()->route('master.materials.index')->with('success', 'Material berhasil diupdate.');
    }

    /**
     * Remove the specified material from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->materialService->delete($id);
        return redirect()->route('master.materials.index')->with('success', 'Material berhasil dihapus.');
    }
}

