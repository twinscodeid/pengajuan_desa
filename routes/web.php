<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('HomePage');
})->name('home');

Route::get('/profile', function () {
    return Inertia::render('DashboardUser/Profile');
})->name('profile');
Route::get('/dashboard-user', function () {
    return Inertia::render('DashboardUser/Index');
})->name('dashboard.user');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
