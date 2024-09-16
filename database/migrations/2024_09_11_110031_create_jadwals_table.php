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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik');
            $table->string('area');
            $table->string('1');
            $table->string('2');
            $table->string('3');
            $table->string('4');
            $table->string('5');
            $table->string('6');
            $table->string('7');
            $table->string('8');
            $table->string('9');
            $table->string('10');
            $table->string('11');
            $table->string('12');
            $table->string('13');
            $table->string('14');
            $table->string('15');
            $table->string('16');
            $table->string('17');
            $table->string('18');
            $table->string('19');
            $table->string('20');
            $table->string('21');
            $table->string('22');
            $table->string('23');
            $table->string('24');
            $table->string('25');
            $table->string('26');
            $table->string('27');
            $table->string('28');
            $table->string('29')->nullable();
            $table->string('30')->nullable();
            $table->string('31')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
