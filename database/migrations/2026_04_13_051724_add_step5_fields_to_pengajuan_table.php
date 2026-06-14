<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan', 'tipe_visitor')) {
                $table->string('tipe_visitor')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('pengajuan', 'layanan_pendampingan')) {
                $table->string('layanan_pendampingan')->nullable()->after('tujuan_kunjungan');
            }

            if (!Schema::hasColumn('pengajuan', 'nama_pic')) {
                $table->string('nama_pic')->nullable()->after('email_pengunjung');
            }

            if (!Schema::hasColumn('pengajuan', 'pintu')) {
                $table->string('pintu')->nullable()->after('dokumen');
            }

            if (!Schema::hasColumn('pengajuan', 'tujuan_akses')) {
                $table->string('tujuan_akses')->nullable()->after('pintu');
            }

            if (!Schema::hasColumn('pengajuan', 'jumlah_pendamping_protokoler')) {
                $table->string('jumlah_pendamping_protokoler')->nullable()->after('tujuan_akses');
            }

            if (!Schema::hasColumn('pengajuan', 'jumlah_jenis_kendaraan')) {
                $table->string('jumlah_jenis_kendaraan')->nullable()->after('jumlah_pendamping_protokoler');
            }

            if (!Schema::hasColumn('pengajuan', 'nomor_polisi_kendaraan')) {
                $table->string('nomor_polisi_kendaraan')->nullable()->after('jumlah_jenis_kendaraan');
            }

            if (!Schema::hasColumn('pengajuan', 'butuh_pendampingan_protokoler')) {
                $table->string('butuh_pendampingan_protokoler')->nullable()->after('nomor_polisi_kendaraan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('pengajuan', 'tipe_visitor')) {
                $columnsToDrop[] = 'tipe_visitor';
            }

            if (Schema::hasColumn('pengajuan', 'layanan_pendampingan')) {
                $columnsToDrop[] = 'layanan_pendampingan';
            }

            if (Schema::hasColumn('pengajuan', 'nama_pic')) {
                $columnsToDrop[] = 'nama_pic';
            }

            if (Schema::hasColumn('pengajuan', 'pintu')) {
                $columnsToDrop[] = 'pintu';
            }

            if (Schema::hasColumn('pengajuan', 'tujuan_akses')) {
                $columnsToDrop[] = 'tujuan_akses';
            }

            if (Schema::hasColumn('pengajuan', 'jumlah_pendamping_protokoler')) {
                $columnsToDrop[] = 'jumlah_pendamping_protokoler';
            }

            if (Schema::hasColumn('pengajuan', 'jumlah_jenis_kendaraan')) {
                $columnsToDrop[] = 'jumlah_jenis_kendaraan';
            }

            if (Schema::hasColumn('pengajuan', 'nomor_polisi_kendaraan')) {
                $columnsToDrop[] = 'nomor_polisi_kendaraan';
            }

            if (Schema::hasColumn('pengajuan', 'butuh_pendampingan_protokoler')) {
                $columnsToDrop[] = 'butuh_pendampingan_protokoler';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};