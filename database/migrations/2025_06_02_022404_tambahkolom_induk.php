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
        Schema::table('unit_kerja', function (Blueprint $table) {
            $table->unsignedBigInteger('induk_id')->nullable()->after('jenis_unit_id');
            $table->foreign('induk_id')->references('id')->on('unit_kerja')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
