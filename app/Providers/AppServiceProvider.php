<?php

namespace App\Providers;

use App\View\Composers\SaasComposer;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        if (! app()->environment(['local', 'testing']) && parse_url((string) config('app.url'), PHP_URL_SCHEME) === 'https') {
            URL::forceScheme('https');
        }

        View::composer('layouts.saas', SaasComposer::class);
        View::composer('layouts.saas-guest', SaasComposer::class);
    }
}
