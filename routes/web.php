<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SuratIjinKegiatan\SuratIjinKegiatanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FileController;

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
});

// route admin
Route::middleware(['auth', 'admin.role'])->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard.index.admin');
    Route::get('/layanan-umum', [DashboardController::class, 'layananUmum'])->name('layanan.admin');
    Route::get('/surat-ijin-kegiatan/{id}', [DashboardController::class, 'showSuratIjinKegiatan'])->name('surat-ijin-kegiatan.show');
    Route::delete('/surat-ijin-destroy/{id}', [DashboardController::class, 'deleteSuratIjinKegiatan'])->name('surat-ijin-kegiatan.destroy');
    Route::get('/private-image/{filename}', [FileController::class, 'showPrivateImage'])->name('private.image');
    Route::post('/send-email/{id}', [SuratIjinKegiatanController::class, 'sendEmail'])->name('surat-ijin-kegiatan.send-email');
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
