<?php

namespace Database\Seeders;

use App\Models\Pengajuan;
use App\Models\Visitor;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    public function run(): void
    {
        $pengajuans = Pengajuan::where('status', '!=', 'Ditolak')
            ->where('status', '!=', 'Menunggu')
            ->get();

        if ($pengajuans->isEmpty()) {
            return;
        }

        foreach ($pengajuans as $pengajuan) {
            for ($i = 1; $i <= min($pengajuan->jumlah_pengunjung, 3); $i++) {
                $waktuMasuk = now()->subHours(rand(1, 48));
                $hasCheckedOut = rand(0, 1);

                Visitor::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_pengunjung' => $pengajuan->nama_pengunjung . " - Peserta {$i}",
                    'email_pengunjung' => "peserta{$i}." . explode('@', $pengajuan->email_pengunjung)[0] . "@example.com",
                    'no_identitas' => '3201' . str_pad(rand(1, 99999), 6, '0', STR_PAD_LEFT),
                    'jenis_identitas' => ['KTP', 'SIM', 'Paspor', 'Lainnya'][rand(0, 3)],
                    'waktu_masuk' => $waktuMasuk,
                    'waktu_keluar' => $hasCheckedOut ? $waktuMasuk->copy()->addHours(rand(1, 8)) : null,
                    'asal_institusi' => $pengajuan->asal_institusi,
                    'keterangan' => $hasCheckedOut ? 'Sudah checkout' : 'Masih di area',
                ]);
            }
        }

        $todayPengajuan = Pengajuan::where('status', 'Disetujui')->first();
        if ($todayPengajuan) {
            for ($i = 1; $i <= 2; $i++) {
                Visitor::create([
                    'pengajuan_id' => $todayPengajuan->id,
                    'nama_pengunjung' => 'Pengunjung Hari Ini - ' . $i,
                    'email_pengunjung' => "pengunjung.hariini{$i}@example.com",
                    'no_identitas' => '3201' . str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT),
                    'jenis_identitas' => 'KTP',
                    'waktu_masuk' => null,  // Fresh - belum check-in
                    'waktu_keluar' => null,
                    'asal_institusi' => $todayPengajuan->asal_institusi,
                    'keterangan' => 'Belum check-in',
                ]);
            }
        }

        $freshPengajuan = Pengajuan::where('status', 'Disetujui')->first();
        if ($freshPengajuan) {
            Visitor::create([
                'pengajuan_id' => $freshPengajuan->id,
                'qr_token' => 'VIS-TEST-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
                'nama_pengunjung' => 'Visitor Test Fresh',
                'email_pengunjung' => 'test.fresh@example.com',
                'no_identitas' => '3201' . str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT),
                'jenis_identitas' => 'KTP',
                'waktu_masuk' => null,
                'waktu_keluar' => null,
                'asal_institusi' => $freshPengajuan->asal_institusi,
                'keterangan' => 'Belum check-in',
            ]);
        }
    }
}