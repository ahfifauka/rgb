<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'jenis',
        'jumlah',
        'keterangan',
        'tipe',
        'saldo',
        'nama_pembayar',
        'metode_pembayaran',
        'referensi',
    ];
}
