<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DetailPengajuanController extends Controller
{
    public function show($id)
    {
        $data = collect([
            1 => [
                'id' => 1,
                'nama' => 'Alea Arunika',
                'jenis' => 'Visitor Pelajar/Magang',
                'instansi' => 'Universitas Terbuka Surabaya',
                'nomor_pengajuan' => 'VST-CY2K6',
                'penanggung_jawab' => 'Dilan',
                'jabatan_pic' => 'Manajer IT',
                'stasiun_kunjungan' => 'St. Lempuyangan',
                'dokumen' => 'Surat Tugas (1).pdf',
                'tanggal_mulai' => '13/12/2025',
                'tanggal_selesai' => '13/12/2025',
                'tujuan' => 'Meeting dengan HRD terkait Project Magang.',
            ],
            2 => [
                'id' => 2,
                'nama' => 'Destri Istifani Ivanka',
                'jenis' => 'Visitor Perusahaan',
                'instansi' => 'PT. UBS Gold Indonesia',
                'nomor_pengajuan' => 'VST-A82LM',
                'penanggung_jawab' => 'Bagas',
                'jabatan_pic' => 'Supervisor Operasional',
                'stasiun_kunjungan' => 'St. Tugu Yogyakarta',
                'dokumen' => 'Surat Kunjungan.pdf',
                'tanggal_mulai' => '10/12/2025',
                'tanggal_selesai' => '10/12/2025',
                'tujuan' => 'Inspeksi Stasiun Tugu Yogyakarta.',
            ],
            3 => [
                'id' => 3,
                'nama' => 'Azida Kautsar Milla',
                'jenis' => 'Visitor Perusahaan',
                'instansi' => 'PT. Goto Indonesia',
                'nomor_pengajuan' => 'VST-B71XP',
                'penanggung_jawab' => 'Rangga',
                'jabatan_pic' => 'Kepala Divisi',
                'stasiun_kunjungan' => 'St. Lempuyangan',
                'dokumen' => 'Dokumen Pendukung.pdf',
                'tanggal_mulai' => '06/12/2025',
                'tanggal_selesai' => '06/12/2025',
                'tujuan' => 'Meeting di ruang VIP.',
            ],
            4 => [
                'id' => 4,
                'nama' => 'Divanadia Ramadhani',
                'jenis' => 'Visitor Instansi',
                'instansi' => 'PT. Mencari Cinta Sejati',
                'nomor_pengajuan' => 'VST-D91TR',
                'penanggung_jawab' => 'Farhan',
                'jabatan_pic' => 'Koordinator Lapangan',
                'stasiun_kunjungan' => 'St. Tugu Yogyakarta',
                'dokumen' => 'Surat Audiensi.pdf',
                'tanggal_mulai' => '05/12/2025',
                'tanggal_selesai' => '05/12/2025',
                'tujuan' => 'Audiensi dan koordinasi.',
            ],
        ])->get((int) $id);

        if (!$data) {
            abort(404);
        }

        $adminName = session('admin_username', 'Admin');
        $pengajuanCount = $this->getPengajuanCount();

        return view('admin.detail', compact('data', 'adminName', 'pengajuanCount'));
    }
}