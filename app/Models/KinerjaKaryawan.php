<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KinerjaKaryawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jabatan_id',
        'tanggal_penilaian',
        'periode',
        'tanggung_jawab',
        'kehadiran_ketepatan_waktu',
        'produktivitas',
        'kerja_sama_tim',
        'kemampuan_komunikasi',
        'total_skor'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(JabatanKaryawan::class);
    }

    public function calculateTotalScore()
    {
        $total = $this->tanggung_jawab + $this->kehadiran_ketepatan_waktu + $this->produktivitas 
               + $this->kerja_sama_tim + $this->kemampuan_komunikasi;
        $this->total_skor = $total * 4; // Each point is worth 4 (5 aspects * 5 max score * 4 = 100)
        $this->save();
        return $this->total_skor;
    }
}