<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SuratIjinKegiatan\SuratIjinKegiatanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PelaporanMasyarakat\PelaporanMasyarakatController;
use App\Http\Controllers\FileController;
use App\Http\Requests\SuratIjinKegiatan;

Route::get('/', function () {
    return Inertia::render('HomePage');
})->name('home');

// route user
Route::middleware(['auth', 'user.role'])->group(function () {
    Route::get('/dashboard-user', function () {
        return Inertia::render('DashboardUser/Index');
    })->name('dashboard.index.user');
    Route::get('/profile', function () {
        return Inertia::render('DashboardUser/Profile');
    })->name('profile.user');

    // route user send data
    Route::post('/surat-ijin-kegiatan', [SuratIjinKegiatanController::class, 'store'])->name('surat-ijin-kegiatan.store');
    Route::post('/laporan-masyarakat', [PelaporanMasyarakatController::class, 'store'])->name('laporan-masyarakat.store');
});

// route admin
Route::middleware(['auth', 'admin.role'])->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard.index.admin');
    Route::get('/layanan-umum', [DashboardController::class, 'layananUmum'])->name('layanan.admin');
    // route admin surat ijin kegiatan
    Route::get('/surat-ijin-kegiatan-edit/{id}', [DashboardController::class, 'updateSuratIjinKegiatan'])->name('surat-ijin-kegiatan.edit');
    Route::get('/surat-ijin-kegiatan/{id}', [SuratIjinKegiatanController::class, 'show'])->name('surat-ijin-kegiatan.show');
    Route::delete('/surat-ijin-destroy/{id}', [SuratIjinKegiatanController::class, 'destroy'])->name('surat-ijin-kegiatan.destroy');
    Route::put('/surat-ijin-kegiatan-update/{id}', [SuratIjinKegiatanController::class, 'update'])->name('surat-ijin-kegiatan.update');
    Route::post('/send-email/{id}', [SuratIjinKegiatanController::class, 'sendEmail'])->name('surat-ijin-kegiatan.send-email');
    // route admin pelaporan masyarakat
    Route::get('/pelaporan-masyarakat/{id}', [PelaporanMasyarakatController::class, 'show'])->name('pelaporan-masyarakat.show');
    Route::delete('/pelaporan-masyarakat/{id}', [PelaporanMasyarakatController::class, 'destroy'])->name('pelaporan-masyarakat.destroy');
    Route::post('/send-email/{id}', [PelaporanMasyarakatController::class, 'sendEmail'])->name('pelaporan-masyarakat.send-email');
    Route::get('/private-image/{filename}', [FileController::class, 'showPrivateImage'])->name('private.image');
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
