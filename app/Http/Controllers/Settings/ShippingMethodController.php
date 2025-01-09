<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $isLoading = true;
        $search = $request->query('search', '');
        $isActive = $request->query('is_active');

        $shippings = ShippingMethod::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })
            ->when(!is_null($isActive), function ($query) use ($isActive) {
                return $query->where('is_active', $isActive == '1');
            })
            ->paginate(5);

        $isLoading = false;

        return view('admin.settings.shipping.index', compact('shippings', 'search', 'isActive', 'isLoading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.shipping.partials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cost' => ['required', 'integer'],
            'is_active' => ['required', 'boolean'],
        ]);

        try {
            ShippingMethod::create([
                'name' => $request->input('name'),
                'cost' => $request->input('cost'),
                'is_active' => $request->input('is_active'),
            ]);

            return redirect()->route('admin.shipping-methods.index')->with('success', 'Metode pengiriman berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat metode pengiriman');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shipment = ShippingMethod::findOrFail($id);

        return view('admin.settings.shipping.partials.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cost' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'is_active' => ['required', 'boolean'],
        ]);

        $shipment = ShippingMethod::findOrFail($id);

        try {
            $shipment->update([
                'name' => $request->input('name'),
                'cost' => $request->input('cost'),
                'is_active' => $request->input('is_active'),
            ]);

            return redirect()->route('admin.shipping-methods.index')->with('success', 'Metode pengiriman berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui metode pengiriman');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ShippingMethod::findOrFail($id)->delete();

            return redirect()->route('admin.shipping-methods.index')->with('success', 'Metode pengiriman berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus metode pengiriman');
        }
    }
}
