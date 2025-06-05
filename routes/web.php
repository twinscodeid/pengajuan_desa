<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SuratIjinKegiatan\SuratIjinKegiatanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PelaporanMasyarakat\PelaporanMasyarakatController;
use App\Http\Controllers\BantuanSosial\BantuanSosialController;
use App\Http\Controllers\User\UserController;
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
    Route::get('/profile/{id}', [UserController::class, 'getProfileRoleUser'])->name('profile.user');
    Route::patch('/profile-user', [UserController::class, 'update'])->name('profile-user.update');

    // route user send data
    Route::post('/surat-ijin-kegiatan', [SuratIjinKegiatanController::class, 'store'])->name('surat-ijin-kegiatan.store');
    Route::post('/laporan-masyarakat', [PelaporanMasyarakatController::class, 'store'])->name('laporan-masyarakat.store');
    Route::post('/bantuan-sosial', [BantuanSosialController::class, 'store'])->name('bantuan-sosial.store');
});

// route admin
Route::middleware(['auth:pegawai', 'admin.role'])->prefix('admin')->group(function () {

    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard.index.admin');
    Route::get('/layanan-umum', [DashboardController::class, 'layananUmum'])->name('layanan.admin');

    // Route admin surat ijin kegiatan
    Route::get('/surat-ijin-kegiatan/edit/{id}', [DashboardController::class, 'updateSuratIjinKegiatan'])->name('surat-ijin-kegiatan.edit');
    Route::get('/surat-ijin-kegiatan/{id}', [SuratIjinKegiatanController::class, 'show'])->name('surat-ijin-kegiatan.show');
    Route::delete('/surat-ijin-kegiatan/{id}', [SuratIjinKegiatanController::class, 'destroy'])->name('surat-ijin-kegiatan.destroy');
    Route::put('/surat-ijin-kegiatan/{id}', [SuratIjinKegiatanController::class, 'update'])->name('surat-ijin-kegiatan.update');
    Route::post('/surat-ijin-kegiatan/send-email/{id}', [SuratIjinKegiatanController::class, 'sendEmail'])->name('surat-ijin-kegiatan.send-email-kegiatan');

    // Route admin pelaporan masyarakat
    Route::get('/pelaporan-masyarakat/{id}', [PelaporanMasyarakatController::class, 'show'])->name('pelaporan-masyarakat.show');
    Route::delete('/pelaporan-masyarakat/{id}', [PelaporanMasyarakatController::class, 'destroy'])->name('pelaporan-masyarakat.destroy');
    Route::post('/pelaporan-masyarakat/send-email/{id}', [PelaporanMasyarakatController::class, 'sendEmail'])->name('pelaporan-masyarakat.send-email-pelaporan');

    // Route admin bantuan sosial
    Route::get('/bantuan-sosial/edit/{id}', [DashboardController::class, 'updateBantuanSosial'])->name('bantuan-sosial.edit');
    Route::get('/bantuan-sosial/{id}', [BantuanSosialController::class, 'show'])->name('bantuan-sosial.show');
    Route::delete('/bantuan-sosial/{id}', [BantuanSosialController::class, 'destroy'])->name('bantuan-sosial.destroy');
    Route::put('/bantuan-sosial/{id}', [BantuanSosialController::class, 'update'])->name('bantuan-sosial.update');
    Route::post('/bantuan-sosial/send-email/{id}', [BantuanSosialController::class, 'sendEmail'])->name('bantuan-sosial.send-email-bantuan');

    // Private image
    Route::get('/private-image/{filename}', [FileController::class, 'showPrivateImage'])->name('private.image');
});



require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
