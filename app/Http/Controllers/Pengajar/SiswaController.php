<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar semua siswa.
     */
    public function index()
    {
        $semuaSiswa = User::where('role', 'siswa')->orderBy('name')->paginate(15);
        return view('pengajar.siswa.index', compact('semuaSiswa'));
    }
}
