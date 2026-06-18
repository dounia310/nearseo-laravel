<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Afficher la liste des articles (Web) ou retourner JSON (API)
     */
    public function index(Request $request)
    {
        if ($request->is('api/*') || $request->wantsJson()) {
            $articles = Article::with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return response()->json($articles);
        }

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
            'meta_description' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'status' => 'in:draft,published',
            'scheduled_date' => 'nullable|date',
            'scheduled_time' => 'nullable|date_format:H:i'
        ]);

        $scheduledFor = null;
        if ($request->has('scheduled_date') && $request->has('scheduled_time')) {
            $scheduledFor = Carbon::parse($request->scheduled_date . ' ' . $request->scheduled_time);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $slug = Str::slug($validated['title']);
        $keyword = $validated['focus_keyword'] ?? '';
        if (!empty($keyword)) {
            $keywordSlug = Str::slug($keyword);
            if (!str_contains($slug, $keywordSlug)) {
                $slug = $slug . '-' . $keywordSlug;
            }
        }

        $article = Article::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'focus_keyword' => strip_tags($validated['focus_keyword'] ?? ''),
            'meta_description' => $validated['meta_description'] ?? null,
            'image' => $imagePath,
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
     * Afficher un article (dashboard)
     * Si publié → redirige vers le blog public
     * Si brouillon → affiche dans le dashboard
     */
    public function show(Article $article)
    {
        // Si l'article est publié, rediriger vers le blog
        if ($article->status === 'published') {
            return redirect()->route('blog.show', $article->slug);
        }
        
        // Si c'est un brouillon, afficher dans le dashboard
        $article->increment('views');
        return view('dashboard.articles.show', compact('article'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Article $article)
    {
        if (Gate::denies('update', $article)) {
            abort(403, "Vous n'êtes pas autorisé à modifier cet article.");
        }

        // Si l'article n'a pas de content_json, le convertir depuis le HTML
        if (empty($article->content_json) && !empty($article->content)) {
            $article->content_json = $this->convertHtmlToEditorJs($article->content);
        }

        return view('dashboard.articles.edit', compact('article'));
    }

    /**
     * Uploader une image de couverture
     */
    public function uploadImage(Request $request, Article $article)
    {
        if (Gate::denies('update', $article)) {
            abort(403, "Vous n'êtes pas autorisé à modifier cet article.");
        }

        $request->validate([
            'image' => 'required|image|max:5120'
        ]);

        if ($article->image && Storage::exists('public/' . $article->image)) {
            Storage::delete('public/' . $article->image);
        }

        $path = $request->file('image')->store('articles', 'public');
        $article->update(['image' => $path]);

        return response()->json([
            'success' => true,
            'image_url' => asset('storage/' . $path)
        ]);
    }

    /**
     * Uploader une image pour l'éditeur (contenu d'article)
     */
    public function uploadEditorImage(Request $request, Article $article)
    {
        if (Gate::denies('update', $article)) {
            abort(403, "Vous n'êtes pas autorisé à modifier cet article.");
        }

        $request->validate([
            'image' => 'required|image|max:5120'
        ]);

        $path = $request->file('image')->store('editor-images', 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }

    /**
     * Supprimer l'image de couverture
     */
    public function removeImage(Article $article)
    {
        if (Gate::denies('update', $article)) {
            abort(403, "Vous n'êtes pas autorisé à modifier cet article.");
        }

        if ($article->image && Storage::exists('public/' . $article->image)) {
            Storage::delete('public/' . $article->image);
        }

        $article->update(['image' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Image supprimée avec succès'
        ]);
    }

    /**
     * Mettre à jour un article (avec notification de publication)
     */
    public function update(Request $request, Article $article)
    {
        if (Gate::denies('update', $article)) {
            abort(403, "Vous n'êtes pas autorisé à modifier cet article.");
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'focus_keyword' => 'nullable|max:100',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'in:draft,published'
        ]);

        $wasPublished = ($validated['status'] === 'published' && $article->status !== 'published');

        $slug = $article->slug;
        if ($article->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $keyword = $validated['focus_keyword'] ?? $article->focus_keyword ?? '';
            if (!empty($keyword)) {
                $keywordSlug = Str::slug($keyword);
                if (!str_contains($slug, $keywordSlug)) {
                    $slug = $slug . '-' . $keywordSlug;
                }
            }
        }

        // Gérer le contenu JSON si envoyé
        $contentJson = null;
        if ($request->has('content_json')) {
            $contentJson = $request->input('content_json');
            if (is_string($contentJson)) {
                $contentJson = json_decode($contentJson, true);
            }
            if (json_last_error() === JSON_ERROR_NONE && !empty($contentJson)) {
                // Garder le HTML pour la compatibilité
                $validated['content'] = $this->extractHtmlFromEditorJs($contentJson);
            }
        }

        $article->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'content_json' => $contentJson ?? $article->content_json,
            'focus_keyword' => strip_tags($validated['focus_keyword'] ?? ''),
            'meta_description' => $validated['meta_description'] ?? null,
            'status' => $validated['status'],
            'seo_score' => $this->calculateSeoScore($validated['content'], $validated['focus_keyword'] ?? '')
        ]);

        if ($wasPublished) {
            Auth::user()->update([
                'last_article_published_at' => now()
            ]);

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
        if (Gate::denies('delete', $article)) {
            abort(403, "Vous n'êtes pas autorisé à supprimer cet article.");
        }

        if ($article->image && Storage::exists('public/' . $article->image)) {
            Storage::delete('public/' . $article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès');
    }

    // =============================================
    // BLOG PUBLIC
    // =============================================

    /**
     * PAGE BLOG PUBLIC - Afficher la liste des articles
     */
    public function blog()
    {
        // Récupérer tous les articles publiés
        $articles = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $recentArticles = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $archives = Article::where('status', 'published')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $allTags = Article::where('status', 'published')
            ->whereNotNull('tags')
            ->pluck('tags')
            ->map(fn($tag) => explode(',', $tag))
            ->flatten()
            ->map('trim')
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(15);

        return view('blog.index', compact('articles', 'recentArticles', 'archives', 'allTags'));
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
    
    // Nettoyer le contenu
    $content = $article->content;
    
    // Supprimer les guillemets
    $content = trim($content);
    if (substr($content, 0, 1) === '"') {
        $content = substr($content, 1);
    }
    if (substr($content, -1) === '"') {
        $content = substr($content, 0, -1);
    }
    
    // Déséchapper
    $content = stripslashes($content);
    
    // Remplacer \n par des sauts de ligne réels PUIS les supprimer
    $content = str_replace(['\\n', '\n'], '', $content);
    $content = str_replace(['\\r', '\r'], '', $content);
    
    // Nettoyer les espaces multiples
    $content = preg_replace('/\s+/', ' ', $content);
    
    // Restaurer les balises HTML
    $article->content = $content;

    return view('blog.show', compact('article'));
}
    // =============================================
    // MÉTHODES PRIVÉES
    // =============================================

    /**
     * Calculer le score SEO d'un article
     */
    private function calculateSeoScore(string $content, string $keyword): int
    {
        $score = 50;

        if (empty($keyword)) {
            return $score;
        }

        $firstChars = substr($content, 0, 200);
        if (stripos($firstChars, $keyword) !== false) {
            $score += 10;
        }

        $wordCount = str_word_count(strip_tags($content));
        $keywordCount = substr_count(strtolower(strip_tags($content)), strtolower($keyword));
        $density = ($wordCount > 0) ? ($keywordCount / $wordCount) * 100 : 0;

        if ($density >= 1 && $density <= 3) {
            $score += 15;
        } elseif ($density > 0) {
            $score += 5;
        }

        if ($wordCount > 1000) {
            $score += 15;
        } elseif ($wordCount > 500) {
            $score += 10;
        } elseif ($wordCount > 300) {
            $score += 5;
        }

        if (preg_match('/<h[2-3]/i', $content)) {
            $score += 10;
        }

        if (preg_match('/<img/i', $content)) {
            $score += 5;
        }

        if (preg_match('/<a\s+href/i', $content)) {
            $score += 5;
        }

        return min($score, 100);
    }

    /**
     * Convertir HTML en format Editor.js
     */
    private function convertHtmlToEditorJs($html): array
    {
        if (empty($html)) {
            return ['blocks' => []];
        }

        $blocks = [];

        // Extraire le titre H1
        preg_match('/<h1[^>]*>(.*?)<\/h1>/i', $html, $h1Matches);
        if (!empty($h1Matches[1])) {
            $blocks[] = [
                'type' => 'header',
                'data' => [
                    'text' => trim(strip_tags($h1Matches[1])),
                    'level' => 1
                ]
            ];
        }

        // Extraire les H2
        preg_match_all('/<h2[^>]*>(.*?)<\/h2>/i', $html, $h2Matches);
        foreach ($h2Matches[1] ?? [] as $h2) {
            $blocks[] = [
                'type' => 'header',
                'data' => [
                    'text' => trim(strip_tags($h2)),
                    'level' => 2
                ]
            ];
        }

        // Extraire les H3
        preg_match_all('/<h3[^>]*>(.*?)<\/h3>/i', $html, $h3Matches);
        foreach ($h3Matches[1] ?? [] as $h3) {
            $blocks[] = [
                'type' => 'header',
                'data' => [
                    'text' => trim(strip_tags($h3)),
                    'level' => 3
                ]
            ];
        }

        // Extraire les paragraphes
        preg_match_all('/<p[^>]*>(.*?)<\/p>/i', $html, $pMatches);
        foreach ($pMatches[1] ?? [] as $p) {
            $text = trim(strip_tags($p));
            if (!empty($text) && strlen($text) > 10) {
                $blocks[] = [
                    'type' => 'paragraph',
                    'data' => ['text' => $text]
                ];
            }
        }

        // Extraire les listes
        preg_match_all('/<ul[^>]*>(.*?)<\/ul>/is', $html, $ulMatches);
        foreach ($ulMatches[1] ?? [] as $ul) {
            preg_match_all('/<li[^>]*>(.*?)<\/li>/i', $ul, $liMatches);
            $items = array_map('trim', array_map('strip_tags', $liMatches[1] ?? []));
            if (!empty($items)) {
                $blocks[] = [
                    'type' => 'list',
                    'data' => [
                        'style' => 'unordered',
                        'items' => $items
                    ]
                ];
            }
        }

        // Extraire les listes ordonnées
        preg_match_all('/<ol[^>]*>(.*?)<\/ol>/is', $html, $olMatches);
        foreach ($olMatches[1] ?? [] as $ol) {
            preg_match_all('/<li[^>]*>(.*?)<\/li>/i', $ol, $liMatches);
            $items = array_map('trim', array_map('strip_tags', $liMatches[1] ?? []));
            if (!empty($items)) {
                $blocks[] = [
                    'type' => 'list',
                    'data' => [
                        'style' => 'ordered',
                        'items' => $items
                    ]
                ];
            }
        }

        // Extraire les images
        preg_match_all('/<img[^>]*src=["\']([^"\']*)["\'][^>]*>/i', $html, $imgMatches);
        foreach ($imgMatches[1] ?? [] as $src) {
            preg_match('/alt=["\']([^"\']*)["\']/i', $html, $altMatch);
            $caption = $altMatch[1] ?? '';
            $blocks[] = [
                'type' => 'image',
                'data' => [
                    'file' => ['url' => $src],
                    'caption' => $caption
                ]
            ];
        }

        // Si aucun bloc n'a été trouvé
        if (empty($blocks)) {
            $text = strip_tags($html);
            if (!empty($text)) {
                $blocks[] = [
                    'type' => 'paragraph',
                    'data' => ['text' => $text]
                ];
            } else {
                $blocks[] = [
                    'type' => 'paragraph',
                    'data' => ['text' => 'Commencez à écrire votre article...']
                ];
            }
        }

        return ['blocks' => $blocks];
    }

    /**
     * Extraire le HTML depuis le JSON Editor.js
     */
    private function extractHtmlFromEditorJs(array $json): string
    {
        $html = '';
        foreach ($json['blocks'] ?? [] as $block) {
            switch ($block['type']) {
                case 'header':
                    $level = $block['data']['level'] ?? 2;
                    $html .= "<h{$level}>" . e($block['data']['text']) . "</h{$level}>";
                    break;
                case 'paragraph':
                    $html .= "<p>" . e($block['data']['text']) . "</p>";
                    break;
                case 'list':
                    $items = $block['data']['items'] ?? [];
                    $style = $block['data']['style'] ?? 'unordered';
                    $tag = $style === 'ordered' ? 'ol' : 'ul';
                    $html .= "<{$tag}>";
                    foreach ($items as $item) {
                        $html .= "<li>" . e($item) . "</li>";
                    }
                    $html .= "</{$tag}>";
                    break;
                case 'image':
                    $url = $block['data']['file']['url'] ?? '';
                    $caption = $block['data']['caption'] ?? '';
                    $html .= '<img src="' . e($url) . '" alt="' . e($caption) . '">';
                    if ($caption) {
                        $html .= '<figcaption>' . e($caption) . '</figcaption>';
                    }
                    break;
                case 'table':
                    $content = $block['data']['content'] ?? [];
                    $html .= '<table>';
                    foreach ($content as $row) {
                        $html .= '<tr>';
                        foreach ($row as $cell) {
                            $html .= '<td>' . e($cell) . '</td>';
                        }
                        $html .= '</tr>';
                    }
                    $html .= '</table>';
                    break;
                case 'quote':
                    $text = $block['data']['text'] ?? '';
                    $caption = $block['data']['caption'] ?? '';
                    $html .= '<blockquote>' . e($text) . '</blockquote>';
                    if ($caption) {
                        $html .= '<cite>' . e($caption) . '</cite>';
                    }
                    break;
                case 'checklist':
                    $items = $block['data']['items'] ?? [];
                    $html .= '<ul class="checklist">';
                    foreach ($items as $item) {
                        $checked = ($item['checked'] ?? false) ? 'checked' : '';
                        $html .= '<li><input type="checkbox" ' . $checked . ' disabled> ' . e($item['text']) . '</li>';
                    }
                    $html .= '</ul>';
                    break;
                default:
                    break;
            }
        }
        return $html;
    }
}