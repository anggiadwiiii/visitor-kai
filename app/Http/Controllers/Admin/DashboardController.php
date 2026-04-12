<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Visitor;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats dari database
        $stats = [
            'pengajuan_baru' => Pengajuan::where('status', 'Menunggu')->count(),
            'disetujui' => Pengajuan::where('status', 'Disetujui')->count(),
            'pengunjung_hari_ini' => Visitor::whereDate('waktu_masuk', Carbon::today())->count(),
            'pengunjung_aktif' => Visitor::whereNull('waktu_keluar')->count(),
        ];

        $adminName = auth()->user()->nama ?? 'Admin';
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        return view('admin.dashboard', compact('stats', 'adminName', 'pengajuanCount'));
    }
}
