<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify enum to include 'Dibatalkan'
        DB::statement("ALTER TABLE pengajuan MODIFY COLUMN status ENUM('Menunggu', 'Disetujui', 'Ditolak', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back
        DB::statement("ALTER TABLE pengajuan MODIFY COLUMN status ENUM('Menunggu', 'Disetujui', 'Ditolak', 'Selesai') DEFAULT 'Menunggu'");
    }
};
