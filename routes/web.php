<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Models\User;
use App\Models\Article;

// Landing page (publique)
Route::get('/', function () {
    return view('landing.index');
})->name('landing');

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    // Dashboard
    Route::get('/dashboard', function () {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role === 'admin') {
            $stats = [
                'total_users' => User::count(),
                'total_articles' => Article::count(),
                'total_views' => Article::sum('views'),
                'avg_seo_score' => round(Article::avg('seo_score') ?? 0),
                'user_growth' => 12,
                'published_this_month' => Article::whereMonth('created_at', now()->month)->where('status', 'published')->count(),
                'unique_views' => Article::distinct('user_id')->count('views'),
                'local_visibility' => 82,
            ];
            $topArticles = Article::with('user')->orderBy('views', 'desc')->limit(5)->get();
        } else {
            $stats = [
                'user_articles' => $user->articles()->count(),
                'user_views' => $user->articles()->sum('views'),
                'user_avg_seo' => round($user->articles()->avg('seo_score') ?? 0),
                'user_published_month' => $user->articles()->whereMonth('created_at', now()->month)->where('status', 'published')->count(),
                'user_views_growth' => 15,
                'local_visibility' => 82,
                'total_articles' => $user->articles()->count(),
                'total_views' => $user->articles()->sum('views'),
                'avg_seo_score' => round($user->articles()->avg('seo_score') ?? 0),
            ];
            $topArticles = $user->articles()->orderBy('views', 'desc')->limit(5)->get();
        }

        $weeklyViews = [];
        $monthlyViews = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            if ($user->role === 'admin') {
                $weeklyViews[] = Article::whereDate('created_at', $date)->sum('views');
            } else {
                $weeklyViews[] = $user->articles()->whereDate('created_at', $date)->sum('views');
            }
        }

        for ($i = 3; $i >= 0; $i--) {
            $start = now()->subWeeks($i)->startOfWeek();
            $end = now()->subWeeks($i)->endOfWeek();
            if ($user->role === 'admin') {
                $monthlyViews[] = Article::whereBetween('created_at', [$start, $end])->sum('views');
            } else {
                $monthlyViews[] = $user->articles()->whereBetween('created_at', [$start, $end])->sum('views');
            }
        }

        return view('dashboard.index', compact('stats', 'topArticles', 'weeklyViews', 'monthlyViews'));
    })->name('dashboard');

    // Gestion des articles
    Route::resource('articles', ArticleController::class);

    // Générateur IA
    Route::prefix('ai')->name('ai.')->group(function () {
        Route::get('create', [AIController::class, 'create'])->name('create');
        Route::post('generate', [AIController::class, 'generate'])->name('generate');
        Route::post('rewrite', [AIController::class, 'rewrite'])->name('rewrite');
        Route::post('optimize', [AIController::class, 'optimize'])->name('optimize');
        Route::get('history', [AIController::class, 'history'])->name('history');
    });

    // Géolocalisation
    Route::prefix('geo')->name('geo.')->group(function () {
        Route::get('/', [GeoController::class, 'index'])->name('index');
        Route::get('nearby', [GeoController::class, 'nearbyArticles'])->name('nearby');
        Route::get('search', [GeoController::class, 'searchLocation'])->name('search');
        Route::post('address/{article}', [GeoController::class, 'updateAddress'])->name('update-address');
    });

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('mark-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::post('{notification}/read', [NotificationController::class, 'markAsRead'])->name('mark-read');
    });

    // Profil utilisateur
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::post('avatar', [ProfileController::class, 'updateAvatar'])->name('avatar');
        Route::get('stats', [ProfileController::class, 'stats'])->name('stats');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Paramètres
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::put('/', [SettingsController::class, 'update'])->name('update');
        Route::post('password', [SettingsController::class, 'updatePassword'])->name('password');
    });
});

// Routes admin (protégées par middleware admin) - VUES
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // ⭐ Vue pour gérer les utilisateurs
    Route::get('/users', function () {
        $users = User::paginate(15);
        return view('admin.users', compact('users'));
    })->name('users');
    
    // ⭐ Vue pour l'analytique
    Route::get('/analytics', function () {
        $stats = [
            'total_users' => User::count(),
            'total_articles' => Article::count(),
            'total_views' => Article::sum('views'),
            'avg_seo_score' => round(Article::avg('seo_score') ?? 0),
        ];
        return view('admin.analytics', compact('stats'));
    })->name('analytics');
    
    // ⭐ Vue pour les paramètres admin
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
    
    // ⭐ Supprimer un utilisateur (POST)
    Route::delete('/users/{user}', function ($id) {
        $user = User::findOrFail($id);
        if ($user->role !== 'admin') {
            $user->delete();
        }
        return redirect()->back()->with('success', 'Utilisateur supprimé');
    })->name('users.destroy');
});

// Route API pour sauvegarder les paramètres admin
Route::post('/admin/settings/update', function (Request $request) {
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
})->name('admin.settings.update');

// Inclure les routes d'authentification de Breeze
require __DIR__ . '/auth.php';