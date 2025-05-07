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
        Schema::create('riwayat_jabatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->references('id')->on('karyawan');
            $table->foreignId('jenis_jabatan_id')->references('id')->on('jenis_jabatan');
            $table->foreignId('unit_kerja_id')->references('id')->on('unit_kerja');
            $table->date('mulai')->nullable(false);
            $table->date('selesai')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_jabatan');
    }
};
