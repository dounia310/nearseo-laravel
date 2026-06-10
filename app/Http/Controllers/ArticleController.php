<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Afficher la liste des articles
     */
    public function index()
    {
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
     * Enregistrer un nouvel article
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'focus_keyword' => 'nullable|max:100',
            'status' => 'in:draft,published'
        ]);
        
        $article = Article::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'focus_keyword' => $validated['focus_keyword'] ?? null,
            'status' => $validated['status'] ?? 'draft',
            'seo_score' => $this->calculateSeoScore($validated['content'], $validated['focus_keyword'] ?? '')
        ]);
        
        return redirect()->route('articles.index')->with('success', 'Article créé avec succès !');
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
     * Mettre à jour un article
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
        
        $article->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'focus_keyword' => $validated['focus_keyword'],
            'status' => $validated['status'],
            'seo_score' => $this->calculateSeoScore($validated['content'], $validated['focus_keyword'] ?? '')
        ]);
        
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