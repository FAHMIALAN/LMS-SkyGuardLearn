<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Komentar;
use Carbon\Carbon; // Menggunakan Carbon untuk kejelasan

class HapusKomentarLama extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hapus-komentar-lama';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus komentar di semua forum yang lebih tua dari 48 jam';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai proses penghapusan komentar lama...');

        // Tentukan batas waktu: semua komentar sebelum 48 jam yang lalu
        $batasWaktu = Carbon::now()->subHours(48);
        
        // Menghapus komentar yang dibuat SEBELUM batas waktu
        $jumlahDihapus = Komentar::where('created_at', '<', $batasWaktu)->delete();

        if ($jumlahDihapus > 0) {
            $this->info("Selesai. Sebanyak {$jumlahDihapus} komentar lama berhasil dihapus.");
        } else {
            $this->info('Tidak ada komentar lama yang perlu dihapus saat ini.');
        }

        return self::SUCCESS;
    }
}
