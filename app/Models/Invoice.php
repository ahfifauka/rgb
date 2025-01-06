<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_invoice',
        'no_faktur',
        'customer',
        'alamat',
        'banyak',
        'harga',
        'rekening',
        'periode',
        'due_date',
        'penggantian',
        'fee',
        'tanggal_lemburan',
        'personil_lemburan',
        'biaya_lemburan'
    ];
}
