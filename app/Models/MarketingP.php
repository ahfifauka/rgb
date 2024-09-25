<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingP extends Model
{
    use HasFactory;
    protected $fillable = [
        'project',
        'contac_person',
        'nohp',
        'posisi',
        'alamat',
        'prediksi',
        'proggres',
        'personil_r',
        'hasil'
    ];
}

