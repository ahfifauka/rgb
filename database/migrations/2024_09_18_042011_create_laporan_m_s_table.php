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
        Schema::create('laporan_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('perusahaan');
            $table->string('alamat');
            $table->string('contact');
            $table->string('nohp');
            $table->string('kebutuhan');
            $table->string('progres');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_m_s');
    }
};
