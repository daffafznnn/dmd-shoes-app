<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Mengautentikasi pengguna
        $request->authenticate();

        // Cek role user
        $user = User::where('id', Auth::user()->id)->first();
        if ($user->hasRole('superadmin') || $user->hasRole('admin')) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Mengarahkan ke halaman dashboard admin
            return redirect()->intended('/admin/dashboard');
        }

        // Mengarahkan kembali ke halaman utama
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout pengguna
        Auth::guard('web')->logout();

        // Hapus session dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan kembali ke halaman utama
        return redirect('/');
    }
}

