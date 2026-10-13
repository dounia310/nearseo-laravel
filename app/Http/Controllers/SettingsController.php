<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    /**
     * Afficher la page des paramètres
     */
    public function index()
    {
        $user = Auth::user();

        // Récupérer les préférences normalisées
        $preferences = $this->getNormalizedPreferences($user);

        // Si l'utilisateur est admin, charger les données supplémentaires
        if ($user->role === 'admin') {
            $totalUsers = User::count();
            $totalArticles = Article::count();
            $totalViews = Article::sum('views');
            $avgSeoScore = round(Article::avg('seo_score') ?? 0);

            $articlesByCity = Article::where('status', 'published')
                ->whereNotNull('address')
                ->select('address', DB::raw('count(*) as count'))
                ->groupBy('address')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->get();

            $users = User::withCount('articles')->paginate(10);

            return view('dashboard.settings', compact('preferences', 'totalUsers', 'totalArticles', 'totalViews', 'avgSeoScore', 'articlesByCity', 'users'));
        }

        return view('dashboard.settings', compact('preferences'));
    }

    /**
     * Mettre à jour les préférences générales
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $preferences = $this->getNormalizedPreferences($user);

        // ✅ VALIDATION ÉTENDUE (profil + commerce + préférences)
        $validated = $request->validate([
            // Préférences générales
            'language' => 'nullable|in:fr,en,ar,es',
            'theme' => 'nullable|in:light,dark,system',
            'email_notifications' => 'nullable|boolean',
            'push_notifications' => 'nullable|boolean',
            'weekly_report' => 'nullable|boolean',
            'security_alerts' => 'nullable|boolean',
        ]);

        // Filtrer les valeurs null (préférences)
        $validated = array_filter($validated, function($value) {
            return !is_null($value);
        });

        // ✅ Si le formulaire contient des champs de PROFIL, les traiter séparément
        if ($request->has('name') || $request->has('email')) {
            $profileValidated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'location' => 'nullable|string|max:255',
                'bio' => 'nullable|string|max:500',
            ]);

            $user->update($profileValidated);
        }

        // ✅ Si le formulaire contient des champs COMMERCE, les traiter
        if ($request->has('business_name') || $request->has('business_mode')) {
            $businessValidated = $request->validate([
                'business_name' => 'nullable|string|max:255',
                'business_category' => 'nullable|string|max:100',
                'business_address' => 'nullable|string|max:255',
                'business_city' => 'nullable|string|max:100',
                'business_district' => 'nullable|string|max:100',
                'business_country' => 'nullable|string|max:100',
                'business_website' => 'nullable|url|max:255',
                'business_mode' => 'nullable|in:local,online',
            ]);

            $user->update($businessValidated);
        }

        // Mettre à jour les préférences JSON
        if (!empty($validated)) {
            $preferences = array_merge($preferences, $validated);
            $this->savePreferences($user, $preferences);

            // Si la langue change, la mettre en session
            if (isset($validated['language'])) {
                session(['locale' => $validated['language']]);
                app()->setLocale($validated['language']);
            }
        }

        return redirect()->back()->with('success', '✅ Profil et préférences mis à jour avec succès !');
    }

    /**
     * Changer le mot de passe
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = Auth::user();

        // Vérifier l'ancien mot de passe
        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Mot de passe actuel incorrect',
                'errors' => ['current_password' => ['Le mot de passe actuel est incorrect.']]
            ], 422);
        }

        // Mettre à jour le mot de passe
        $user->password = Hash::make($validated['password']);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Mot de passe modifié avec succès !'
        ]);
    }

    /**
     * Mettre à jour le thème (via AJAX)
     */
    public function updateTheme(Request $request)
    {
        $request->validate([
            'theme' => 'required|in:light,dark,system'
        ]);

        $user = Auth::user();
        $preferences = $this->getNormalizedPreferences($user);
        $preferences['theme'] = $request->theme;
        $this->savePreferences($user, $preferences);

        return response()->json(['success' => true]);
    }

    /**
     * Mettre à jour la langue (via AJAX)
     */
    public function updateLanguage(Request $request)
    {
        $request->validate([
            'language' => 'required|in:fr,en,ar,es'
        ]);

        $user = Auth::user();
        $preferences = $this->getNormalizedPreferences($user);
        $preferences['language'] = $request->language;
        $this->savePreferences($user, $preferences);

        // Mettre la langue en session pour les traductions
        session(['locale' => $request->language]);
        app()->setLocale($request->language);

        return response()->json(['success' => true]);
    }

    /**
     * Mettre à jour les préférences (version alternative avec JSON)
     */
    public function updatePreferences(Request $request)
    {
        $request->validate([
            'language' => 'nullable|in:fr,en,ar,es',
            'theme' => 'nullable|in:light,dark,system',
            'email_notifications' => 'nullable|boolean',
            'push_notifications' => 'nullable|boolean',
        ]);

        $user = Auth::user();
        $preferences = $this->getNormalizedPreferences($user);

        if ($request->has('language')) {
            $preferences['language'] = $request->language;
        }
        if ($request->has('theme')) {
            $preferences['theme'] = $request->theme;
        }
        if ($request->has('email_notifications')) {
            $preferences['email_notifications'] = $request->boolean('email_notifications');
        }
        if ($request->has('push_notifications')) {
            $preferences['push_notifications'] = $request->boolean('push_notifications');
        }

        $this->savePreferences($user, $preferences);

        if ($request->has('language')) {
            session(['locale' => $request->language]);
            app()->setLocale($request->language);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'preferences' => $preferences
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Préférences mises à jour avec succès !');
    }

    /**
     * Normaliser les préférences utilisateur
     */
    private function getNormalizedPreferences($user)
    {
        $preferences = $user->preferences;

        if (is_null($preferences)) {
            return [
                'language' => 'fr',
                'theme' => 'light',
                'email_notifications' => true,
                'push_notifications' => true,
            ];
        }

        if (is_string($preferences)) {
            $decoded = json_decode($preferences, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $this->mergeWithDefaults($decoded);
            }
            return [
                'language' => 'fr',
                'theme' => 'light',
                'email_notifications' => true,
                'push_notifications' => true,
            ];
        }

        if (is_array($preferences)) {
            return $this->mergeWithDefaults($preferences);
        }

        return [
            'language' => 'fr',
            'theme' => 'light',
            'email_notifications' => true,
            'push_notifications' => true,
        ];
    }

    /**
     * Fusionner les préférences avec les valeurs par défaut
     */
    private function mergeWithDefaults($preferences)
    {
        $defaults = [
            'language' => 'fr',
            'theme' => 'light',
            'email_notifications' => true,
            'push_notifications' => true,
        ];

        foreach ($defaults as $key => $value) {
            if (!isset($preferences[$key])) {
                $preferences[$key] = $value;
            }
        }

        return $preferences;
    }

    /**
     * Sauvegarder les préférences de manière sécurisée
     */
    private function savePreferences($user, $preferences)
    {
        if (!is_array($preferences)) {
            $preferences = [];
        }

        if (isset($preferences['email_notifications'])) {
            $preferences['email_notifications'] = (bool) $preferences['email_notifications'];
        }
        if (isset($preferences['push_notifications'])) {
            $preferences['push_notifications'] = (bool) $preferences['push_notifications'];
        }

        $user->preferences = $preferences;
        $user->save();
    }
}