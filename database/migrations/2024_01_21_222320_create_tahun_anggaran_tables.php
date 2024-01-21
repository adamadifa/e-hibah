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
        Schema::create('tahun_anggaran', function (Blueprint $table) {
            $table->char('kode_anggaran', 17)->primary();
            $table->char('tahun', 4);
            $table->bigInteger('jumlah_anggaran');
            $table->char('is_active', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun_anggaran');
    }
};
