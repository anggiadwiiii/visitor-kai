<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Visitor;
use App\Exports\RekapExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RekapKunjunganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $query = Visitor::query();

        if ($search) {
            $query->where('nama_pengunjung', 'like', "%{$search}%")
                  ->orWhere('email_pengunjung', 'like', "%{$search}%");
        }

        $kunjungan = $query->paginate(15);

        $summary = [
            'total' => Visitor::count(),
            'checkin' => Visitor::whereNotNull('waktu_masuk')->count(),
            'checkout' => Visitor::whereNotNull('waktu_keluar')->count(),
        ];

        $stats = [
            'pengajuan_baru' => Pengajuan::where('status', 'Menunggu')->count(),
            'disetujui' => Pengajuan::where('status', 'Disetujui')->count(),
            'pengunjung_hari_ini' => Visitor::whereDate('waktu_masuk', now()->toDateString())->count(),
            'pengunjung_aktif' => Visitor::whereNull('waktu_keluar')->count(),
        ];

        $adminName = auth()->user()->nama ?? 'Admin';
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        return view('admin.rekap', compact(
            'kunjungan',
            'summary',
            'search',
            'adminName',
            'stats',
            'pengajuanCount'
        ));
    }

    public function export(Request $request)
    {
        $search = $request->search;

        $kunjungan = collect([
            ['id' => 1, 'nama' => 'Alea Arunika', 'tanggal' => '13/12/2025', 'keterangan' => 'Selesai'],
            ['id' => 2, 'nama' => 'Bambang Kuncoro', 'tanggal' => '10/12/2025', 'keterangan' => 'Selesai'],
            ['id' => 3, 'nama' => 'Sulis Sekar Arum', 'tanggal' => '02/12/2025', 'keterangan' => 'Selesai'],
            ['id' => 4, 'nama' => 'Husna Latifah Khoiriyah', 'tanggal' => '27/11/2025', 'keterangan' => 'Selesai'],
            ['id' => 5, 'nama' => 'Erwin Pamungkas', 'tanggal' => '21/11/2025', 'keterangan' => 'Selesai'],
            ['id' => 6, 'nama' => 'Fajar Setiawan', 'tanggal' => '13/10/2025', 'keterangan' => 'Selesai'],
            ['id' => 7, 'nama' => 'Farhan Farid Achmad', 'tanggal' => '01/09/2025', 'keterangan' => 'Selesai'],
            ['id' => 8, 'nama' => 'Agus Koesnaidi', 'tanggal' => '11/08/2025', 'keterangan' => 'Selesai'],
            ['id' => 9, 'nama' => 'Septi Setiyani', 'tanggal' => '19/07/2025', 'keterangan' => 'Selesai'],
        ]);

        if ($search) {
            $kunjungan = $kunjungan->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['nama']), strtolower($search));
            })->values();
        }

        $filename = 'rekap_kunjungan_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new RekapExport($kunjungan), $filename);
    }
}