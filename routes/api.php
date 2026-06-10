<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AIController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Models\User;
use App\Models\Article;

// ⭐ Route SEO analysis (publique) - UNE SEULE FOIS
Route::post('/seo/analyze', [AIController::class, 'analyzeSeo']);

// Routes publiques
Route::get('/', function () {
    return response()->json(['message' => 'NEARSEO API v1']);
})->name('api.home');

// Routes protégées par authentification
Route::middleware('auth:sanctum')->group(function () {
    // Articles
    Route::apiResource('articles', ArticleController::class);
    Route::get('articles/{article}/edit', [ArticleController::class, 'edit']);
    
    // IA Generator
    Route::prefix('ai')->group(function () {
        Route::post('generate', [AIController::class, 'generate']);
        Route::post('rewrite', [AIController::class, 'rewrite']);
        Route::post('optimize', [AIController::class, 'optimize']);
        Route::get('history', [AIController::class, 'history']);
    });
    
    // Géolocalisation
    Route::prefix('geo')->group(function () {
        Route::get('articles', [GeoController::class, 'nearbyArticles']);
        Route::get('search', [GeoController::class, 'searchLocation']);
        Route::post('address', [GeoController::class, 'updateAddress']);
    });
    
    // Notifications
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::post('mark-read', [NotificationController::class, 'markAllAsRead']);
        Route::post('{notification}/read', [NotificationController::class, 'markAsRead']);
    });
    
    // Profil utilisateur
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show']);
        Route::put('/', [ProfileController::class, 'update']);
        Route::post('avatar', [ProfileController::class, 'updateAvatar']);
        Route::get('stats', [ProfileController::class, 'stats']);
    });
    
    // Paramètres
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index']);
        Route::put('/', [SettingsController::class, 'update']);
        Route::post('password', [SettingsController::class, 'updatePassword']);
    });
    
    // ⭐ Routes admin (protégées par middleware admin)
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/users', function () {
            $users = User::withCount('articles')->paginate(20);
            return response()->json($users);
        })->name('users');
        
        Route::get('/users/{user}', function ($id) {
            $user = User::with('articles')->findOrFail($id);
            return response()->json($user);
        })->name('users.show');
        
        Route::delete('/users/{user}', function ($id) {
            $user = User::findOrFail($id);
            if ($user->role !== 'admin') {
                $user->delete();
                return response()->json(['success' => true, 'message' => 'Utilisateur supprimé']);
            }
            return response()->json(['success' => false, 'message' => 'Impossible de supprimer un admin'], 403);
        })->name('users.destroy');
        
        Route::put('/users/{user}/role', function ($id) {
            $user = User::findOrFail($id);
            $user->role = $user->role === 'admin' ? 'user' : 'admin';
            $user->save();
            return response()->json(['success' => true, 'role' => $user->role]);
        })->name('users.role');
        
        Route::get('/articles', function () {
            $articles = Article::with('user')->orderBy('created_at', 'desc')->paginate(20);
            return response()->json($articles);
        })->name('articles');
        
        Route::delete('/articles/{article}', function ($id) {
            $article = Article::findOrFail($id);
            $article->delete();
            return response()->json(['success' => true, 'message' => 'Article supprimé']);
        })->name('articles.destroy');
        
        Route::get('/analytics', function () {
            $stats = [
                'total_users' => User::count(),
                'total_articles' => Article::count(),
                'total_views' => Article::sum('views'),
                'avg_seo_score' => round(Article::avg('seo_score') ?? 0),
            ];
            return response()->json($stats);
        })->name('analytics');
        
        // Route::post('/seo/analyze', [AIController::class, 'analyzeSeo']);
    });
});