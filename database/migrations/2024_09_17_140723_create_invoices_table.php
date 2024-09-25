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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice');
            $table->string('no_faktur');
            $table->string('customer');
            $table->string('alamat');
            $table->string('banyak');
            $table->string('harga');
            $table->string('rekening');
            $table->string('periode');
            $table->string('due_date');
            $table->string('penggantian');
            $table->string('pph');
            $table->string('ppn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
