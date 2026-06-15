<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticleController extends Controller
{
    /**
     * Afficher la liste des articles (Web) ou retourner JSON (API)
     */
    public function index(Request $request)
    {
        // ⭐ Détection si c'est une requête API
        if ($request->is('api/*') || $request->wantsJson()) {
            // Pour l'API : retourner JSON
            $articles = Article::with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            
            return response()->json($articles);
        }
        
        // Pour le web : retourner la vue Blade
        $articles = Article::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('dashboard.articles.index', compact('articles'));
    }
    
    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('dashboard.articles.create');
    }
    
    /**
     * Enregistrer un nouvel article (avec planification)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'focus_keyword' => 'nullable|max:100',
            'status' => 'in:draft,published',
            'scheduled_date' => 'nullable|date',
            'scheduled_time' => 'nullable|date_format:H:i'
        ]);
        
        $scheduledFor = null;
        if ($request->has('scheduled_date') && $request->has('scheduled_time')) {
            $scheduledFor = Carbon::parse($request->scheduled_date . ' ' . $request->scheduled_time);
        }
        
        $article = Article::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'focus_keyword' => $validated['focus_keyword'] ?? null,
            'status' => $scheduledFor ? 'draft' : ($request->status ?? 'draft'),
            'scheduled_for' => $scheduledFor,
            'scheduled_status' => $scheduledFor ? 'pending' : null,
            'seo_score' => $this->calculateSeoScore($validated['content'], $validated['focus_keyword'] ?? '')
        ]);
        
        $message = $scheduledFor 
            ? 'Article programmé pour le ' . $scheduledFor->format('d/m/Y à H:i')
            : 'Article créé avec succès !';
        
        return redirect()->route('articles.index')->with('success', $message);
    }
    
    /**
     * Afficher un article
     */
    public function show(Article $article)
    {
        // Incrémenter le compteur de vues
        $article->increment('views');
        
        return view('dashboard.articles.show', compact('article'));
    }
    
    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Article $article)
    {
        // Vérifier l'autorisation
        if (Gate::denies('update', $article)) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cet article.');
        }
        
        return view('dashboard.articles.edit', compact('article'));
    }
    
    /**
     * Mettre à jour un article (avec notification de publication)
     */
    public function update(Request $request, Article $article)
    {
        // Vérifier l'autorisation
        if (Gate::denies('update', $article)) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cet article.');
        }
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'focus_keyword' => 'nullable|max:100',
            'status' => 'in:draft,published'
        ]);
        
        // Vérifier si l'article vient d'être publié
        $wasPublished = ($validated['status'] === 'published' && $article->status !== 'published');
        
        $article->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'focus_keyword' => $validated['focus_keyword'],
            'status' => $validated['status'],
            'seo_score' => $this->calculateSeoScore($validated['content'], $validated['focus_keyword'] ?? '')
        ]);
        
        // Si l'article vient d'être publié
        if ($wasPublished) {
            // Mettre à jour la date de dernière publication de l'utilisateur
            Auth::user()->update([
                'last_article_published_at' => now()
            ]);
            
            // Envoyer une notification de félicitations
            Notification::create([
                'user_id' => Auth::id(),
                'title' => 'Article publié !',
                'message' => 'Félicitations ! Votre article "' . $article->title . '" a été publié avec succès.',
                'type' => 'success'
            ]);
        }
        
        return redirect()->route('articles.index')->with('success', 'Article mis à jour !');
    }
    
    /**
     * Supprimer un article
     */
    public function destroy(Article $article)
    {
        // Vérifier l'autorisation
        if (Gate::denies('delete', $article)) {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer cet article.');
        }
        
        $article->delete();
        
        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès');
    }
    
    /**
     * PAGE BLOG PUBLIC - Afficher la liste des articles
     */
    public function blog()
    {
        $user = auth()->user();
        
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
        
        return view('blog.index', compact('articles', 'user', 'recentArticles', 'archives', 'allTags'));
    }
    
    /**
     * PAGE BLOG PUBLIC - Afficher un article individuel
     */
    public function showBlog($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        
        $article->increment('views');
        
        return view('blog.show', compact('article'));
    }
    
    /**
     * Calculer le score SEO d'un article
     * 
     * @param string $content
     * @param string $keyword
     * @return int
     */
    private function calculateSeoScore(string $content, string $keyword): int
    {
        $score = 50;
        
        // Si pas de mot-clé, score minimum
        if (empty($keyword)) {
            return $score;
        }
        
        // 1. Vérification du mot-clé dans le titre (ou début du contenu)
        $firstChars = substr($content, 0, 200);
        if (stripos($firstChars, $keyword) !== false) {
            $score += 10;
        }
        
        // 2. Densité du mot-clé (entre 1% et 3% est idéal)
        $wordCount = str_word_count(strip_tags($content));
        $keywordCount = substr_count(strtolower(strip_tags($content)), strtolower($keyword));
        $density = ($wordCount > 0) ? ($keywordCount / $wordCount) * 100 : 0;
        
        if ($density >= 1 && $density <= 3) {
            $score += 15;
        } elseif ($density > 0) {
            $score += 5;
        }
        
        // 3. Longueur du contenu
        if ($wordCount > 1000) {
            $score += 15;
        } elseif ($wordCount > 500) {
            $score += 10;
        } elseif ($wordCount > 300) {
            $score += 5;
        }
        
        // 4. Présence de sous-titres (H2, H3)
        if (preg_match('/<h[2-3]/i', $content)) {
            $score += 10;
        }
        
        // 5. Présence d'images
        if (preg_match('/<img/i', $content)) {
            $score += 5;
        }
        
        // 6. Présence de liens internes ou externes
        if (preg_match('/<a\s+href/i', $content)) {
            $score += 5;
        }
        
        return min($score, 100);
    }
}