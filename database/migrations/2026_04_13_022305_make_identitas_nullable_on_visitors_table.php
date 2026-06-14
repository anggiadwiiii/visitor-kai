<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('no_identitas')->nullable()->change();
            $table->string('jenis_identitas')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('no_identitas')->nullable(false)->change();
            $table->string('jenis_identitas')->nullable(false)->change();
        });
    }
};