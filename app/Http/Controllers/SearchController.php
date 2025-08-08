<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Materi; // Akan digunakan nanti setelah Model dibuat

class SearchController extends Controller
{
    /**
     * Menangani logika pencarian materi berdasarkan input pengguna.
     */
    public function __invoke(Request $request)
    {
        $query = $request->input('query');

        // Logika pencarian akan ditambahkan di sini.
        // Contoh:
        // $hasilPencarian = Materi::where('judul', 'like', "%{$query}%")->get();

        // Untuk saat ini, kita kembalikan view dengan data pencarian
        return view('search.results', [
            'query' => $query,
            'hasilPencarian' => [] // Hasilnya masih kosong untuk sekarang
        ]);
    }
}