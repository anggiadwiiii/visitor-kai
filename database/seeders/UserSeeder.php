<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin users
        User::create([
            'nama' => 'Anggia Putri',
            'username' => 'anggia.admin',
            'email' => 'anggia@kai.id',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'status' => 'Aktif',
        ]);

        User::create([
            'nama' => 'Nabila Sari',
            'username' => 'nabila.admin',
            'email' => 'nabila@kai.id',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'status' => 'Aktif',
        ]);

        // Petugas users
        User::create([
            'nama' => 'Dimas Pratama',
            'username' => 'dimas.petugas',
            'email' => 'dimas@kai.id',
            'password' => Hash::make('petugas123'),
            'role' => 'Petugas',
            'status' => 'Aktif',
        ]);

        User::create([
            'nama' => 'Rizky Maulana',
            'username' => 'rizky.security',
            'email' => 'rizky@kai.id',
            'password' => Hash::make('petugas123'),
            'role' => 'Petugas',
            'status' => 'Aktif',
        ]);

        User::create([
            'nama' => 'Salsa Aulia',
            'username' => 'salsa.operator',
            'email' => 'salsa@kai.id',
            'password' => Hash::make('petugas123'),
            'role' => 'Petugas',
            'status' => 'Aktif',
        ]);

        // Regular user (dapat mengajukan kunjungan)
        User::create([
            'nama' => 'Budi Santoso',
            'username' => 'budi.user',
            'email' => 'budi@example.com',
            'password' => Hash::make('user123'),
            'role' => 'User',
            'status' => 'Aktif',
        ]);
    }
}
