<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratP extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nik',
        'jenis',
        'keterangan',
    ];
}
