<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patroli extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nik',
        'lokasi',
        'situasi',
        'foto_anggota',
        'foto_sekitar',
        'keterangan',
        'created_at'
    ];
}
