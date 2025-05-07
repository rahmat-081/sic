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
        Schema::create('riwayat_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->references('id')->on('pengajuan_cuti');
            $table->foreignId('jenis_approval_id')->references('id')->on('jenis_approval');
            $table->string('alasan', 255)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pengajuan');
    }
};
