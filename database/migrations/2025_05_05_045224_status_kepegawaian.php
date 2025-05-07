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
        Schema::create('status_kepegawaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('jenis_status_id')->nullable(false)->constrained('jenis_status')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('unit_kerja_id')->nullable(false)->constrained('unit_kerja')->onDelete('cascade')->onUpdate('cascade');
            $table->string('awal', 100)->nullable(false);
            $table->string('akhir', 100)->nullable(false);
            $table->string('nosurat', 100)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_kepegawaian');
    }
};
