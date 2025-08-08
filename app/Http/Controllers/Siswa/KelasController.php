<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    /**
     * Menampilkan daftar semua materi yang tersedia untuk siswa.
     */
    public function index()
    {
        // Ambil semua materi, diurutkan dari yang terbaru
        $semuaMateri = Materi::latest()->paginate(12);

        // Ambil ID materi yang sudah diselesaikan oleh siswa yang login
        $materiSelesaiIds = Progress::where('user_id', Auth::id())
                                           ->pluck('materi_id')
                                           ->toArray();

        return view('siswa.materi.index', compact('semuaMateri', 'materiSelesaiIds'));
    }

    /**
     * Menampilkan detail satu materi beserta forum diskusinya.
     */
    public function show(Materi $materi)
    {
        // Ambil ID siswa yang sedang login
        $userId = Auth::id();

        // Cek apakah siswa ini sudah menyelesaikan materi yang sedang dibuka
        $isCompleted = Progress::where('user_id', $userId)
                                      ->where('materi_id', $materi->id)
                                      ->exists();

        // === PERBAIKAN DI SINI ===
        // Ambil semua komentar untuk materi ini, beserta data pengirimnya (user)
        // dan urutkan dari yang paling lama agar urutan chat benar.
        $semuaKomentar = $materi->komentar()->with('user')->oldest()->get();

        // Kirim semua data yang dibutuhkan ke view
        return view('siswa.materi.show', compact('materi', 'isCompleted', 'semuaKomentar'));
    }
}
