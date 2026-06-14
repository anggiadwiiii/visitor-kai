<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class KelolaPenggunaController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->get('search', ''));
        $role = trim((string) $request->get('role', 'Semua'));

        $query = User::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($role !== '' && $role !== 'Semua') {
            $query->where('role', $role);
        }

        $rows = $query->latest()->get();

        $users = $rows->map(function (User $item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama ?? $item->name ?? '-',
                'username' => $item->username ?? '-',
                'email' => $item->email ?? '-',
                'role' => $item->role ?? 'Petugas',
                'status' => $item->status ?? 'Aktif',
                'last_login' => $item->last_login_at
                    ? $item->last_login_at->translatedFormat('d F Y H:i')
                    : '-',
            ];
        });

        $summary = [
            'total' => User::count(),
            'admin' => User::where('role', 'Admin')->count(),
            'petugas' => User::where('role', 'Petugas')->count(),
        ];

        $adminName = auth()->user()->nama ?? auth()->user()->name ?? session('admin_username', 'Admin');
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        return view('admin.kelola-pengguna', [
            'adminName' => $adminName,
            'pengajuanCount' => $pengajuanCount,
            'summary' => $summary,
            'search' => $search,
            'role' => $role,
            'users' => $users,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'same:password_confirmation'],
            'password_confirmation' => ['required', 'string', 'min:6'],
            'role' => ['required', 'in:Admin,Petugas'],
            'status' => ['required', 'in:Aktif,Nonaktif'],
        ]);

        User::create([
            'nama' => $validated['nama'],
            'name' => $validated['nama'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role' => ['required', 'in:Admin,Petugas'],
            'status' => ['required', 'in:Aktif,Nonaktif'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $payload = [
            'nama' => $validated['nama'],
            'name' => $validated['nama'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'],
        ];

        if (!empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $user->update($payload);

        return redirect()
            ->route('admin.users')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return redirect()
                ->route('admin.users')
                ->with('error', 'Akun yang sedang dipakai tidak bisa dihapus.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}