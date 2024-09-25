<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeShedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'project',
        'alamat',
        'presensi',
        'keterangan',
    ];
}
