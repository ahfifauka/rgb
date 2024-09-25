<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanM extends Model
{
    use HasFactory;
    protected $fillable = [
        'perusahaan',
        'alamat',
        'contac',
        'nohp',
        'kebutuhan',
        'progres',
        'keterangan',
    ];
}
