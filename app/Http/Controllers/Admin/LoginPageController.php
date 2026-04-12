<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginPageController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Find user by username
        $user = User::where('username', $request->username)->first();

        // Check if user exists and password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Check if user role is Admin or Petugas
            if ($user->role !== 'Admin' && $user->role !== 'Petugas') {
                return back()->withErrors([
                    'login' => 'Anda tidak memiliki akses ke panel admin.',
                ])->withInput();
            }

            // Check if user status is active
            if ($user->status !== 'Aktif') {
                return back()->withErrors([
                    'login' => 'Akun Anda telah dinonaktifkan.',
                ])->withInput();
            }

            // Update last login timestamp
            $user->update(['last_login' => now()]);

            // Login user
            Auth::login($user);

            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil.');
        }

        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
