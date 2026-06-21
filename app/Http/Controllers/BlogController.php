<?php
// app/Http/Controllers/BlogController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Page d'accueil du blog - Tous les articles de tous les utilisateurs
     * URL: /blog
     */
    public function index()
    {
        $articles = Article::where('status', 'published')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $recentArticles = Article::where('status', 'published')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Tags populaires
        $allTags = Article::where('status', 'published')
            ->whereNotNull('tags')
            ->pluck('tags')
            ->map(fn($tag) => explode(',', $tag))
            ->flatten()
            ->map('trim')
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(20);

        // Archives par mois
        $archives = Article::where('status', 'published')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('blog.index', compact('articles', 'recentArticles', 'allTags', 'archives'));
    }

    /**
     * Afficher un article - REDIRECTION VERS LE BLOG UTILISATEUR
     * URL: /blog/{slug}
     */
    public function show($slug)
    {
        // Récupérer l'article
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Récupérer l'utilisateur de l'article
        $user = User::findOrFail($article->user_id);

        // ✅ Rediriger vers la page utilisateur de l'article
        return redirect()->route('blog.user.article', [
            'username' => $user->slug,
            'slug' => $article->slug
        ]);
    }

    /**
     * Blog d'un utilisateur spécifique
     * URL: /blog/user/{slug}
     */
    public function userBlog($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        
        $articles = Article::where('user_id', $user->id)
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        
        $recentArticles = Article::where('user_id', $user->id)
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        $archives = Article::where('user_id', $user->id)
            ->where('status', 'published')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        
        $allTags = Article::where('user_id', $user->id)
            ->where('status', 'published')
            ->whereNotNull('tags')
            ->pluck('tags')
            ->map(fn($tag) => explode(',', $tag))
            ->flatten()
            ->map('trim')
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(15);
        
        return view('blog.user-blog', compact('user', 'articles', 'recentArticles', 'archives', 'allTags'));
    }
    
    /**
     * Article spécifique d'un utilisateur
     * URL: /blog/user/{username}/{slug}
     */
    public function userArticle($username, $slug)
    {
        // Chercher l'utilisateur
        $user = User::where('slug', $username)->firstOrFail();
        
        // Chercher l'article
        $article = Article::where('user_id', $user->id)
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        
        // Incrémenter les vues
        $article->increment('views');
        
        return view('blog.user-article', compact('user', 'article'));
    }
    
    /**
     * Page Communauté
     * URL: /community
     */
    public function community()
    {
        $articles = Article::where('status', 'published')
            ->orderBy('views', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        $topUsers = User::withCount(['articles' => function($query) {
                $query->where('status', 'published');
            }])
            ->orderBy('articles_count', 'desc')
            ->limit(10)
            ->get();
        
        return view('blog.community', compact('articles', 'topUsers'));
    }
    
    /**
     * Profil public d'un utilisateur
     * URL: /profile/{username}
     */
    public function showProfile($username)
    {
        // Chercher l'utilisateur par son slug ou son nom
        $user = User::where('slug', $username)
                    ->orWhere('name', $username)
                    ->firstOrFail();
        
        // Récupérer les articles publiés avec pagination
        $articles = $user->articles()
                        ->where('status', 'published')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        
        // Statistiques additionnelles
        $stats = [
            'total_articles' => $user->articles()->where('status', 'published')->count(),
            'total_views' => $user->articles()->where('status', 'published')->sum('views'),
            'avg_seo_score' => round($user->articles()->where('status', 'published')->avg('seo_score') ?? 0),
            'followers' => 0, // À implémenter si vous avez un système de followers
        ];
        
        return view('blog.user-profile', compact('user', 'articles', 'stats'));
    }
}