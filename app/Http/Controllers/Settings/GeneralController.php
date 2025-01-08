<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GeneralController extends Controller
{
    /**
     * Show the form for editing the general settings.
     */
    public function edit()
    {
        try {
            // Mengambil data setting aplikasi pertama
            $setting = Setting::select([
                'name', 'alias', 'logo', 'favicon', 'description', 'email', 'phone', 'address', 'latitude', 'longitude', 'is_maintenance'
            ])->first();

            return view('admin.settings.general', compact('setting'));
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi masalah saat mengambil data
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat pengaturan.');
        }
    }

    /**
     * Update the general settings.
     */
    public function update(Request $request)
    {
        try {
            // Validasi input dari form
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'alias' => 'required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string|max:500',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:15',
                'address' => 'nullable|string|max:500',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'is_maintenance' => 'nullable|boolean',
                'app_key' => 'required|string|max:255',
            ]);

            // Periksa apakah `app_key` cocok dengan APP_KEY di environment
            if ($validated['app_key'] !== config('app.key')) {
                return redirect()->back()->with('error', 'App Key tidak valid. Perubahan setiap data memerlukan App Key yang sesuai.');
            }

            // Mengambil pengaturan pertama
            $setting = Setting::first();
            if (!$setting) {
                return redirect()->back()->with('error', 'Pengaturan tidak ditemukan.');
            }

            // Menyimpan logo jika ada
            if ($request->hasFile('logo')) {
                // Menghapus logo lama jika ada
                if ($setting->logo) {
                    Storage::disk('public')->delete($setting->logo);
                }
                // Menyimpan logo baru dan mengambil path
                $validated['logo'] = $request->file('logo')->store('logos', 'public');
            }

            // Menyimpan favicon jika ada
            if ($request->hasFile('favicon')) {
                // Menghapus favicon lama jika ada
                if ($setting->favicon) {
                    Storage::disk('public')->delete($setting->favicon);
                }
                // Menyimpan favicon baru dan mengambil path
                $validated['favicon'] = $request->file('favicon')->store('favicons', 'public');
            }

            // Memperbarui pengaturan aplikasi
            $setting->update($validated);

            return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan berhasil diperbarui.');
        } catch (\Exception $e) {
            // Menangani kesalahan saat memperbarui pengaturan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui pengaturan.');
        }
    }

}
