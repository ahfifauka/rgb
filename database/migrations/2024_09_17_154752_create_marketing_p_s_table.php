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
        Schema::create('marketing_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('project');
            $table->string('contac_person');
            $table->string('nohp');
            $table->string('posisi');
            $table->string('alamat');
            $table->string('prediksi');
            $table->string('proggres');
            $table->string('personil_r');
            $table->string('hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_p_s');
    }
};
