<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    /**
     * Mendefinisikan nama tabel secara eksplisit.
     */
    protected $table = 'komentar';

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'materi_id',
        'isi_komentar',
    ];

    /**
     * Relasi: Satu komentar dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Satu komentar (mungkin) dimiliki oleh satu Materi.
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
