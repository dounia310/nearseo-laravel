<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Afficher la liste des utilisateurs
     */
    public function users()
    {
        $users = User::withCount('articles')
            ->withSum('articles', 'views')
            ->withAvg('articles', 'seo_score')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.users', compact('users'));
    }

    /**
     * Afficher les détails d'un utilisateur (JSON)
     */
    public function userDetails(User $user)
    {
        // Si la requête demande du JSON
        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'articles_count' => $user->articles()->count(),
                    'articles' => $user->articles()->select('id', 'title', 'status', 'views', 'created_at')->get(),
                    'last_login' => $user->last_login_at ?? null,
                    'is_active' => $user->is_active ?? true,
                ]
            ]);
        }

        // Sinon, retourner la vue (si vous voulez garder la vue)
        return view('admin.users.details', compact('user'));
    }

    /**
     * Changer le rôle d'un utilisateur
     */
    public function toggleRole(User $user)
    {
        if ($user->id === auth()->id()) {
            return response()->json(['error' => 'Vous ne pouvez pas modifier votre propre rôle'], 422);
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return response()->json(['success' => true, 'new_role' => $user->role]);
    }

    /**
     * Supprimer un utilisateur
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return response()->json(['error' => 'Vous ne pouvez pas supprimer votre propre compte'], 422);
        }

        if ($user->role === 'admin') {
            return response()->json(['error' => 'Impossible de supprimer un administrateur'], 422);
        }

        $user->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Créer un nouvel utilisateur
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']
        ]);

        return response()->json([
            'success' => true,
            'user' => $user,
            'message' => 'Utilisateur créé avec succès'
        ]);
    }

    /**
     * Exporter les utilisateurs en CSV
     */
    public function exportUsers()
    {
        $users = User::withCount('articles')->get();

        $filename = 'utilisateurs_' . date('Y-m-d') . '.csv';
        $handle = fopen('php://temp', 'w');

        fputcsv($handle, ['ID', 'Nom', 'Email', 'Rôle', 'Articles', 'Date inscription']);

        foreach ($users as $user) {
            fputcsv($handle, [
                $user->id,
                $user->name,
                $user->email,
                $user->role,
                $user->articles_count ?? 0,
                $user->created_at->format('d/m/Y')
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Page d'analytique
     */
    public function analytics()
    {
        $stats = [
            'total_users' => User::count(),
            'total_articles' => Article::count(),
            'total_views' => Article::sum('views'),
            'avg_seo_score' => round(Article::avg('seo_score') ?? 0),
        ];
        return view('admin.analytics', compact('stats'));
    }

    /**
     * Page de configuration
     */
    public function config()
    {
        return view('admin.config');
    }

    /**
     * Sauvegarder les paramètres admin
     */
    public function updateSettings(Request $request)
    {
        $settings = [
            'platform_name' => $request->platform_name,
            'contact_email' => $request->contact_email,
            'default_language' => $request->default_language,
            'languages' => $request->languages,
            'plan_limits' => $request->plan_limits,
            'translations' => $request->translations,
        ];

        File::put(storage_path('app/admin_settings.json'), json_encode($settings, JSON_PRETTY_PRINT));

        return response()->json(['success' => true]);
    }

    /**
     * Statistiques globales détaillées
     */
    public function statistics()
    {
        $stats = [
            'total_users' => User::count(),
            'total_articles' => Article::count(),
            'total_views' => Article::sum('views'),
            'avg_seo_score' => round(Article::avg('seo_score') ?? 0),
            'published_articles' => Article::where('status', 'published')->count(),
            'draft_articles' => Article::where('status', 'draft')->count(),
        ];

        // Articles par ville
        // `address` contient souvent l'adresse complète, donc on regroupe sur le champ `city`.
        // Fallback: si `city` est NULL, on ignore (ancien fallback sur address n'était pas souhaité).
        $articlesByCity = Article::where('status', 'published')
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->select('city', DB::raw('count(*) as count'))
            ->groupBy('city')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();




        // Utilisateurs par mois
        $usersByMonth = User::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(6)
            ->get();

        // Articles par mois
        $articlesByMonth = Article::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(6)
            ->get();

        return view('admin.statistics', compact('stats', 'articlesByCity', 'usersByMonth', 'articlesByMonth'));
    }
}
