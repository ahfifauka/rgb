<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umr extends Model
{
    use HasFactory;
    protected $fillable = [
        'umr',
        'lokasi',
        'created_at',
        'updated_at',
    ];
}
