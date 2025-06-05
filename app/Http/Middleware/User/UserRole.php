<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah ada pengguna yang login dengan guard 'web'
        if (Auth::guard('web')->check()) {
            // 2. Jika ya, baru ambil objek user dan cek role_id-nya
            if (Auth::guard('web')->user()->role_id === 2) {
                return $next($request); // Lanjutkan permintaan
            }
        }

        // 3. Jika tidak login atau role_id bukan 2, arahkan kembali
        return redirect('/')->with('error', 'Akses ditolak!');
    }
}
