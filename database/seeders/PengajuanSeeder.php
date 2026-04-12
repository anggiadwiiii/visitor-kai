<?php

namespace Database\Seeders;

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Database\Seeder;

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users
        $users = User::where('role', 'User')->get();
        $adminUsers = User::where('role', 'Admin')->get();

        if ($users->isEmpty()) {
            return; // Skip if no users exist
        }

        // Sample applications with different statuses
        Pengajuan::create([
            'user_id' => $users->first()->id,
            'nama_pengunjung' => 'Muhammad Rizki',
            'email_pengunjung' => 'rizki.visitor@example.com',
            'no_telepon' => '081234567890',
            'asal_institusi' => 'PT Teknologi Indonesia',
            'tujuan_kunjungan' => 'Kunjungan kerja',
            'tanggal_kunjungan' => now()->addDays(5)->format('Y-m-d'),
            'jam_kunjungan' => '09:00',
            'jumlah_pengunjung' => 5,
            'status' => 'Menunggu',
            'catatan_admin' => null,
        ]);

        Pengajuan::create([
            'user_id' => $users->first()->id,
            'nama_pengunjung' => 'Siti Nurhaliza',
            'email_pengunjung' => 'siti.nurhaliza@example.com',
            'no_telepon' => '082345678901',
            'asal_institusi' => 'Universitas Negeri Jakarta',
            'tujuan_kunjungan' => 'Studi banding',
            'tanggal_kunjungan' => now()->addDays(3)->format('Y-m-d'),
            'jam_kunjungan' => '10:00',
            'jumlah_pengunjung' => 15,
            'status' => 'Disetujui',
            'disetujui_oleh' => $adminUsers->first()?->id,
            'tanggal_disetujui' => now()->format('Y-m-d H:i:s'),
            'catatan_admin' => 'Disetujui - Sudah koordinasi dengan bagian terkait',
        ]);

        Pengajuan::create([
            'user_id' => $users->first()->id,
            'nama_pengunjung' => 'Ahmad Suryanto',
            'email_pengunjung' => 'ahmad.suryanto@example.com',
            'no_telepon' => '083456789012',
            'asal_institusi' => 'Kementerian Perhubungan',
            'tujuan_kunjungan' => 'Audit operasional',
            'tanggal_kunjungan' => now()->subDays(2)->format('Y-m-d'),
            'jam_kunjungan' => '08:00',
            'jumlah_pengunjung' => 8,
            'status' => 'Selesai',
            'disetujui_oleh' => $adminUsers->first()?->id,
            'tanggal_disetujui' => now()->subDays(5)->format('Y-m-d H:i:s'),
            'catatan_admin' => 'Kunjungan telah selesai',
        ]);

        Pengajuan::create([
            'user_id' => $users->first()->id,
            'nama_pengunjung' => 'Retno Wulandari',
            'email_pengunjung' => 'retno.wulandari@example.com',
            'no_telepon' => '084567890123',
            'asal_institusi' => 'PT Konsultan Bisnis',
            'tujuan_kunjungan' => 'Rapat koordinasi',
            'tanggal_kunjungan' => now()->addDays(7)->format('Y-m-d'),
            'jam_kunjungan' => '14:00',
            'jumlah_pengunjung' => 3,
            'status' => 'Ditolak',
            'tanggal_ditolak' => now()->format('Y-m-d H:i:s'),
            'catatan_admin' => 'Ditolak - Waktu bentrok dengan keperluan internal',
        ]);

        Pengajuan::create([
            'user_id' => $users->first()->id,
            'nama_pengunjung' => 'Iwan Gunawan',
            'email_pengunjung' => 'iwan.gunawan@example.com',
            'no_telepon' => '085678901234',
            'asal_institusi' => 'Asosiasi Transportasi',
            'tujuan_kunjungan' => 'Sharing knowledge',
            'tanggal_kunjungan' => now()->addDays(2)->format('Y-m-d'),
            'jam_kunjungan' => '11:00',
            'jumlah_pengunjung' => 6,
            'status' => 'Menunggu',
            'catatan_admin' => null,
        ]);
    }
}
