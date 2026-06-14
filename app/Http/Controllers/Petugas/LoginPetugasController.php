<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginPetugasController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('petugas.dashboard');
        }

        return view('petugas.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (($user->role ?? null) !== 'Petugas') {
                Auth::logout();

                return back()->withErrors([
                    'login' => 'Akun ini bukan petugas.',
                ])->withInput();
            }

            if (($user->status ?? 'Aktif') !== 'Aktif') {
                Auth::logout();

                return back()->withErrors([
                    'login' => 'Akun Anda nonaktif.',
                ])->withInput();
            }

            return redirect()->route('petugas.dashboard');
        }

        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('petugas.login');
    }
}