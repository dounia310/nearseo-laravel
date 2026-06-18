<?php
// app/Http/Controllers/AIController.php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use App\Services\SeoAnalyzerService;
use App\Services\BusinessTrendService;
use App\Models\Article;
use App\Models\AIGeneration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AIController extends Controller
{
    protected GeminiService $gemini;
    protected BusinessTrendService $trendService;

    public function __construct(GeminiService $gemini, BusinessTrendService $trendService)
    {
        $this->gemini = $gemini;
        $this->trendService = $trendService;
    }
    
    /**
     * Page de génération d'article IA avec suggestions
     */
    public function create(Request $request)
    {
        // Récupérer les paramètres depuis l'URL
        $topic = $request->input('topic');
        $keywords = $request->input('keywords');
        $businessType = $request->input('business_type');
        
        // Récupérer les suggestions adaptées au secteur
        $suggestions = $this->trendService->getSuggestionsForBusiness($businessType);
        
        // Récupérer le secteur de l'utilisateur
        $userBusinessType = auth()->user()->business_type ?? 'general';
        
        // Récupérer les tendances du moment
        $trends = $this->trendService->getCurrentTrends();
        
        return view('dashboard.ai.create', compact(
            'topic', 
            'keywords', 
            'suggestions',
            'userBusinessType',
            'businessType',
            'trends'
        ));
    }
    
    /**
     * Vérifier la connexion à l'API Gemini
     */
    public function checkConnection()
    {
        $result = $this->gemini->checkConnection();
        return response()->json($result);
    }
    
    /**
     * Générer un article premium avec Gemini
     */
    public function generate(Request $request)
    {
        Log::info('AI Generate request received', $request->all());
        
        $request->validate([
            'business_name' => 'required|string',
            'subject' => 'required|string',
            'address' => 'required|string',
            'website' => 'nullable|url',
            'hours' => 'nullable|string',
            'goals' => 'nullable|array',
            'language' => 'nullable|string',
            'tone' => 'nullable|string',
            'length' => 'nullable|string|in:short,medium,long',
            'mode' => 'nullable|string|in:local,online',
            'geo_quartier' => 'nullable|string',
            'geo_ville' => 'nullable|string',
            'geo_pays' => 'nullable|string',
            'keywords' => 'nullable|string'
        ]);
        
        $data = [
            'mode' => $request->mode ?? 'local',
            'business_name' => $request->business_name,
            'topic' => $request->subject,
            'address' => $request->address,
            'website' => $request->website ?? '',
            'hours' => $request->hours ?? '',
            'goals' => $request->goals ?? [],
            'language' => $request->language ?? 'Français',
            'tone' => $request->tone ?? 'Professionnel & Chaleureux',
            'format' => $request->length ?? 'medium',
            'geo_quartier' => $request->geo_quartier ?? '',
            'geo_ville' => $request->geo_ville ?? '',
            'geo_pays' => $request->geo_pays ?? 'Maroc',
            'keywords' => $request->keywords ?? ''
        ];
        
        // Générer l'article via Gemini
        $result = $this->gemini->generateArticle($data);
        
        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['error'] ?? 'Erreur de génération',
                'code' => $result['code'] ?? 500
            ], 500);
        }
        
        // Extraire les mots-clés si présents
        $keywords = $request->keywords ?? $this->extractKeywords($result['content']);
        
        // Sauvegarder en base de données
        $article = Article::create([
            'user_id' => auth()->id(),
            'title' => $result['title'],
            'slug' => Str::slug($result['title']),
            'content' => $result['content'],
            'focus_keyword' => strip_tags($result['focus_keyword'] ?? $data['business_name']),
            'excerpt' => $result['meta_description'] ?? substr(strip_tags($result['content']), 0, 200),
            'meta_description' => $result['meta_description'] ?? null,
            'status' => 'draft',
            'seo_score' => $this->calculateBasicSeoScore($result['content']),
            'views' => 0,
            'address' => $request->address,
            'keywords' => $keywords,
        ]);
        
        // Sauvegarder l'historique de génération
        AIGeneration::create([
            'user_id' => auth()->id(),
            'article_id' => $article->id,
            'prompt' => $request->subject,
            'generated_content' => $result['content'],
            'seo_score' => $article->seo_score,
        ]);
        
        Log::info('Article saved successfully', ['article_id' => $article->id]);
        
        // Retourner l'ID pour redirection vers l'éditeur
        return response()->json([
            'success' => true,
            'article_id' => $article->id,
            'redirect_url' => route('articles.edit', $article->id),
            'title' => $result['title'],
            'message' => 'Article généré ! Complétez les informations dans l\'éditeur.'
        ]);
    }
    
    /**
     * Extraire les mots-clés du contenu
     */
    private function extractKeywords(string $content): string
    {
        // Extraire les mots les plus fréquents
        $words = str_word_count(strip_tags($content), 1);
        $wordCount = array_count_values(array_map('strtolower', $words));
        arsort($wordCount);
        
        // Prendre les 5 premiers mots-clés
        $keywords = array_slice(array_keys($wordCount), 0, 5);
        return implode(',', $keywords);
    }
    
    /**
     * Aperçu de l'article généré (redirige vers l'éditeur)
     */
    public function preview()
    {
        $generated = session('ai_generated');
        
        if (!$generated) {
            return redirect()->route('ai.create')->with('error', 'Aucun article généré');
        }
        
        // Créer un article temporaire avec les données générées
        $article = Article::create([
            'user_id' => auth()->id(),
            'title' => $generated['title'],
            'slug' => Str::slug($generated['title']),
            'content' => $generated['content'],
            'focus_keyword' => strip_tags($generated['focus_keyword'] ?? ''),
            'excerpt' => $generated['meta_description'] ?? substr(strip_tags($generated['content']), 0, 200),
            'meta_description' => $generated['meta_description'] ?? null,
            'status' => 'draft',
            'seo_score' => $generated['word_count'] ?? 0,
            'views' => 0,
        ]);
        
        session()->forget('ai_generated');
        
        return redirect()->route('articles.edit', $article->id)->with('success', 'Article généré ! Complétez les informations.');
    }
    
    /**
     * Reformuler un contenu pour les réseaux sociaux
     */
    public function rewrite(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'platform' => 'required|in:instagram,twitter,linkedin,facebook'
        ]);

        $prompt = "Reformule ce contenu pour {$request->platform} :\n\n" . $request->content;
        
        $result = $this->gemini->generateArticle([
            'business_name' => 'Reformulation',
            'topic' => $prompt,
            'address' => '',
            'format' => 'short'
        ]);
        
        if ($result['success']) {
            return response()->json([
                'success' => true,
                'content' => $result['content']
            ]);
        }
        
        return response()->json([
            'success' => false,
            'content' => substr($request->content, 0, 200) . '...'
        ]);
    }
    
    /**
     * Optimiser un contenu pour un mot-clé
     */
    public function optimize(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'keyword' => 'required|string|max:100'
        ]);
        
        $prompt = "Optimise ce contenu pour le mot-clé '{$request->keyword}'. Garde le sens mais améliore le SEO.\n\nContenu original :\n" . $request->content;
        
        $result = $this->gemini->generateArticle([
            'business_name' => 'Optimisation',
            'topic' => $prompt,
            'address' => '',
            'format' => 'medium'
        ]);
        
        if ($result['success']) {
            return response()->json([
                'success' => true,
                'content' => $result['content']
            ]);
        }
        
        return response()->json([
            'success' => true,
            'content' => $request->content
        ]);
    }
    
    /**
     * Historique des générations
     */
    public function history()
    {
        $generations = AIGeneration::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('dashboard.ai.history', compact('generations'));
    }
    
    /**
     * Analyse SEO d'un article
     */
    public function analyzeSeo(Request $request, SeoAnalyzerService $seoAnalyzer)
    {
        try {
            $request->validate([
                'content' => 'required|string',
                'title' => 'nullable|string',
                'keyword' => 'nullable|string'
            ]);

            $result = $seoAnalyzer->analyze(
                content: $request->content,
                title: $request->title,
                keyword: $request->keyword
            );
            
            // Enrichir avec Gemini pour des recommandations avancées
            $connection = $this->gemini->checkConnection();
            if ($connection['success']) {
                $analysis = $this->gemini->analyzeSeo($request->content, $request->keyword);
                $result['advanced_recommendations'] = $analysis['recommendations'] ?? [];
                $result['advanced_score'] = $analysis['score'] ?? $result['score'];
            }
            
            return response()->json($result);
            
        } catch (\Exception $e) {
            Log::error('SEO Analysis error: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
                'score' => 50,
                'grade' => 'C',
                'suggestions' => ['Erreur temporaire, veuillez réessayer'],
                'positives' => [],
                'word_count' => 0
            ], 200);
        }
    }
    
    /**
     * Suggérer des mots-clés SEO
     */
    public function suggestKeywords(Request $request)
    {
        $request->validate([
            'topic' => 'required|string',
            'location' => 'nullable|string'
        ]);
        
        $keywords = $this->gemini->suggestKeywords($request->topic, $request->location);
        
        return response()->json([
            'success' => true,
            'keywords' => $keywords
        ]);
    }
    
    /**
     * Calculer un score SEO basique
     */
    private function calculateBasicSeoScore(string $content): int
    {
        $wordCount = str_word_count(strip_tags($content));
        $score = 50;
        
        if ($wordCount >= 1000) $score += 25;
        elseif ($wordCount >= 500) $score += 15;
        
        if (preg_match('/<h[2-3]/i', $content)) $score += 10;
        if (preg_match('/<img/i', $content)) $score += 10;
        if (preg_match('/<a\s+href/i', $content)) $score += 5;
        
        return min($score, 100);
    }

    /**
     * Obtenir les suggestions de sujets pour l'IA
     */
    public function getSuggestions(Request $request)
    {
        $businessType = $request->input('business_type');
        $suggestions = $this->trendService->getApiSuggestions($businessType);
        
        return response()->json($suggestions);
    }

    /**
     * Mettre à jour le secteur d'activité
     */
    public function updateBusinessType(Request $request)
    {
        $validated = $request->validate([
            'business_type' => 'required|string|in:restaurant,hotel,coiffure,beaute,fleuriste,voyage,immobilier,auto,sante,fashion,general',
            'business_name' => 'nullable|string|max:255',
        ]);
        
        $user = auth()->user();
        $user->business_type = $validated['business_type'];
        if (isset($validated['business_name'])) {
            $user->business_name = $validated['business_name'];
        }
        $user->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Secteur d\'activité mis à jour',
            'business_type' => $user->business_type
        ]);
    }

    /**
     * Obtenir les tendances actuelles
     */
    public function getTrends()
    {
        $trends = $this->trendService->getCurrentTrends();
        
        return response()->json([
            'success' => true,
            'data' => $trends
        ]);
    }
}