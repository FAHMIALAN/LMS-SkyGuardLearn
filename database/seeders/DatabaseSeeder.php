<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Komentar;
use App\Models\Progress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Menjalankan seeder untuk mengisi database dengan data awal yang komprehensif.
     */
    public function run(): void
    {
        // 1. Membuat Pengguna Utama (1 Pengajar dan 10 Siswa)
        $pengajar = User::factory()->create([
            'name' => 'Budi Pengajar',
            'email' => 'pengajar@example.com',
            'role' => 'pengajar',
            'password' => Hash::make('password'),
        ]);

        $siswa = User::factory(10)->create(['role' => 'siswa']);

        // ==================================================
        // === PERBAIKAN: Membuat Materi Secara Eksplisit ===
        // ==================================================
        // Daripada menggunakan for(), kita langsung masukkan user_id di dalam create()
        Materi::factory(5)->create([
            'user_id' => $pengajar->id,
        ])->each(function ($materi) use ($pengajar, $siswa) {
            // Untuk setiap materi, buat contoh diskusi
            Komentar::factory()->create([
                'user_id' => $siswa->random()->id,
                'materi_id' => $materi->id,
                'isi_komentar' => 'Terima kasih penjelasannya, Pak. Sangat membantu!'
            ]);

            Komentar::factory()->create([
                'user_id' => $pengajar->id,
                'materi_id' => $materi->id,
                'isi_komentar' => 'Sama-sama! Senang bisa membantu.'
            ]);

            // Untuk setiap materi, buat data progres untuk beberapa siswa
            $siswaYangSelesai = $siswa->random(3);
            foreach ($siswaYangSelesai as $s) {
                Progress::factory()->create([
                    'user_id' => $s->id,
                    'materi_id' => $materi->id,
                ]);
            }
        });

        // ==================================================
        // === PERBAIKAN: Membuat Tugas Secara Eksplisit ===
        // ==================================================
        // Ini adalah cara paling "aman" untuk memastikan pemilik tugas adalah pengajar yang benar.
        Tugas::factory(3)->create([
            'user_id' => $pengajar->id,
        ]);
    }
}
