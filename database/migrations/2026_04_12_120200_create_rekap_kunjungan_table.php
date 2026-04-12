<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekap_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('total_kunjungan')->default(0);
            $table->integer('kunjungan_masuk')->default(0);
            $table->integer('kunjungan_keluar')->default(0);
            $table->integer('kunjungan_aktif')->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_kunjungan');
    }
};
