<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\Pengajuan;
use Illuminate\Support\Carbon;

class SecurityController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $stats = [
            'check_in' => Visitor::whereDate('waktu_masuk', $today)->count(),
            'check_out' => Visitor::whereDate('waktu_keluar', $today)->count(),
        ];
        
        // Nama petugas dari session/auth
        $petugasName = auth()->user()->nama ?? 'Syarifudin';

        return view('petugas.dashboard', compact('stats', 'petugasName'));
    }

    public function riwayat()
    {
        // Ambil data pengunjung terbaru
        $riwayat = Visitor::latest()->take(20)->get();
        return view('petugas.riwayat', compact('riwayat'));
    }

    public function scan()
    {
        return view('petugas.scan');
    }
}
