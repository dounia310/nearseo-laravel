<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOnboardingCompleted
{
    /**
     * Onboarding OPTIONNEL
     * - Redirige UNE FOIS vers /onboarding/business si non complété
     * - L'utilisateur peut cliquer "Plus tard" et continuer
     * - Ne sera plus redirigé ensuite
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Si pas connecté, laisser passer
        if (!$user) {
            return $next($request);
        }

        // Si admin, laisser passer
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Si déjà sur une route d'onboarding, laisser passer
        if ($request->routeIs('onboarding.*')) {
            return $next($request);
        }

        // Si onboarding pas complété ET pas encore proposé
        if (!$user->onboarding_completed && !session()->has('onboarding_proposed')) {
            session()->put('onboarding_proposed', true);
            
            return redirect()->route('onboarding.business')
                ->with('info', 'Complétez votre profil une fois pour de meilleurs résultats.');
        }

        return $next($request);
    }
}