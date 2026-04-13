<?php

namespace App\Providers;

use App\Listeners\SendVerificationEmailKepalaKeluarga;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register event listener for email verification
        \Illuminate\Support\Facades\Event::listen(
            Registered::class,
            SendVerificationEmailKepalaKeluarga::class,
        );
    }
}
