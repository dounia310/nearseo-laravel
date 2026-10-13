<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ContentCleanerService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // ✅ Enregistrer le service de nettoyage
        $this->app->singleton(ContentCleanerService::class, function ($app) {
            return new ContentCleanerService();
        });
    }

    public function boot(): void
    {
        // ✅ Une seule méthode boot() !
    }
}