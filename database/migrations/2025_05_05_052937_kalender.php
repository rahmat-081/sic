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
        Schema::create('kalender', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable(false)->unique();
            $table->foreignId('jenis_libur_id')->nullable()->constrained('jenis_libur')->nullOnDelete();
            $table->foreignId('jenis_jabatan_id')->nullable()->constrained('jenis_jabatan')->nullOnDelete();
            $table->foreignId('jenis_status_id')->nullable()->constrained('jenis_status')->nullOnDelete();
            $table->foreignId('jenis_unit_id')->nullable()->constrained('jenis_unit')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalender');
    }
};
