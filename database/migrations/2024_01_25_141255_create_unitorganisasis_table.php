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
        Schema::create('unit_organisasi', function (Blueprint $table) {
            $table->char('kode_unit', 2)->primary();
            $table->string('nama_unit', 20);
            $table->char('kode_organisasi', 2);
            $table->foreign('kode_organisasi')->references('kode_organisasi')
                ->on('organisasi')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_organisasi');
    }
};
