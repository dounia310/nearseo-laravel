<?php

namespace App\Providers;

use App\Models\Article;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Les Policies du modèle.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];

    /**
     * Enregistrer les services d'authentification.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate supplémentaire pour l'accès admin
        Gate::define('access-admin', function ($user) {
            return $user->role === 'admin';
        });
    }
}