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
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
        
        // Trust all proxies for Codespaces
        $middleware->trustProxies(
            at: '*',
            headers: \Symfony\Component\HttpFoundation\Request::HEADER_X_FORWARDED_FOR |
                     \Symfony\Component\HttpFoundation\Request::HEADER_X_FORWARDED_HOST |
                     \Symfony\Component\HttpFoundation\Request::HEADER_X_FORWARDED_PORT |
                     \Symfony\Component\HttpFoundation\Request::HEADER_X_FORWARDED_PROTO
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
