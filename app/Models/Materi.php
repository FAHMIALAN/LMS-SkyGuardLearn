<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'link_video',
        'file_pendukung',
    ];

    /**
     * Relasi: Satu materi dimiliki oleh satu User (Pengajar).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Satu materi bisa memiliki banyak komentar.
     */
    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }
}
