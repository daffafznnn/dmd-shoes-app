<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\ColorService;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    /**
     * Display a listing of the colors.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $colors = $this->colorService->search(
            $request->only(['search', 'status']),
            $request->get('perPage', 10)
        );
        $isLoading = $colors == null ? true : false;
        return view('admin.color-products.index', compact('colors', 'isLoading'));
    }

    /**
     * Show the form for creating a new color.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.color-products.partials.create');
    }

    /**
     * Store a newly created color in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $result = $this->colorService->create($request->all());

        if ($result === false) {
            // Jika gagal, ambil pesan dari service dan arahkan kembali dengan pesan error
            return redirect()->route('master.colors.index')->with('error', $this->colorService->getMessage());
        }

        // Jika berhasil, ambil pesan dari service dan arahkan kembali dengan pesan sukses
        return redirect()->route('master.colors.index')->with('success', $this->colorService->getMessage());
    }

    /**
     * Show the form for editing an existing color.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $color = $this->colorService->getById($id);
        return view('admin.color-products.partials.edit', compact('color'));
    }

    /**
     * Update the specified color in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->colorService->update($id, $request->all());
        return redirect()->route('master.colors.index')->with('success', 'Warna berhasil diupdate.');
    }

    /**
     * Remove the specified color from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->colorService->delete($id);
        return redirect()->route('master.colors.index')->with('success', 'Warna berhasil dihapus.');
    }
}

