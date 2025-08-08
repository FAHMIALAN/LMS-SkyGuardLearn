<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // <-- Pastikan ini sudah ditambahkan
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ==================================================
    // === DEFINISI RELASI DATABASE ===
    // ==================================================

    // Seorang Pengajar bisa memiliki banyak Materi
    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    // Seorang Pengajar bisa memiliki banyak Tugas
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    // Seorang Pengguna (Pengajar/Siswa) bisa memiliki banyak Komentar
    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    // Seorang Siswa bisa memiliki banyak Progress
    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}