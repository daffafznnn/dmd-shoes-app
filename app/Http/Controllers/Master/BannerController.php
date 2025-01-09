<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $isLoading = true; // Indikator loading

            $banners = Banner::query()
                ->when($request->status, fn($query, $status) => $query->where('status', $status))
                ->when($request->search, fn($query, $search) => $query->where('name', 'LIKE', "%{$search}%"))
                ->when($request->start_date, fn($query, $start_date) => $query->where('start_date', '>=', $start_date))
                ->when($request->end_date, fn($query, $end_date) => $query->where('end_date', '<=', $end_date))
                ->orderBy('created_at', 'asc')
                ->paginate(10);

            $isLoading = false; // Selesai loading

            return view('admin.banners.index', compact('banners', 'isLoading'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data banner.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.banners.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuka halaman tambah banner.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'alt_text' => 'nullable|string|max:255',
                'target_url' => 'nullable|url',
                'status' => 'required|boolean',
                'start_date' => 'nullable|date|date_format:Y-m-d',
                'end_date' => 'nullable|date|date_format:Y-m-d|after_or_equal:start_date',
            ]);

            // Generate slug dari nama
            $validated['slug'] = Str::slug($validated['name']);

            // Generate meta secara otomatis jika kosong
            $validated['meta_title'] = $request->meta_title ?: $validated['name'];
            $validated['meta_description'] = $request->meta_description ?: "Banner untuk {$validated['name']}";
            $validated['meta_keywords'] = $request->meta_keywords ?: implode(', ', explode(' ', $validated['name']));

            // Alt text default
            $validated['alt_text'] = $request->alt_text ?: 'Banner untuk ' . $validated['name'];
            // Simpan gambar
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('banners', 'public');
            }

            Banner::create($validated);

            return redirect()->route('master.banners.index')->with('success', 'Banner berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data banner.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $banner = Banner::where('slug', $slug)->firstOrFail();

            return view('admin.banners.detail', compact('banner'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuka halaman edit banner.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        try {
            $banner = Banner::where('slug', $slug)->firstOrFail();

            return view('admin.banners.edit', compact('banner'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuka halaman edit banner.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $banner = Banner::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'alt_text' => 'nullable|string|max:255',
                'target_url' => 'nullable|url',
                'status' => 'required|boolean',
                'start_date' => 'nullable|date_format:Y-m-d',
                'end_date' => 'nullable|date_format:Y-m-d|after_or_equal:start_date',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:255',
                'meta_keywords' => 'nullable|string|max:255',
            ]);

            // Generate slug dari nama
            $validated['slug'] = Str::slug($validated['name']);

            // Generate meta secara otomatis jika kosong
            $validated['meta_title'] = $request->meta_title ?: $validated['name'];
            $validated['meta_description'] = $request->meta_description ?: "Banner untuk {$validated['name']}";
            $validated['meta_keywords'] = $request->meta_keywords ?: implode(', ', explode(' ', $validated['name']));

            // Alt text default
            $validated['alt_text'] = $request->alt_text ?: 'Banner untuk ' . $validated['name'];

            // Update gambar jika ada
            if ($request->hasFile('image')) {
                // Hapus gambar lama
                if ($banner->image) {
                    Storage::disk('public')->delete($banner->image);
                }

                $validated['image'] = $request->file('image')->store('banners', 'public');
            }

            // Update data
            $banner->update($validated);

            return redirect()->route('master.banners.index')->with('success', 'Banner berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data banner.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $banner = Banner::findOrFail($id);
            // Validasi jika status masih aktif tidak dapat dihapus
            if ($banner->status) {
                return redirect()->back()->with('error', 'Banner yang masih aktif tidak dapat dihapus.');
            }

            // Hapus gambar dari penyimpanan
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $banner->delete();

            return redirect()->route('master.banners.index')->with('success', 'Banner berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data banner.');
        }
    }
}

