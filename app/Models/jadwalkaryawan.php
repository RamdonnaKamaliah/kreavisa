<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKaryawan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_karyawans';

    protected $fillable = [
        'user_id',
        'jabatan_id',
        'shift_id',
        'shift_type', // Tambahkan ini
        'bulan',
        'tahun',
        'day_1', 'day_2', 'day_3', 'day_4', 'day_5', 'day_6', 'day_7', 'day_8',
        'day_9', 'day_10', 'day_11', 'day_12', 'day_13', 'day_14', 'day_15', 'day_16',
        'day_17', 'day_18', 'day_19', 'day_20', 'day_21', 'day_22', 'day_23', 'day_24',
        'day_25', 'day_26', 'day_27', 'day_28', 'day_29', 'day_30', 'day_31'
    ];

    /**
     * Relasi ke tabel User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke tabel JabatanKaryawan.
     */
    public function jabatan()
    {
        return $this->belongsTo(JabatanKaryawan::class, 'jabatan_id');
    }

    /**
     * Relasi ke tabel ShiftKaryawan.
     */
    public function shift()
    {
        return $this->belongsTo(ShiftKaryawan::class, 'shift_id');
    }
}