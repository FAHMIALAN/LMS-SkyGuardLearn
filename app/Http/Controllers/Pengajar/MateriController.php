<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Http\Requests\MateriRequest;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Fungsi privat untuk mengekstrak ID video dari berbagai format URL YouTube.
     */
    private function getYouTubeVideoId($url)
    {
        // Regex ini bisa menangani format youtube.com/watch, youtu.be, dan parameter ?si=
        $regex = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';

        if (preg_match($regex, $url, $matches)) {
            return $matches[1];
        }
        return null; // Kembalikan null jika tidak ada ID yang ditemukan
    }

    public function index()
    {
        $semuaMateri = Materi::where('user_id', auth()->id())->latest()->paginate(10);
        return view('pengajar.materi.index', compact('semuaMateri'));
    }

    public function create()
    {
        return view('pengajar.materi.create');
    }

    public function store(MateriRequest $request)
    {
        $validated = $request->validated();
        
        // Proses link video untuk mendapatkan ID-nya saja
        if ($request->filled('link_video')) {
            // === PERBAIKAN SINTAKS DI SINI ===
            $validated['link_video'] = $this->getYouTubeVideoId($request->input('link_video'));
        }

        if ($request->hasFile('file_pendukung')) {
            $path = $request->file('file_pendukung')->store('materi/files', 'public');
            $validated['file_pendukung'] = $path;
        }

        $validated['user_id'] = auth()->id();
        Materi::create($validated);

        return redirect()->route('pengajar.materi.index')->with('success', 'Materi baru berhasil ditambahkan!');
    }

    public function edit(Materi $materi)
    {
        if ($materi->user_id != auth()->id()) {
            abort(403);
        }
        return view('pengajar.materi.edit', compact('materi'));
    }

    public function update(MateriRequest $request, Materi $materi)
    {
        if ($materi->user_id != auth()->id()) {
            abort(403);
        }

        $validated = $request->validated();
        
        // Proses link video saat update
        if ($request->filled('link_video')) {
            // === PERBAIKAN SINTAKS DI SINI JUGA ===
            $validated['link_video'] = $this->getYouTubeVideoId($request->input('link_video'));
        } else {
            $validated['link_video'] = null;
        }

        if ($request->hasFile('file_pendukung')) {
            if ($materi->file_pendukung) {
                Storage::disk('public')->delete($materi->file_pendukung);
            }
            $path = $request->file('file_pendukung')->store('materi/files', 'public');
            $validated['file_pendukung'] = $path;
        }

        $materi->update($validated);

        return redirect()->route('pengajar.materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->user_id != auth()->id()) {
            abort(403);
        }

        if ($materi->file_pendukung) {
            Storage::disk('public')->delete($materi->file_pendukung);
        }

        $materi->delete();

        return redirect()->route('pengajar.materi.index')->with('success', 'Materi berhasil dihapus!');
    }

    public function show(Materi $materi)
    {
        if ($materi->user_id != auth()->id()) {
            abort(403);
        }

        $semuaKomentar = $materi->komentar()->with('user')->oldest()->get();
        return view('pengajar.materi.show', compact('materi', 'semuaKomentar'));
    }
}
