<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class KelolaPenggunaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $role = $request->role;

        $query = User::query();

        // Filter by search
        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        // Filter by role
        if ($role && $role !== 'Semua') {
            $query->where('role', $role);
        }

        $users = $query->paginate(15);

        $summary = [
            'total' => User::count(),
            'admin' => User::where('role', 'Admin')->count(),
            'petugas' => User::where('role', 'Petugas')->count(),
        ];

        $adminName = auth()->user()->nama ?? 'Admin';
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        return view('admin.kelola-pengguna', compact(
            'users',
            'summary',
            'search',
            'role',
            'adminName',
            'pengajuanCount'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:Admin,Petugas',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        User::create($request->only('nama', 'username', 'email', 'role', 'status') + [
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:Admin,Petugas',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $user->update($request->only('nama', 'email', 'role', 'status'));

        return redirect()->back()->with('success', 'Pengguna berhasil diupdate');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus');
    }
}