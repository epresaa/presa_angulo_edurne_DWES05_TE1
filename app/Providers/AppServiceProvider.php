<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

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
        //
        $this->app['router']->pushMiddlewareToGroup('web', VerifyCsrfToken::class);
        VerifyCsrfToken::except(['create', 'update/*', 'delete/*']);
    }
}
