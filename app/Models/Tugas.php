<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'file_soal',
    ];

    /**
     * Relasi: Satu tugas dimiliki oleh satu User (Pengajar).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ==================================================
     * === TAMBAHKAN RELASI INI ===
     * ==================================================
     * Relasi: Satu tugas bisa memiliki banyak pengumpulan dari siswa.
     */
    public function pengumpulan()
    {
        return $this->hasMany(PengumpulanTugas::class);
    }
}
