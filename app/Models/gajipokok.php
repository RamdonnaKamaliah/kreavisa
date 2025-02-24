<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiPokok extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara manual
    protected $table = 'gaji_pokok';

    protected $fillable = [
        'jabatan_id',
        'gaji_pokok',
    ];

    
    public function jabatan()
    {
        return $this->belongsTo(JabatanKaryawan::class, 'jabatan_id');
    }
}