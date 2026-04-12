<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $query = Pengajuan::with('user', 'approvedBy');

        // Filter by search
        if ($search) {
            $query->where('nama_pengunjung', 'like', "%{$search}%")
                  ->orWhere('email_pengunjung', 'like', "%{$search}%")
                  ->orWhere('asal_institusi', 'like', "%{$search}%");
        }

        // Filter by status
        if ($status) {
            $query->where('status', $status);
        }

        $pengajuan = $query->paginate(15);
        $adminName = auth()->user()->nama ?? 'Admin';
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        return view('admin.index', compact('pengajuan', 'search', 'status', 'adminName', 'pengajuanCount'));
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with('user', 'visitors', 'approvedBy')->findOrFail($id);
        $adminName = auth()->user()->nama ?? 'Admin';
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        return view('admin.detail', compact('pengajuan', 'adminName', 'pengajuanCount'));
    }

    public function approve(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'status' => 'Disetujui',
            'disetujui_oleh' => auth()->id(),
            'tanggal_disetujui' => now(),
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->back()->with('success', 'Pengajuan disetujui');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['catatan_admin' => 'required']);
        
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'status' => 'Ditolak',
            'disetujui_oleh' => auth()->id(),
            'tanggal_ditolak' => now(),
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->back()->with('success', 'Pengajuan ditolak');
    }
}
