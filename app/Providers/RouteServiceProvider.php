<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Laravel\Fortify\Events\Login;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Override default login response
        // \Illuminate\Support\Facades\Event::listen(
        //     function ($event) {
        //         $user = $event->user;

        //         if ($user->role === 'admin') {
        //             session(['url.intended' => route('dashboard.index.admin')]);
        //         } elseif ($user->role === 'user') {
        //             session(['url.intended' => route('dashboard.index.user')]);
        //         }
        //     }
        // );
    }
}
