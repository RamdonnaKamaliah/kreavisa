<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiAbsen extends Model
{
    use HasFactory;

    protected $table = 'lokasi_absen';
    
    protected $fillable = [
        'nama_lokasi',
        'latitude',
        'longitude',
        'radius',
        'alamat'
    ];
}