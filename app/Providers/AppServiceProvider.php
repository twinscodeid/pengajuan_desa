<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\SuratIjinKegiatanRepository;
use App\Repositories\Interfaces\SuratIjinKegiatanRepositoryInterface;
use App\Repositories\Eloquent\PelaporanMasyarakatRepository;
use App\Repositories\Interfaces\PelaporanMasyarakatRepositoryInterface;
use App\Repositories\Eloquent\BantuanSosialRepository;
use App\Repositories\Interfaces\BantuanSosialRepositoryInterface;


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
        // Register the BantuanSosialRepositoryInterface to its implementation
        $this->app->bind(BantuanSosialRepositoryInterface::class, BantuanSosialRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
