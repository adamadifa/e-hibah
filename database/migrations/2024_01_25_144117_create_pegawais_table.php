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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->char('nip', 18)->primary();
            $table->string('nama_pegawai', 100);
            $table->char('kode_unit', 2);
            $table->char('kode_jabatan', 2);
            $table->char('kode_status_pns', 2);
            $table->char('is_active', 1);
            $table->foreign('kode_unit')->references('kode_unit')
                ->on('unit_organisasi')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('kode_jabatan')->references('kode_jabatan')
                ->on('jabatan')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('kode_status_pns')->references('kode_status_pns')
                ->on('status_pns')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
