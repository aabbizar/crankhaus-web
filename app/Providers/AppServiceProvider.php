<?php

namespace App\Providers;

use App\Http\Responses\FilamentLogoutResponse;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind custom Filament logout response agar Sign Out admin
        // mengalihkan ke halaman utama katalog (/) bukan /admin/login
        $this->app->bind(LogoutResponseContract::class, FilamentLogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
