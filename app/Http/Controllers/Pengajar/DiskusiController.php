<?php

namespace App\Http\Controllers\Pengajar;

use App\Events\PesanBaru;
use App\Http\Controllers\Controller;
use App\Models\Komentar;
use App\Models\Materi; // <-- Tambahkan ini
use Illuminate\Http\Request;

class DiskusiController extends Controller
{
    public function index()
    {
        $semuaKomentar = Komentar::whereNull('materi_id')
                                ->with('user')
                                ->latest()
                                ->paginate(20);

        return view('pengajar.diskusi.index', compact('semuaKomentar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_komentar' => 'required|string|min:1|max:1000',
            'materi_id' => 'nullable|exists:materi,id' // materi_id sekarang opsional
        ]);

        // Jika ada materi_id, lakukan pengecekan keamanan tambahan
        if ($request->filled('materi_id')) {
            $materi = Materi::findOrFail($request->materi_id);
            if ($materi->user_id !== auth()->id()) {
                abort(403, 'Anda tidak memiliki akses ke diskusi materi ini.');
            }
        }

        $komentar = Komentar::create([
            'user_id' => auth()->id(),
            'materi_id' => $request->materi_id, // Bisa null (forum umum) atau berisi id
            'isi_komentar' => $request->isi_komentar,
        ]);

        $komentar->load('user');
        broadcast(new PesanBaru($komentar))->toOthers();
        return response()->json(['status' => 'success', 'komentar' => $komentar]);
    }
}
