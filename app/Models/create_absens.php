<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absens';
    protected $fillable = [
        'nama_karyawan', 'jabatan', 'jenis', 'foto', 'file_surat', 'latitude', 'longitude', 'tanggal'
    ];
}