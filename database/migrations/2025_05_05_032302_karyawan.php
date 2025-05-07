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
        Schema::create('karyawan', function
        (Blueprint $table) {
         $table->bigIncrements('id');
         $table->string('npk', 10);
         $table->string('nama', 100);
            $table->string('alamat', 100);
            $table->string('tempatlahir', 50);
            $table->date('tanggallahir');
            $table->string('gender', 10);
            $table->string('nik', 16);
         $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
