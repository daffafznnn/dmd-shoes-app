<?php

namespace App\Http\Controllers\Settings;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $isLoading = true;
        $search = $request->query('search', '');
        $isActive = $request->query('is_active');

        $payments = PaymentMethod::when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->when(!is_null($isActive), function ($query) use ($isActive) {
                return $query->where('is_active', $isActive == '1');
            })
            ->paginate(5);

            $isLoading = false;

        return view('admin.settings.payments.index', compact('payments', 'search', 'isActive', 'isLoading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.payments.partials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);

        try {
            PaymentMethod::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'is_active' => $request->input('is_active'),
            ]);

            return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat metode pembayaran');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        return view('admin.settings.payments.partials.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);

        try {
            $paymentMethod = PaymentMethod::findOrFail($id);

            $paymentMethod->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'is_active' => $request->input('is_active'),
            ]);

            return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui metode pembayaran');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            PaymentMethod::findOrFail($id)->delete();

            return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus metode pembayaran');
        }
    }
}

