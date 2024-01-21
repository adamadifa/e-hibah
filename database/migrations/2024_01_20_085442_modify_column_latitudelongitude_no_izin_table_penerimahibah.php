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
        Schema::table('penerimahibah', function (Blueprint $table) {
            $table->string('latitude')->nullable()->change();
            $table->string('longitude')->nullable()->change();;
            $table->string('no_izin', 100)->nullable()->change();;
            $table->string('email', 100)->nullable()->change();;
            $table->string('email_penanggung_jawab', 100)->nullable()->change();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penerimahibah', function (Blueprint $table) {
            //
        });
    }
};
