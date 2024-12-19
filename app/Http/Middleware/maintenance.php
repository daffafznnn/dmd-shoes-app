<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class maintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setting = Setting::first();

        if ($setting && $setting['is_maintenance'] == 1) {

            if (Auth::user()->role == 'admin') {
                return $next($request);                
            }

            Auth::logout();
            // return redirect()->route('maintenance');
        }
        return $next($request);
    }
}
