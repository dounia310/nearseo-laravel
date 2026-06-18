<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    public function handle(Request $request, Closure $next)
    {
        // Récupérer la langue depuis la session, les préférences utilisateur ou le header Accept-Language
        if (auth()->check()) {
            $user = auth()->user();
            $preferences = $user->preferences ?? [];
            $locale = $preferences['language'] ?? session('locale', 'fr');
        } else {
            $locale = session('locale', 'fr');
        }

        app()->setLocale($locale);
        session(['locale' => $locale]);

        return $next($request);
    }
}