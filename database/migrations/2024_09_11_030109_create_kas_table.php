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
        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->comment('Tanggal transaksi kas');
            $table->string('jenis')->comment('Jenis transaksi kas (e.g., pemasukan, pengeluaran)');
            $table->decimal('jumlah', 15, 2)->comment('Jumlah uang dalam transaksi kas');
            $table->text('keterangan')->nullable()->comment('Keterangan tambahan untuk transaksi kas');
            $table->enum('tipe', ['masuk', 'keluar'])->comment('Tipe transaksi (masuk atau keluar)');
            $table->decimal('saldo', 15, 2)->nullable()->comment('Saldo kas setelah transaksi');
            $table->string('nama_pembayar')->nullable()->comment('Nama pembayar dalam transaksi');
            $table->string('metode_pembayaran')->nullable()->comment('Metode pembayaran (e.g., tunai, transfer)');
            $table->string('referensi')->nullable()->comment('Referensi atau nomor dokumen terkait transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas');
    }
};
