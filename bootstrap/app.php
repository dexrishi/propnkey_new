<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Run before routing so redirects work even when no route exists (e.g. /test)
        $middleware->prepend(\App\Http\Middleware\CheckRedirections::class);
        // Must run first: strip /index.php from public URLs (301 to clean path)
        $middleware->prepend(\App\Http\Middleware\RemoveIndexPhpFromUrls::class);
    })
    ->withProviders([
        App\Providers\ConfigServiceProvider::class,
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
