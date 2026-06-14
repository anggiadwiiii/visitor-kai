<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            if (!Schema::hasColumn('visitors', 'last_qr_generated_date')) {
                $table->date('last_qr_generated_date')->nullable()->after('qr_token')
                    ->comment('Tanggal terakhir QR code di-generate untuk multi-day visitors');
            }
        });
    }

    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            if (Schema::hasColumn('visitors', 'last_qr_generated_date')) {
                $table->dropColumn('last_qr_generated_date');
            }
        });
    }
};
