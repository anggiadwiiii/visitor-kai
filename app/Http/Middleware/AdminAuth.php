<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Check if user has admin role only
        $user = Auth::user();
        if ($user->role !== 'Admin') {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Anda tidak memiliki akses. Hanya Admin yang dapat mengakses dashboard ini.');
        }

        // Check if user status is active
        if ($user->status !== 'Aktif') {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Akun Anda telah dinonaktifkan.');
        }

        return $next($request);
    }
}
