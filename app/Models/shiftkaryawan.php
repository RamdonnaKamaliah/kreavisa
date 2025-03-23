<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftKaryawan extends Model
{
    use HasFactory;

    protected $table = 'shift_karyawans';

    protected $fillable = [
        'user_id',
        'jabatan_id', // Sebelumnya 'id_jabatan', harus sesuai dengan request di controller
        'shift_1',
        'shift_2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(JabatanKaryawan::class, 'jabatan_id');
    }
}
