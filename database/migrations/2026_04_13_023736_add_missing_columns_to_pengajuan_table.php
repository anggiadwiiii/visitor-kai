<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan', 'nama_pic')) {
                $table->string('nama_pic')->nullable()->after('tujuan_kunjungan');
            }

            if (!Schema::hasColumn('pengajuan', 'jabatan_pic')) {
                $table->string('jabatan_pic')->nullable()->after('nama_pic');
            }

            if (!Schema::hasColumn('pengajuan', 'tanggal_selesai')) {
                $table->date('tanggal_selesai')->nullable()->after('tanggal_kunjungan');
            }

            if (!Schema::hasColumn('pengajuan', 'layanan_pendampingan')) {
                $table->string('layanan_pendampingan')->nullable()->after('stasiun_kunjungan');
            }

            if (!Schema::hasColumn('pengajuan', 'dokumen')) {
                $table->string('dokumen')->nullable()->after('layanan_pendampingan');
            }

            if (!Schema::hasColumn('pengajuan', 'catatan_admin')) {
                $table->text('catatan_admin')->nullable()->after('status');
            }

            if (!Schema::hasColumn('pengajuan', 'tanggal_disetujui')) {
                $table->timestamp('tanggal_disetujui')->nullable()->after('catatan_admin');
            }

            if (!Schema::hasColumn('pengajuan', 'tanggal_ditolak')) {
                $table->timestamp('tanggal_ditolak')->nullable()->after('tanggal_disetujui');
            }

            if (!Schema::hasColumn('pengajuan', 'disetujui_oleh')) {
                $table->unsignedBigInteger('disetujui_oleh')->nullable()->after('tanggal_ditolak');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $columns = [
                'nama_pic',
                'jabatan_pic',
                'tanggal_selesai',
                'layanan_pendampingan',
                'dokumen',
                'catatan_admin',
                'tanggal_disetujui',
                'tanggal_ditolak',
                'disetujui_oleh',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('pengajuan', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};