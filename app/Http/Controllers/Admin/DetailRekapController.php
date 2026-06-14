<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Visitor;
use Illuminate\View\View;

class DetailRekapController extends Controller
{
    public function show($id): View
    {
        $visitor = Visitor::with('pengajuan')->findOrFail($id);

        $adminName = auth()->user()->nama ?? auth()->user()->name ?? session('admin_username', 'Admin');
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        $durasi = '-';

        if ($visitor->waktu_masuk && $visitor->waktu_keluar) {
            $diff = $visitor->waktu_masuk->diff($visitor->waktu_keluar);
            $durasi = $diff->h . ' jam ' . $diff->i . ' menit';
        }

        $kunjungan = [
            'id' => $visitor->id,
            'nama' => $visitor->nama_pengunjung ?? '-',
            'jenis' => 'Visitor Kunjungan',
            'instansi' => $visitor->asal_institusi ?? '-',
            'email' => $visitor->email_pengunjung ?? '-',
            'no_identitas' => $visitor->no_identitas ?? '-',
            'jenis_identitas' => $visitor->jenis_identitas ?? '-',

            'tanggal_kunjungan' => $visitor->pengajuan && $visitor->pengajuan->tanggal_kunjungan
                ? $visitor->pengajuan->tanggal_kunjungan->translatedFormat('d F Y')
                : '-',

            'check_in' => $visitor->waktu_masuk
                ? $visitor->waktu_masuk->translatedFormat('H:i')
                : '-',

            'check_out' => $visitor->waktu_keluar
                ? $visitor->waktu_keluar->translatedFormat('H:i')
                : '-',

            'durasi' => $durasi,

            'status' => $visitor->getStatus(),
            'keterangan' => $visitor->keterangan ?? '-',
            'catatan' => $visitor->keterangan ?? '-',

            'tujuan' => $visitor->pengajuan->tujuan_kunjungan ?? '-',

            'nomor_pengajuan' => $visitor->pengajuan
                ? 'PGJ-' . str_pad((string) $visitor->pengajuan->id, 5, '0', STR_PAD_LEFT)
                : '-',

            'penanggung_jawab' => $adminName,
            'jabatan_pic' => $visitor->pengajuan->jabatan_pic ?? '-',
            'stasiun_kunjungan' => $visitor->pengajuan->stasiun_kunjungan ?? '-',
            'dokumen' => $visitor->pengajuan->dokumen ?? '-',
        ];

        return view('admin.rekap-detail', [
            'adminName' => $adminName,
            'pengajuanCount' => $pengajuanCount,
            'kunjungan' => $kunjungan,
        ]);
    }
}