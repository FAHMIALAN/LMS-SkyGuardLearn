<?php

namespace App\Http\Middleware;

// Hapus 'use App\Providers\RouteServiceProvider;' jika ada
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Langsung arahkan ke rute bernama 'dashboard'
                // Ini adalah perbaikan untuk error 'RouteServiceProvider not found'.
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
