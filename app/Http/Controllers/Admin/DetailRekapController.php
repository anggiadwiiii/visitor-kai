<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DetailRekapController extends Controller
{
    public function show($id)
    {
        $adminName = session('admin_username', 'Admin');

        $kunjungan = collect([
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
                'tanggal_kunjungan' => '13/12/2025',
                'check_in' => '08:15 WIB',
                'check_out' => '15:42 WIB',
                'durasi' => '7 Jam 27 Menit',
                'status' => 'Selesai',
                'tujuan' => 'Meeting dengan HRD terkait Project Magang.',
                'catatan' => 'Kunjungan selesai dengan tertib dan seluruh area yang diakses sudah dikembalikan dalam kondisi aman.',
            ],
            2 => [
                'id' => 2,
                'nama' => 'Bambang Kuncoro',
                'jenis' => 'Visitor Perusahaan',
                'instansi' => 'PT. Maju Jaya',
                'nomor_pengajuan' => 'VST-DK91A',
                'penanggung_jawab' => 'Rizky',
                'jabatan_pic' => 'Supervisor Operasional',
                'stasiun_kunjungan' => 'St. Tugu Yogyakarta',
                'dokumen' => 'Surat Kunjungan.pdf',
                'tanggal_kunjungan' => '10/12/2025',
                'check_in' => '09:05 WIB',
                'check_out' => '12:10 WIB',
                'durasi' => '3 Jam 05 Menit',
                'status' => 'Selesai',
                'tujuan' => 'Koordinasi operasional lapangan.',
                'catatan' => 'Visitor telah check-out sesuai prosedur.',
            ],
            3 => [
                'id' => 3,
                'nama' => 'Sulis Sekar Arum',
                'jenis' => 'Visitor Instansi',
                'instansi' => 'Dinas Perhubungan',
                'nomor_pengajuan' => 'VST-AJ73M',
                'penanggung_jawab' => 'Bayu',
                'jabatan_pic' => 'Kepala Pos',
                'stasiun_kunjungan' => 'St. Tugu Yogyakarta',
                'dokumen' => 'Surat Dinas.pdf',
                'tanggal_kunjungan' => '02/12/2025',
                'check_in' => '10:20 WIB',
                'check_out' => '13:00 WIB',
                'durasi' => '2 Jam 40 Menit',
                'status' => 'Selesai',
                'tujuan' => 'Monitoring fasilitas pelayanan.',
                'catatan' => 'Kunjungan berjalan lancar.',
            ],
        ])->get((int) $id);

        if (!$kunjungan) {
            abort(404);
        }

        $pengajuanCount = $this->getPengajuanCount();

        return view('admin.rekap-detail', compact('kunjungan', 'adminName', 'pengajuanCount'));
    }
}