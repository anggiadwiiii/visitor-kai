<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function getSamplePengajuan()
    {
        return collect([
            [
                'id' => 1,
                'nama' => 'Alea Arunika',
                'instansi' => 'Universitas Terbuka Surabaya',
                'tanggal' => '13 Desember 2025',
                'keperluan' => 'Meeting dengan HRD',
                'status' => 'Menunggu',
            ],
            [
                'id' => 2,
                'nama' => 'Destri Istifani Ivanka',
                'instansi' => 'PT. UBS Gold Indonesia',
                'tanggal' => '10 Desember 2025',
                'keperluan' => 'Inspeksi Stasiun Tugu Yogyakarta',
                'status' => 'Menunggu',
            ],
            [
                'id' => 3,
                'nama' => 'Azida Kautsar Milla',
                'instansi' => 'PT. Goto Indonesia',
                'tanggal' => '06 Desember 2025',
                'keperluan' => 'Meeting di ruang VIP',
                'status' => 'Menunggu',
            ],
            [
                'id' => 4,
                'nama' => 'Divanadia Ramadhani',
                'instansi' => 'PT. Mencari Cinta Sejati',
                'tanggal' => '05 Desember 2025',
                'keperluan' => 'Audiensi dan koordinasi',
                'status' => 'Menunggu',
            ],
        ]);
    }

    protected function getPengajuanCount(): int
    {
        return $this->getSamplePengajuan()->count();
    }
}
