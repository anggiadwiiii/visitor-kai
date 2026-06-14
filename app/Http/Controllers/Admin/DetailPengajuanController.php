<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\View\View;

class DetailPengajuanController extends Controller
{
    public function show($id): View
    {
        $pengajuan = Pengajuan::with(['user', 'visitors', 'approvedBy'])->findOrFail($id);

        $data = [
            'id' => $pengajuan->id,
            'nama' => $pengajuan->nama_pengunjung ?? '-',
            'jenis' => 'Pemohon Kunjungan',
            'instansi' => $pengajuan->asal_institusi ?? '-',
            'nomor_pengajuan' => 'PGJ-' . str_pad((string) $pengajuan->id, 5, '0', STR_PAD_LEFT),
            'nama_pic' => $pengajuan->nama_pic ?? '-',
            'jabatan_pic' => $pengajuan->jabatan_pic ?? '-',
            'stasiun_kunjungan' => $pengajuan->stasiun_kunjungan ?? '-',
            'dokumen' => $pengajuan->dokumen ?? '-',
            'tanggal_mulai' => $pengajuan->tanggal_kunjungan
                ? $pengajuan->tanggal_kunjungan->format('d/m/Y')
                : '-',
            'tanggal_selesai' => $pengajuan->tanggal_kunjungan
                ? $pengajuan->tanggal_kunjungan->format('d/m/Y')
                : '-',
            'tujuan' => $pengajuan->tujuan_kunjungan ?? '-',
            'status' => match ($pengajuan->status) {
                'Disetujui' => 'approved',
                'Ditolak' => 'rejected',
                default => 'processing',
            },
            'catatan' => $pengajuan->catatan_admin,
        ];

        $adminName = auth()->user()->nama ?? auth()->user()->name ?? session('admin_username', 'Admin');
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        return view('admin.detail', compact('data', 'adminName', 'pengajuanCount'));
    }
}