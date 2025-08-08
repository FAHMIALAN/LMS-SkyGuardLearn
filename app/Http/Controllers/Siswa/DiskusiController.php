<?php

namespace App\Http\Controllers\Siswa;

use App\Events\PesanBaru;
use App\Http\Controllers\Controller;
use App\Http\Requests\KomentarRequest;
use App\Models\Komentar;

class DiskusiController extends Controller
{
    /**
     * Menyimpan komentar baru dari siswa.
     */
    public function store(KomentarRequest $request)
    {
        $validated = $request->validated();

        $komentar = Komentar::create([
            'user_id' => auth()->id(),
            'materi_id' => $validated['materi_id'],
            'isi_komentar' => $validated['isi_komentar'],
        ]);

        $komentar->load('user');

        // Pancarkan event ke semua orang KECUALI si pengirim
        broadcast(new PesanBaru($komentar))->toOthers();

        // Selalu kembalikan response JSON
        return response()->json([
            'status' => 'success',
            'komentar' => $komentar
        ]);
    }
}
