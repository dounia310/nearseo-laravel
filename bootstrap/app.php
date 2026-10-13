<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Middleware\Localization;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ─── Middlewares API ──────────────────────────────
        // Ajout de CORS et Sanctum pour les requêtes API
        $middleware->api(prepend: [
            HandleCors::class,
            EnsureFrontendRequestsAreStateful::class,
        ]);

        // ─── Middlewares Web ──────────────────────────────
        // On AJOUTE Localization au groupe web existant
        // (append = ne remplace pas les middlewares par défaut,
        //  notamment StartSession qui gère le cookie de session)
        $middleware->web(append: [
            Localization::class,
        ]);

        // ─── Aliases ──────────────────────────────────────
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'onboarding' => \App\Http\Middleware\EnsureOnboardingCompleted::class,
                    ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();