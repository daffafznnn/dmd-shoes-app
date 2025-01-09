<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\SocialSetting;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $isLoading = true;
        $search = $request->query('search', '');

        $socials = SocialSetting::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })
            ->paginate(5);

        $isLoading = false;

        $bootstrapIcons = [
            "bi bi-facebook",
            "bi bi-twitter",
            "bi bi-instagram",
            "bi bi-linkedin",
            "bi bi-youtube",
            "bi bi-whatsapp",
            "bi bi-telegram",
            "bi bi-pinterest",
            "bi bi-github",
            "bi bi-google",
            "bi bi-tiktok",
            "bi bi-snapchat",
            "bi bi-vimeo",
            "bi bi-reddit",
            "bi bi-twitch",
        ];

        return view('admin.settings.socials.index', compact('socials', 'search', 'isLoading', 'bootstrapIcons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return view('admin.settings.socials.partials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
        ]);

        try {
            SocialSetting::create([
                'name' => $request->input('name'),
                'icon' => $request->input('icon'),
                'url' => $request->input('url'),
            ]);

            return redirect()->route('admin.socials.index')->with('success', 'Sosial media berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat sosial media');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $social = SocialSetting::findOrFail($id);

        return view('admin.settings.socials.partials.edit', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
        ]);

        $social = SocialSetting::findOrFail($id);

        try {
            $social->update([
                'name' => $request->input('name'),
                'icon' => $request->input('icon'),
                'url' => $request->input('url'),
            ]);

            return redirect()->route('admin.socials.index')->with('success', 'Sosial media berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui sosial media');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            SocialSetting::findOrFail($id)->delete();

            return redirect()->route('admin.socials.index')->with('success', 'Sosial media berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus sosial media');
        }
    }
}

