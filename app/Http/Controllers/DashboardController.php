<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Tugas;
use App\Models\User;
use App\Models\Komentar; 
use App\Models\PengumpulanTugas; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'pengajar') {
            $totalMateri = Materi::where('user_id', $user->id)->count();
            $totalTugas = Tugas::where('user_id', $user->id)->count();
            $totalSiswa = User::where('role', 'siswa')->count();
            
            // === TAMBAHKAN LOGIKA INI ===
            // Ambil 5 komentar terakhir dari semua materi milik pengajar
            $aktivitasDiskusi = Komentar::whereIn('materi_id', function ($query) use ($user) {
                $query->select('id')->from('materi')->where('user_id', $user->id);
            })->with(['user', 'materi'])->latest()->take(5)->get();

            // Ambil 5 pengumpulan tugas terakhir dari semua tugas milik pengajar
            $aktivitasTugas = PengumpulanTugas::whereIn('tugas_id', function ($query) use ($user) {
                $query->select('id')->from('tugas')->where('user_id', $user->id);
            })->with(['user', 'tugas'])->latest()->take(5)->get();

            // Pastikan nama view-nya benar (dashboard.pengajar atau dashboard-pengajar)
            return view('dashboard.pengajar', compact(
                'totalMateri', 
                'totalSiswa', 
                'totalTugas', 
                'aktivitasDiskusi', 
                'aktivitasTugas'    
            ));
        }

        if ($user->role === 'siswa') {
            $daftarMateri = Materi::latest()->paginate(5, ['*'], 'materi');
            $daftarTugas = Tugas::latest()->paginate(5, ['*'], 'tugas');

            // Pastikan nama view-nya benar (dashboard.siswa atau dashboard-siswa)
            return view('dashboard.siswa', compact('daftarMateri', 'daftarTugas'));
        }

        return redirect('/');
    }
}
