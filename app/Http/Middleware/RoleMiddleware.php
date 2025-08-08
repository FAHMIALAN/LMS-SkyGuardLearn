<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$roles  // Menerima satu atau lebih peran (misal: 'pengajar', 'siswa')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek dulu apakah pengguna sudah login.
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Ambil peran dari pengguna yang sedang login.
        $userRole = $request->user()->role;

        // 3. Periksa apakah peran pengguna ada di dalam daftar peran yang diizinkan.
        if (!in_array($userRole, $roles)) {
            // Jika tidak, tolak akses.
            abort(403, 'AKSI TIDAK DIIZINKAN. ANDA TIDAK MEMILIKI HAK AKSES.');
        }

        // 4. Jika peran cocok, izinkan request untuk melanjutkan.
        return $next($request);
    }
}