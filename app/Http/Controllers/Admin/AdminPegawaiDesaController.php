<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class AdminPegawaiDesaController extends Controller
{
    public function index()
    {
        return Inertia::render('DashboardAdmin/Login');
    }

    public function login(AdminLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::guard('pegawai')->user();

        if ($user->role_id == "1") {
            return redirect()->route('dashboard.index.admin')->with('success', 'Selamat datang, ' . $user->name);
        }

        return redirect()->route('home');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('pegawai')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
