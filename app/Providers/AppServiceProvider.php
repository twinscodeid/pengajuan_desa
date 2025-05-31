<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\SuratIjinKegiatanRepository;
use App\Repositories\Interfaces\SuratIjinKegiatanRepositoryInterface;
use App\Repositories\Eloquent\PelaporanMasyarakatRepository;
use App\Repositories\Interfaces\PelaporanMasyarakatRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the SuratIjinKegiatanRepositoryInterface to its implementation
        $this->app->bind(SuratIjinKegiatanRepositoryInterface::class, SuratIjinKegiatanRepository::class);
        // Register the PelaporanMasyarakatRepositoryInterface to its implementation
        $this->app->bind(PelaporanMasyarakatRepositoryInterface::class, PelaporanMasyarakatRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
