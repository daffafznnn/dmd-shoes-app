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

    public function index()
    {
        $units = $this->unitService->getAll();

        return view('admin.unit.index', compact('units'));
    }

    public function create()
    {
        return view('admin.unit.create');
    }

    public function store(Request $request)
    {
        $this->unitService->create($request->all());

        return redirect()->route('units.index')->with('success', 'Unit created successfully.');
    }

    public function edit($id)
    {
        $unit = $this->unitService->getById($id);

        return view('admin.unit.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $this->unitService->update($id, $request->all());

        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy($id)
    {
        $this->unitService->delete($id);

        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }
}
