<?php

use Illuminate\Support\Facades\Route;

// Import semua controller yang kita butuhkan
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;

// Controller untuk Pengajar
use App\Http\Controllers\Pengajar\MateriController as PengajarMateriController;
use App\Http\Controllers\Pengajar\TugasController as PengajarTugasController;
use App\Http\Controllers\Pengajar\DiskusiController as PengajarDiskusiController;
use App\Http\Controllers\Pengajar\SiswaController as PengajarSiswaController; // <-- Pastikan ini sudah di-import

// Controller untuk Siswa
use App\Http\Controllers\Siswa\KelasController as SiswaKelasController;
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;
use App\Http\Controllers\Siswa\ProgressController as SiswaProgressController;
use App\Http\Controllers\Siswa\DiskusiController as SiswaDiskusiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Publik (Bisa diakses tanpa login)
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/search', SearchController::class)->name('search');


// Grup Rute Terproteksi (Hanya bisa diakses setelah login)
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Rute Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ===================================================================
    // GRUP RUTE KHUSUS UNTUK PENGAJAR
    // ===================================================================
    Route::middleware('role:pengajar')->prefix('pengajar')->name('pengajar.')->group(function () {
        
        Route::resource('materi', PengajarMateriController::class);
        Route::resource('tugas', PengajarTugasController::class);
        Route::post('tugas/nilai/{pengumpulan}', [PengajarTugasController::class, 'nilai'])->name('tugas.nilai');
        Route::get('diskusi', [PengajarDiskusiController::class, 'index'])->name('diskusi.index');
        Route::post('diskusi', [PengajarDiskusiController::class, 'store'])->name('diskusi.store');
        Route::get('siswa', [PengajarSiswaController::class, 'index'])->name('siswa.index');
    });


    // ===================================================================
    // GRUP RUTE KHUSUS UNTUK SISWA
    // ===================================================================
    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
        
        Route::get('kelas', [SiswaKelasController::class, 'index'])->name('kelas.index');
        Route::get('kelas/{materi}', [SiswaKelasController::class, 'show'])->name('kelas.show');

        // --- Rute Tugas Siswa ---
        Route::get('tugas', [SiswaTugasController::class, 'index'])->name('tugas.index');
        Route::get('tugas/{tugas}', [SiswaTugasController::class, 'show'])->name('tugas.show');
        Route::post('tugas/{tugas}', [SiswaTugasController::class, 'submit'])->name('tugas.submit');

        // --- Rute Progress Siswa ---
        Route::get('progress', [SiswaProgressController::class, 'index'])->name('progress.index');
        Route::post('progress', [SiswaProgressController::class, 'store'])->name('progress.store');

        // --- Rute Diskusi Siswa ---
        Route::get('diskusi/{materi}', [SiswaDiskusiController::class, 'show'])->name('diskusi.show');
        Route::post('diskusi', [SiswaDiskusiController::class, 'store'])->name('diskusi.store');
    });

});


// Memuat rute-rute autentikasi
require __DIR__.'/auth.php';
