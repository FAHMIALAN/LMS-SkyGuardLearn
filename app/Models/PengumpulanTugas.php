<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;

    /**
     * Mendefinisikan nama tabel secara eksplisit.
     */
    protected $table = 'pengumpulan_tugas';

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'tugas_id',
        'user_id',
        'file_jawaban',
        'nilai',
        'catatan_pengajar',
    ];

    /**
     * Relasi: Satu pengumpulan dimiliki oleh satu User (Siswa).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Satu pengumpulan merujuk ke satu Tugas.
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}
