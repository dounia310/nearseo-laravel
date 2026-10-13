<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    /**
     * Étape 2 : Informations du commerce
     */
    public function business()
    {
        return view('onboarding.business');
    }

    /**
     * Sauvegarde des informations du commerce
     * Validation conditionnelle selon le mode (local / online)
     */
    public function saveBusiness(Request $request)
    {
        // ═══ Règles de base ═══
        $rules = [
            'business_name' => 'required|string|max:255',
            'business_category' => 'required|string|max:100',
            'business_country' => 'required|string|max:100',
            'business_mode' => 'required|in:local,online',
        ];

        // ═══ Mode LOCAL : adresse + ville obligatoires ═══
        if ($request->input('business_mode') === 'local') {
            $rules['business_address'] = 'required|string|max:255';
            $rules['business_city'] = 'required|string|max:100';
            $rules['business_district'] = 'nullable|string|max:100';
            $rules['business_website'] = 'nullable|url|max:255';
        }

        // ═══ Mode ONLINE : site web obligatoire ═══
        if ($request->input('business_mode') === 'online') {
            $rules['business_website'] = 'required|url|max:255';
            $rules['business_address'] = 'nullable|string|max:255';
            $rules['business_city'] = 'nullable|string|max:100';
            $rules['business_district'] = 'nullable|string|max:100';
        }

        $validated = $request->validate($rules);

        Auth::user()->update($validated);

        return redirect()->route('onboarding.preferences');
    }

    /**
     * Étape 3 : Préférences
     */
    public function preferences()
    {
        return view('onboarding.preferences');
    }

    /**
     * Sauvegarde des préférences
     */
    public function savePreferences(Request $request)
    {
        $validated = $request->validate([
            'preferred_language' => 'required|in:fr,en,ar',
            'preferred_tone' => 'required|in:professional,expert,storytelling',
            'preferred_format' => 'required|in:short,medium,long',
            'preferred_goals' => 'nullable|array',
        ]);

        $currentPreferences = Auth::user()->preferences ?? [];

        $newPreferences = array_merge($currentPreferences, [
            'language' => $validated['preferred_language'],
            'preferred_tone' => $validated['preferred_tone'],
            'preferred_format' => $validated['preferred_format'],
            'preferred_goals' => $validated['preferred_goals'] ?? [],
        ]);

        Auth::user()->update([
            'preferences' => $newPreferences,
            'onboarding_completed' => true,
        ]);

        return redirect()->route('dashboard')
            ->with('success', '🎉 Votre profil est prêt !');
    }
}