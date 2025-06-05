<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pertama, cek apakah ada pengguna yang login dengan guard 'pegawai'
        if (!Auth::guard('pegawai')->check()) {
            return redirect('admin/login-pegawai-desa')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
