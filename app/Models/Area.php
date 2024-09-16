<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'area',
        'gaji',
        'pajak',
        'alamat',
        'lokasi',
        'tunj_trans',
        'tunj_makan',
        'inventaris',
        'kontak',
        'created_at',
    ];
}
