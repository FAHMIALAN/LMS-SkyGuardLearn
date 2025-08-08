<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Http\Requests\TugasRequest;
use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        $semuaTugas = Tugas::where('user_id', auth()->id())
                           ->withCount('pengumpulan')
                           ->latest()
                           ->paginate(10);
        
        $totalSiswa = User::where('role', 'siswa')->count();

        return view('pengajar.tugas.index', compact('semuaTugas', 'totalSiswa'));
    }

    public function create()
    {
        return view('pengajar.tugas.create');
    }

    public function store(TugasRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('file_soal')) {
            $path = $request->file('file_soal')->store('tugas/soal', 'public');
            $validated['file_soal'] = $path;
        }
        $validated['user_id'] = auth()->id();
        Tugas::create($validated);
        return redirect()->route('pengajar.tugas.index')->with('success', 'Tugas baru berhasil dibuat!');
    }

    public function show($id)
    {
        $tugas = Tugas::where('user_id', auth()->id())->findOrFail($id);
        $pengumpulan = $tugas->pengumpulan()->with('user')->latest()->paginate(15);
        return view('pengajar.tugas.penilaian', compact('tugas', 'pengumpulan'));
    }

    public function edit($id)
    {

        $tugas = Tugas::where('user_id', auth()->id())->findOrFail($id);
        return view('pengajar.tugas.edit', compact('tugas'));
    }

    public function update(TugasRequest $request, Tugas $tugas)
    {
        if ($tugas->user_id != auth()->id()) {
            abort(403);
        }

        $validated = $request->validated();

        if ($request->hasFile('file_soal')) {
            if ($tugas->file_soal) {
                Storage::disk('public')->delete($tugas->file_soal);
            }
            $path = $request->file('file_soal')->store('tugas/soal', 'public');
            $validated['file_soal'] = $path;
        }

        $tugas->update($validated);

        return redirect()->route('pengajar.tugas.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy(Tugas $tugas)
    {
        if ($tugas->user_id != auth()->id()) {
            abort(403);
        }

        if ($tugas->file_soal) {
            Storage::disk('public')->delete($tugas->file_soal);
        }

        $tugas->delete();

        return redirect()->route('pengajar.tugas.index')->with('success', 'Tugas berhasil dihapus!');
    }

    public function nilai(Request $request, PengumpulanTugas $pengumpulan)
    {
        $request->merge(['nilai' => str_replace(',', '.', $request->input('nilai'))]);
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        if ($pengumpulan->tugas->user_id != auth()->id()) {
            abort(403, 'AKSES DITOLAK');
        }

        $pengumpulan->update(['nilai' => $request->nilai]);

        return redirect()->back()->with('success', 'Nilai untuk siswa ' . $pengumpulan->user->name . ' berhasil disimpan.');
    }
}
