<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\SizeService;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    protected $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }

    /**
     * Display a listing of the sizes.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sizes = $this->sizeService->search(
            $request->only(['search', 'status']),
            $request->get('perPage', 10)
        );
        $isLoading = $sizes == null ? true : false;
        return view('admin.size-products.index', compact('sizes', 'isLoading'));
    }

    /**
     * Show the form for creating a new size.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.size-products.partials.create');
    }

    /**
     * Store a newly created size in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $result = $this->sizeService->create($request->all());

        if ($result === false) {
            // Jika gagal, ambil pesan dari service dan arahkan kembali dengan pesan error
            return redirect()->route('master.sizes.index')->with('error', $this->sizeService->getMessage());
        }

        // Jika berhasil, ambil pesan dari service dan arahkan kembali dengan pesan sukses
        return redirect()->route('master.sizes.index')->with('success', $this->sizeService->getMessage());
    }

    /**
     * Show the form for editing an existing size.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $size = $this->sizeService->getById($id);
        return view('admin.size-products.partials.edit', compact('size'));
    }

    /**
     * Update the specified size in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->sizeService->update($id, $request->all());
        return redirect()->route('master.sizes.index')->with('success', 'Ukuran berhasil diupdate.');
    }

    /**
     * Remove the specified size from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->sizeService->delete($id);
        return redirect()->route('master.sizes.index')->with('success', 'Ukuran berhasil dihapus.');
    }
}


