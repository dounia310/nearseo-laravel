<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TrendController;
use App\Http\Controllers\BusinessTrendController;
use App\Http\Controllers\HelpController;
use App\Models\User;
use App\Models\Article;

// =============================================
// LANDING PAGE (publique)
// =============================================
Route::get('/', function () {
    $articles = Article::where('status', 'published')
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();
    
    return view('landing.index', compact('articles'));
})->name('landing');

// =============================================
// BLOG PUBLIC (accessible sans connexion)
// =============================================
Route::get('/blog', [ArticleController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [ArticleController::class, 'showBlog'])->name('blog.show');

// Blog utilisateur (pour les pages personnalisées)
Route::get('/blog/user/{slug}', [BlogController::class, 'userBlog'])->name('blog.user');
Route::get('/blog/user/{slug}/{articleSlug}', [BlogController::class, 'userArticle'])->name('blog.user.article');

// =============================================
// ROUTES AUTHENTIFIEES (utilisateur connecté)
// =============================================
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
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            if ($user->role === 'admin') {
                $weeklyViews[] = Article::whereDate('created_at', $date)->sum('views');
            } else {
                $weeklyViews[] = $user->articles()->whereDate('created_at', $date)->sum('views');
            }
        }

        $monthlyViews = [];
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

    // =============================================
    // GESTION DES ARTICLES
    // =============================================
    Route::resource('articles', ArticleController::class);

    // Routes supplémentaires pour les articles
    Route::post('/articles/{article}/upload-image', [ArticleController::class, 'uploadImage'])->name('articles.upload-image');
    Route::post('/articles/{article}/remove-image', [ArticleController::class, 'removeImage'])->name('articles.remove-image');
    Route::post('/articles/{article}/upload-editor-image', [ArticleController::class, 'uploadEditorImage'])->name('articles.upload-editor-image');

    // =============================================
    // GÉNÉRATEUR IA
    // =============================================
    Route::prefix('ai')->name('ai.')->group(function () {
        Route::get('create', [AIController::class, 'create'])->name('create');
        Route::post('generate', [AIController::class, 'generate'])->name('generate');
        Route::post('rewrite', [AIController::class, 'rewrite'])->name('rewrite');
        Route::post('optimize', [AIController::class, 'optimize'])->name('optimize');
        Route::get('history', [AIController::class, 'history'])->name('history');
        Route::get('preview', [AIController::class, 'preview'])->name('preview');
    });

    // =============================================
    // TENDANCES (TRENDS)
    // =============================================
    Route::get('/trends', [TrendController::class, 'index'])->name('trends.index');
    Route::get('/api/trends/suggestions', [TrendController::class, 'getSuggestions'])->name('api.trends.suggestions');
    Route::post('/trends/update-business', [BusinessTrendController::class, 'updateBusinessType'])->name('trends.update-business');

    // Suggestions par secteur (Business Trends)
    Route::get('/trends/business', [BusinessTrendController::class, 'index'])->name('trends.business');
    Route::get('/api/trends/business/suggestions', [BusinessTrendController::class, 'getSuggestions'])->name('api.trends.business');

    // =============================================
    // GÉOLOCALISATION
    // =============================================
    Route::prefix('geo')->name('geo.')->group(function () {
        Route::get('/', [GeoController::class, 'index'])->name('index');
        Route::get('nearby', [GeoController::class, 'nearbyArticles'])->name('nearby');
        Route::get('search', [GeoController::class, 'searchLocation'])->name('search');
        Route::post('address/{article}', [GeoController::class, 'updateAddress'])->name('update-address');
    });

    // =============================================
    // NOTIFICATIONS
    // =============================================
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('mark-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::post('{notification}/read', [NotificationController::class, 'markAsRead'])->name('mark-read');
    });

    // =============================================
    // PROFIL UTILISATEUR (Édition)
    // =============================================
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/edit', [ProfileController::class, 'update'])->name('update');
        Route::post('/avatar', [ProfileController::class, 'updateAvatar'])->name('avatar');
        Route::get('/stats', [ProfileController::class, 'stats'])->name('stats');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('destroy');
        
        Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password');
    });

    // Redirection: /profile vers le profil public
    Route::get('/profile', function () {
        $user = Auth::user();
        $slug = $user->slug ?? $user->name;
        return redirect()->route('profile.public', ['username' => $slug]);
    })->name('profile.redirect');

    // =============================================
    // PROFIL PUBLIC (accessible par tous)
    // =============================================
    Route::get('/profile/{username}', [BlogController::class, 'showProfile'])->name('profile.public');

    // =============================================
    // AIDE
    // =============================================
    Route::get('/help', [HelpController::class, 'index'])->name('help');

    // =============================================
    // PARAMÈTRES - Routes unifiées
    // =============================================
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::match(['POST', 'PUT'], '/', [SettingsController::class, 'update'])->name('update');
        Route::post('/password', [SettingsController::class, 'updatePassword'])->name('password');
        Route::post('/theme', [SettingsController::class, 'updateTheme'])->name('theme.update');
        Route::post('/language', [SettingsController::class, 'updateLanguage'])->name('language.update');
        Route::match(['POST', 'PUT'], '/preferences', [SettingsController::class, 'updatePreferences'])->name('preferences.update');
    });

    // =============================================
    // COMMUNAUTÉ
    // =============================================
    Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    
    // =============================================
    // NEWSLETTER (AJOUTÉ ICI, DANS LE GROUPE AUTH)
    // =============================================
    Route::post('/newsletter/subscribe', function (Request $request) {
        $request->validate(['email' => 'required|email']);
        // Logique d'inscription à la newsletter
        return redirect()->back()->with('success', 'Inscription réussie !');
    })->name('newsletter.subscribe');
});

// =============================================
// ROUTES ADMIN
// =============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Gestion des utilisateurs
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/details', [AdminController::class, 'userDetails'])->name('users.details');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');
    Route::post('/users/{user}/role', [AdminController::class, 'toggleRole'])->name('users.toggle-role');
    Route::get('/users/export', [AdminController::class, 'exportUsers'])->name('users.export');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');

    // Analytics & Configuration
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/config', [AdminController::class, 'config'])->name('config');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');
    Route::post('/settings/update', [AdminController::class, 'updateSettings'])->name('settings.update');
    
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

// =============================================
// AUTHENTIFICATION BREEZE
// =============================================
require __DIR__ . '/auth.php';