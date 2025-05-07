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
        Schema::create('pengajuan_cuti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->references('id')->on('karyawan');
            $table->foreignId('jenis_cuti_id')->references('id')->on('jenis_cuti');
            $table->foreignId('jatah_cuti_id')->references('id')->on('jatah_cuti');
            $table->date('tanggal_pengajuan')->nullable(false);
            $table->date('mulai');
            $table->date('selesai');
            $table->integer('total_hari')->nullable(false);
            $table->string('alasan', 255)->nullable(false);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_cuti');
    }
};
