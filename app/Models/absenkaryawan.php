<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenKaryawan extends Model
{
    use HasFactory;

    protected $table = 'absen_karyawan';
    protected $fillable = [
        'user_id',
        'jabatan_id',
        'tanggal_absensi',
        'jam_absensi',
        'foto',
        'lokasi',
        'status',
        'file_surat',
    ];
    

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model JabatanKaryawan
     */
    public function jabatan()
    {
        return $this->belongsTo(JabatanKaryawan::class, 'jabatan_id');
    }
}
