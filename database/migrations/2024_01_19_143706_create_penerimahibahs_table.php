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
        Schema::create('penerimahibah', function (Blueprint $table) {
            //PH-2400001
            $table->char('kode_penerimahibah', 10)->primary();
            $table->string('nama', 100);
            $table->string('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('no_izin', 100);
            $table->string('no_telepon', 13);
            $table->string('email', 100);
            $table->string('penanggung_jawab', 50);
            $table->string('no_telepon_penanggung_jawab', 15);
            $table->string('email_penanggung_jawab', 100);
            $table->string('file_ktp', 100);
            $table->string('nama_bank', 100);
            $table->string('no_rekening', 50);
            $table->string('nama_pemilik_rekening', 50);
            $table->string('file_rekening', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimahibah');
    }
};
