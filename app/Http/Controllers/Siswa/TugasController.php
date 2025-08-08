<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    /**
     * Menampilkan daftar semua tugas yang diberikan oleh pengajar.
     */
    public function index()
    {
        // Mengambil semua tugas beserta status pengumpulannya oleh siswa yang sedang login
        $tugas = Tugas::with(['pengumpulan' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->orderBy('created_at', 'desc')->get();

        return view('siswa.tugas.index', compact('tugas'));
    }

    /**
     * Menampilkan halaman untuk mengunggah file jawaban tugas.
     * Menggunakan Route-Model Binding untuk mengambil data tugas secara otomatis.
     */
    public function show(Tugas $tugas)
    {
        // Cek apakah siswa sudah mengumpulkan tugas ini
        $pengumpulan = PengumpulanTugas::where('user_id', Auth::id())
                                      ->where('tugas_id', $tugas->id)
                                      ->first();

        return view('siswa.tugas.upload', compact('tugas', 'pengumpulan'));
    }

    /**
     * Memproses pengiriman (upload) file jawaban tugas dari siswa.
     */
    public function submit(Request $request, Tugas $tugas)
    {
        // 1. Validasi request
        $request->validate([
            'file_jawaban' => 'required|file|mimes:pdf,doc,docx,zip|max:10240', // max 10MB
        ]);

        // 2. Cek apakah siswa sudah pernah mengumpulkan
        $existingSubmission = PengumpulanTugas::where('user_id', Auth::id())
                                              ->where('tugas_id', $tugas->id)
                                              ->first();

        if ($existingSubmission) {
            // Jika sudah ada, hapus file lama sebelum upload yang baru
            Storage::disk('public')->delete($existingSubmission->file_jawaban);
            $pengumpulan = $existingSubmission;
        } else {
            // Jika belum, buat record baru
            $pengumpulan = new PengumpulanTugas();
            $pengumpulan->user_id = Auth::id();
            $pengumpulan->tugas_id = $tugas->id;
        }

        // 3. Simpan file yang diupload
        if ($request->hasFile('file_jawaban')) {
            // Nama file dibuat unik: tugas_{tugas_id}_siswa_{user_id}.extensi
            $file = $request->file('file_jawaban');
            $fileName = 'tugas_' . $tugas->id . '_siswa_' . Auth::id() . '.' . $file->getClientOriginalExtension();
            
            // Simpan file ke storage/app/public/jawaban_tugas
            $path = $file->storeAs('jawaban_tugas', $fileName, 'public');
            $pengumpulan->file_jawaban = $path;
        }

        // 4. Simpan record ke database
        $pengumpulan->save();

        return redirect()->route('siswa.tugas.index')->with('success', 'Tugas berhasil dikumpulkan.');
    }
}
