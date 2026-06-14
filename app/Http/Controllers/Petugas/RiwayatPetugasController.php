<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiwayatPetugasController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->get('filter', 'semua');
        $search = trim((string) $request->get('search', ''));

        $query = Visitor::with('pengajuan')
            ->where(function ($q) {
                $q->whereNotNull('waktu_masuk')
                  ->orWhereNotNull('waktu_keluar');
            });

        if ($filter === 'checkin') {
            $query->whereNotNull('waktu_masuk')
                  ->whereNull('waktu_keluar');
        } elseif ($filter === 'checkout') {
            $query->whereNotNull('waktu_keluar');
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengunjung', 'like', "%{$search}%")
                  ->orWhere('email_pengunjung', 'like', "%{$search}%")
                  ->orWhere('asal_institusi', 'like', "%{$search}%");
            });
        }

        $rows = $query->latest()->get();

        $riwayat = $rows->map(function (Visitor $item) {
            if ($item->waktu_keluar) {
                $tanggal = $item->waktu_keluar->format('d/m/Y');
                $keterangan = 'Check-out';
            } else {
                $tanggal = $item->waktu_masuk
                    ? $item->waktu_masuk->format('d/m/Y')
                    : '-';
                $keterangan = 'Check-in';
            }

            return [
                'nama' => $item->nama_pengunjung ?? '-',
                'tanggal' => $tanggal,
                'keterangan' => $keterangan,
            ];
        });

        return view('petugas.riwayat', [
            'riwayat' => $riwayat,
            'filter' => $filter,
            'search' => $search,
        ]);
    }
}