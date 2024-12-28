<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\UnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    protected $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function index(Request $request)
    {
        $units = $this->unitService->search(
            $request->only(['search', 'status', 'name', 'acronym']),
            $request->get('perPage', 10)
        );

        $isLoading = $units == null ? true : false;
        return view('admin.units-products.index', compact('units', 'isLoading'));
    }

    public function create()
    {
        return view('admin.units-products.partials.create');
    }

    public function store(Request $request)
    {
        $this->unitService->create($request->all());

        return redirect()->route('master.units.index')->with('success', 'Unit created successfully.');
    }

    public function edit($id)
    {
        $unit = $this->unitService->getById($id);

        return view('admin.units-products.partials.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $this->unitService->update($id, $request->all());

        return redirect()->route('master.units.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy($id)
    {
        $this->unitService->delete($id);

        return redirect()->route('master.units.index')->with('success', 'Unit deleted successfully.');
    }
}
