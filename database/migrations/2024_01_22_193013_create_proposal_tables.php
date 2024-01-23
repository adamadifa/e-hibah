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
        Schema::create('proposal', function (Blueprint $table) {
            $table->char('no_registrasi', 17)->primary();
            $table->date('tanggal_proposal');
            $table->char('kode_penerimahibah', 10);
            $table->string('no_surat', 30);
            $table->date('tanggal_surat');
            $table->char('id_jenispengajuan_dana', 1);
            $table->char('kode_anggaran', 6);
            $table->integer('jumlah_dana');
            $table->string('judu_proposal', 100);
            $table->string('lampiran_surat', 21);
            $table->foreign('kode_penerimahibah')->references('kode_penerimahibah')
                ->on('penerimahibah')->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('kode_anggaran')->references('kode_anggaran')
                ->on('tahun_anggaran')->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal');
    }
};
