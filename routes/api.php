<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AIController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Models\User;
use App\Models\Article;
use App\Http\Controllers\Api\SeoController;

// ⭐ Routes publiques
Route::get('/', function () {
    return response()->json(['message' => 'NEARSEO API v1']);
})->name('api.home');

// ⭐ Test connexion Gemini (sans auth)
Route::get('/ai/test-connection', [\App\Http\Controllers\GeminiTestController::class, 'testConnection']);

// ⭐ Routes protégées par authentification
Route::middleware('auth:sanctum')->group(function () {

    // Articles
    Route::apiResource('articles', ArticleController::class)->names([
        'index' => 'api.articles.index',
        'store' => 'api.articles.store',
        'show' => 'api.articles.show',
        'update' => 'api.articles.update',
        'destroy' => 'api.articles.destroy',
    ]);

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

    // Profil
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

    // ⭐ SEO Analyse - Déplacé ici (dans le groupe auth)
    Route::post('/seo/analyze', [App\Http\Controllers\Api\SeoController::class, 'analyze']);

    // ⭐ Routes admin (API)
    Route::middleware(['admin'])->prefix('admin')->name('api.admin.')->group(function () {

        Route::get('/users', function () {
            return response()->json(User::withCount('articles')->paginate(20));
        })->name('users');

        Route::get('/users/{id}', function ($id) {
            return response()->json(User::with('articles')->findOrFail($id));
        })->name('users.show');

        Route::delete('/users/{id}', function ($id) {
            $user = User::findOrFail($id);
            if ($user->role !== 'admin') {
                $user->delete();
                return response()->json(['success' => true]);
            }
            return response()->json(['error' => 'Cannot delete admin'], 403);
        })->name('users.destroy');

        Route::put('/users/{id}/role', function ($id) {
            $user = User::findOrFail($id);
            $user->role = $user->role === 'admin' ? 'user' : 'admin';
            $user->save();
            return response()->json(['success' => true, 'role' => $user->role]);
        })->name('users.role');

        Route::get('/articles', function () {
            return response()->json(Article::with('user')->latest()->paginate(20));
        })->name('articles');

        Route::delete('/articles/{id}', function ($id) {
            Article::findOrFail($id)->delete();
            return response()->json(['success' => true]);
        })->name('articles.destroy');

        Route::get('/analytics', function () {
            return response()->json([
                'total_users' => User::count(),
                'total_articles' => Article::count(),
                'total_views' => Article::sum('views'),
                'avg_seo_score' => round(Article::avg('seo_score') ?? 0),
            ]);
        })->name('analytics');
    });
});