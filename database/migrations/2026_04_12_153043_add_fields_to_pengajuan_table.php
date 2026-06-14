<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->string('jabatan_pic')->nullable();
            $table->string('stasiun_kunjungan')->nullable();
            $table->string('dokumen')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn([
                'jabatan_pic',
                'stasiun_kunjungan',
                'dokumen'
            ]);
        });
    }
};