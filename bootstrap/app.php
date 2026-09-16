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
        // Guarantee that a session store is attached before the router and
        // CSRF middleware run. The shared-hosting runtime was loading routes
        // without StartSession in their effective middleware stack.
        $middleware->append(\Illuminate\Session\Middleware\StartSession::class);

        // The hosting proxy accepts a direct PHP cookie header. Keep this
        // session cookie raw so Laravel can read the same session ID back.
        $middleware->encryptCookies(except: [
            'melkalijenab_session',
        ]);

        $middleware->alias([
            'check.auth' => \App\Http\Middleware\CheckUserOrAdminLogin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
