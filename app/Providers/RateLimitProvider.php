<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class RateLimitProvider extends ServiceProvider
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
        /*
            rate limit general para los recurso de 60 peticiones por minuto, 
            registra las peticiones con el user_id, pero tambien tiene un fallback para guardar la ip de las peticiones
        */
        RateLimiter::for('general-rate', fn(Request $request) => Limit::perMinute(60)->by($request->user()->id ?: $request->ip()));
    }
}
