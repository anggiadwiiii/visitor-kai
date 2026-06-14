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

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->role !== 'Admin') {
                return back()->withErrors([
                    'login' => 'Hanya pengguna dengan role Admin yang dapat mengakses panel admin ini.',
                ])->withInput();
            }

            if ($user->status !== 'Aktif') {
                return back()->withErrors([
                    'login' => 'Akun Anda telah dinonaktifkan.',
                ])->withInput();
            }

            Auth::login($user);
            $request->session()->regenerate();

            $user->update([
                'last_login_at' => now(),
            ]);

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