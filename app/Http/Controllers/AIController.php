<?php
namespace App\Http\Controllers;

use App\Services\GeminiService;
use App\Services\SeoAnalyzerService;
use App\Services\BusinessTrendService;
use App\Services\SeoValidatorService;
use App\Services\ContentCleanerService;
use App\Models\Article;
use App\Models\AIGeneration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AIController extends Controller
{
    protected GeminiService $gemini;
    protected BusinessTrendService $trendService;
    protected SeoValidatorService $seoValidator;
    protected ContentCleanerService $cleaner; // ⭐ AJOUTER

    public function __construct(
        GeminiService $gemini,
        BusinessTrendService $trendService,
        SeoValidatorService $seoValidator,
        ContentCleanerService $cleaner // ⭐ AJOUTER
    ) {
        $this->gemini = $gemini;
        $this->trendService = $trendService;
        $this->seoValidator = $seoValidator;
        $this->cleaner = $cleaner; // ⭐ AJOUTER
    }

    /**
     * Page de génération d'article IA avec suggestions
     */
    public function create(Request $request)
    {
        $topic = $request->input('topic');
        $keywords = $request->input('keywords');
        $businessType = $request->input('business_type');

        $suggestions = $this->trendService->getSuggestionsForBusiness($businessType);
        $userBusinessType = auth()->user()->business_type ?? 'general';
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
     * ✅ Récupère les infos depuis auth()->user()
     */
    public function generate(Request $request)
    {
        Log::info('AI Generate request received', $request->all());

        $user = auth()->user();

        // ✅ Validation MINIMALE
        $validated = $request->validate([
            'subject' => 'required|string|max:500',
            'language' => 'nullable|string|in:fr,en,ar',
            'tone' => 'nullable|string',
            'format' => 'nullable|string|in:short,medium,long',
            'goals' => 'nullable|array',
        ]);

        // ✅ Récupérer les infos du commerce depuis le USER
        $mode = $user->business_mode ?? 'local';
        $businessName = $user->business_name ?? $user->name;
        $businessCategory = $user->business_category ?? '';
        $address = $user->business_address ?? '';
        $city = $user->business_city ?? '';
        $district = $user->business_district ?? '';
        $country = $user->business_country ?? 'Maroc';
        $website = $user->business_website ?? '';

        // ✅ Préférences (avec fallback sur les valeurs du formulaire)
        $language = $request->input('language', $user->preferences['language'] ?? 'fr');
        $tone = $request->input('tone', $user->preferences['preferred_tone'] ?? 'professional');
        $format = $request->input('format', $user->preferences['preferred_format'] ?? 'medium');
        $goals = $request->input('goals', $user->preferences['preferred_goals'] ?? []);

        // ✅ Construction des données pour Gemini
        $data = [
            'mode' => $mode,
            'business_name' => $businessName,
            'topic' => $request->subject,
            'address' => $address,
            'website' => $website,
            'hours' => '',
            'goals' => $goals,
            'language' => $language,
            'tone' => $tone,
            'format' => $format,
            'geo_quartier' => $district,
            'geo_ville' => $city,
            'geo_pays' => $country,
            'keywords' => '',
        ];

        // ✅ Générer l'article via Gemini
        $result = $this->gemini->generateArticle($data);

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['error'] ?? 'Erreur de génération',
                'code' => $result['code'] ?? 500
            ], 500);
        }

        // ⭐ Nettoyage
        $rawContent = $result['content'] ?? '';
        $rawTitle = $result['title'] ?? $request->subject;
        $rawMetaDescription = $result['meta_description'] ?? '';

        $cleanContent = $this->cleanContentComplet($rawContent);
        $cleanTitle = $this->cleanTextComplet($rawTitle);
        $cleanMetaDescription = $this->cleanTextComplet($rawMetaDescription);

        if (empty($cleanMetaDescription)) {
            $cleanMetaDescription = substr(strip_tags($cleanContent), 0, 160);
        }

        $keywords = $this->extractKeywords($cleanContent);

        // ✅ Sauvegarder
        $focusKeyword = strip_tags($businessName);
        $article = Article::create([
            'user_id' => auth()->id(),
            'title' => $cleanTitle,
            'slug' => Str::slug($cleanTitle),
            'content' => $cleanContent,
            'focus_keyword' => $focusKeyword,
            'excerpt' => $cleanMetaDescription,
            'meta_description' => $cleanMetaDescription,
            'status' => 'draft',
            'seo_score' => (int)($result['seo_score'] ?? $this->calculateBasicSeoScore($cleanContent)),
            'views' => 0,
            'address' => $address,
            'keywords' => $keywords,
            'geo_ville' => $city,
            'geo_pays' => $country,
            'category' => $businessCategory,
        ]);

        AIGeneration::create([
            'user_id' => auth()->id(),
            'article_id' => $article->id,
            'prompt' => $request->subject,
            'generated_content' => $cleanContent,
            'seo_score' => $article->seo_score,
        ]);

        Log::info('Article saved successfully', [
            'article_id' => $article->id,
            'title' => $cleanTitle
        ]);

        return response()->json([
            'success' => true,
            'article_id' => $article->id,
            'redirect_url' => route('articles.edit', $article->id),
            'title' => $cleanTitle,
            'message' => 'Article généré avec succès !'
        ]);
    }

    /**
     * ⭐ NETTOYAGE COMPLET DU CONTENU HTML (Version renforcée)
     */
    private function cleanContentComplet(string $content): string
    {
        if (empty($content)) {
            return '';
        }

        // 1️⃣ Supprimer les balises mal formées
        $content = $this->removeMalformedTags($content);
        
        // 2️⃣ Corriger les apostrophes mal encodées
        $content = $this->fixApostrophes($content);
        
        // 3️⃣ Supprimer les caractères invisibles
        $content = $this->removeInvisibleChars($content);
        
        // 4️⃣ Nettoyer les espaces
        $content = $this->cleanSpaces($content);
        
        // 5️⃣ Corriger les guillemets
        $content = $this->fixQuotes($content);
        
        // 6️⃣ Supprimer les balises vides
        $content = $this->removeEmptyTags($content);
        
        // 7️⃣ Corriger les coupures de mots
        $content = $this->fixWordBreaks($content);
        
        // 8️⃣ Valider la structure HTML
        $content = $this->validateHtmlStructure($content);
        
        return trim($content);
    }

    /**
     * Supprimer les balises mal formées
     */
    private function removeMalformedTags(string $content): string
    {
        // Supprimer toutes les balises fermantes isolées
        $patterns = [
            '/<\/?(strong|b|i|u|em|span|div|p|h1|h2|h3|h4|h5|h6|ul|ol|li|a|img|br|hr|table|tr|td|th|section|article|aside|header|footer|nav|main|code|pre|blockquote)\b[^>]*>/i',
            '/<\/strong>\s*/i',
            '/<strong>\s*/i',
            '/<\/b>\s*/i',
            '/<b>\s*/i',
            '/<\/i>\s*/i',
            '/<i>\s*/i',
            '/<\/em>\s*/i',
            '/<em>\s*/i',
        ];
        
        foreach ($patterns as $pattern) {
            $content = preg_replace($pattern, '', $content);
        }
        
        // Remplacer les <br> par des retours à la ligne
        $content = preg_replace('/<br\s*\/?\s*>/i', "\n", $content);
        
        return $content;
    }

    /**
     * Corriger les apostrophes mal encodées
     */
    private function fixApostrophes(string $content): string
    {
        $patterns = [
            "/n'([a-zA-Z])/" => "n'$1",
            "/l'([a-zA-Z])/" => "l'$1",
            "/d'([a-zA-Z])/" => "d'$1",
            "/c'([a-zA-Z])/" => "c'$1",
            "/j'([a-zA-Z])/" => "j'$1",
            "/m'([a-zA-Z])/" => "m'$1",
            "/t'([a-zA-Z])/" => "t'$1",
            "/s'([a-zA-Z])/" => "s'$1",
            "/qu'([a-zA-Z])/" => "qu'$1",
        ];
        
        foreach ($patterns as $pattern => $replacement) {
            $content = preg_replace($pattern, $replacement, $content);
        }
        
        // Remplacer les apostrophes droites par des courbes
        $content = str_replace("'", "'", $content);
        $content = str_replace("'", "'", $content);
        
        return $content;
    }

    /**
     * Supprimer les caractères invisibles
     */
    private function removeInvisibleChars(string $content): string
    {
        // Supprimer les caractères de contrôle
        $content = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $content);
        
        // Supprimer les caractères Unicode invisibles
        $content = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $content);
        
        // Supprimer les espaces insécables
        $content = str_replace("\xc2\xa0", ' ', $content);
        
        return $content;
    }

    /**
     * Nettoyer les espaces
     */
    private function cleanSpaces(string $content): string
    {
        // Supprimer les espaces multiples
        $content = preg_replace('/\s+/', ' ', $content);
        
        // Supprimer les espaces en début/fin de ligne
        $lines = explode("\n", $content);
        $lines = array_map('trim', $lines);
        $content = implode("\n", $lines);
        
        return $content;
    }

    /**
     * Corriger les guillemets
     */
    private function fixQuotes(string $content): string
    {
        // Remplacer les guillemets droits
        $content = str_replace('"', '"', $content);
        $content = str_replace('"', '"', $content);
        $content = str_replace("'", "'", $content);
        $content = str_replace("'", "'", $content);
        
        return $content;
    }

    /**
     * Supprimer les balises HTML vides
     */
    private function removeEmptyTags(string $content): string
    {
        // Supprimer les balises vides
        $content = preg_replace('/<([a-z][a-z0-9]*)[^>]*>\s*<\/\1>/i', '', $content);
        $content = preg_replace('/<p[^>]*>\s*<\/p>/i', '', $content);
        
        return $content;
    }

    /**
     * Corriger les coupures de mots
     */
    private function fixWordBreaks(string $content): string
    {
        $fixes = [
            "l'" => "l'",
            "d'" => "d'",
            "n'" => "n'",
            "c'" => "c'",
            "j'" => "j'",
            "m'" => "m'",
            "t'" => "t'",
            "s'" => "s'",
            "qu'" => "qu'",
            "L'" => "L'",
            "D'" => "D'",
            "N'" => "N'",
            "C'" => "C'",
            "J'" => "J'",
            "M'" => "M'",
            "T'" => "T'",
            "S'" => "S'",
            "Qu'" => "Qu'",
        ];
        
        foreach ($fixes as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }
        
        return $content;
    }

    /**
     * Valider la structure HTML
     */
    private function validateHtmlStructure(string $content): string
    {
        // Si pas de titre H1, en ajouter un
        if (!preg_match('/<h1[^>]*>/i', $content)) {
            $lines = explode("\n", $content);
            $firstLine = array_shift($lines);
            $cleanFirstLine = trim(strip_tags($firstLine));
            if (strlen($cleanFirstLine) > 5) {
                $content = "<h1>" . $cleanFirstLine . "</h1>\n" . implode("\n", $lines);
            }
        }
        
        // S'assurer que les titres ont du contenu
        $content = preg_replace('/<h[1-6][^>]*>\s*<\/h[1-6]>/i', '', $content);
        
        // S'assurer que les paragraphes ont du contenu
        $content = preg_replace('/<p[^>]*>\s*<\/p>/i', '', $content);
        
        return $content;
    }

    /**
     * ⭐ NETTOYER UN TEXTE SIMPLE (Version renforcée)
     */
    private function cleanTextComplet(string $text): string
    {
        if (empty($text)) {
            return '';
        }
        
        // Supprimer les balises HTML
        $text = strip_tags($text);
        
        // Supprimer les caractères invisibles
        $text = $this->removeInvisibleChars($text);
        
        // Corriger les apostrophes
        $text = $this->fixApostrophes($text);
        
        // Nettoyer les espaces
        $text = preg_replace('/\s+/', ' ', $text);
        
        return trim($text);
    }

    /**
     * Extraire les mots-clés du contenu
     */
    private function extractKeywords(string $content): string
    {
        // Nettoyer le contenu
        $cleanText = strip_tags($content);
        
        // Extraire les mots
        $words = str_word_count($cleanText, 1);
        $wordCount = array_count_values(array_map('strtolower', $words));
        
        // Filtrer les mots vides (stop words)
        $stopWords = ['le', 'la', 'les', 'un', 'une', 'des', 'et', 'ou', 'mais', 'donc', 'car', 'ni', 'que', 'qui', 'dont', 'où', 'pour', 'par', 'avec', 'sans', 'sous', 'sur', 'dans', 'entre', 'parmi', 'à', 'de', 'en', 'du', 'au', 'aux', 'des', 'est', 'sont', 'être', 'avoir', 'faire', 'dire', 'voir', 'savoir', 'pouvoir'];
        
        foreach ($stopWords as $stop) {
            unset($wordCount[$stop]);
        }
        
        arsort($wordCount);
        
        // Prendre les 10 premiers mots-clés
        $keywords = array_slice(array_keys($wordCount), 0, 10);
        
        return implode(',', $keywords);
    }

    /**
     * Aperçu de l'article généré
     */
    public function preview()
    {
        $generated = session('ai_generated');

        if (!$generated) {
            return redirect()->route('ai.create')->with('error', 'Aucun article généré');
        }

        $article = Article::create([
            'user_id' => auth()->id(),
            'title' => $this->cleanTextComplet($generated['title']),
            'slug' => Str::slug($generated['title']),
            'content' => $this->cleanContentComplet($generated['content']),
            'focus_keyword' => strip_tags($generated['focus_keyword'] ?? ''),
            'excerpt' => $generated['meta_description'] ?? substr(strip_tags($generated['content']), 0, 200),
            'meta_description' => $generated['meta_description'] ?? null,
            'status' => 'draft',
            'seo_score' => $generated['word_count'] ?? 0,
            'views' => 0,
        ]);

        session()->forget('ai_generated');

        return redirect()->route('articles.edit', $article->id)->with('success', 'Article généré avec succès !');
    }

    /**
     * Reformuler un contenu
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
                'content' => $this->cleanContentComplet($result['content'])
            ]);
        }

        return response()->json([
            'success' => false,
            'content' => substr($request->content, 0, 200) . '...'
        ]);
    }

    /**
     * Optimiser un contenu
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
                'content' => $this->cleanContentComplet($result['content'])
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

            // Nettoyer le contenu avant analyse
            $cleanContent = $this->cleanContentComplet($request->content);
            $cleanTitle = $this->cleanTextComplet($request->title ?? '');

            $result = $seoAnalyzer->analyze(
                content: $cleanContent,
                title: $cleanTitle,
                keyword: $request->keyword
            );

            // Enrichir avec Gemini
            $connection = $this->gemini->checkConnection();
            if ($connection['success']) {
                $analysis = $this->gemini->analyzeSeo($cleanContent, $request->keyword);
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
        // Nettoyer le contenu
        $cleanContent = strip_tags($content);
        $wordCount = str_word_count($cleanContent);
        
        $score = 50;

        if ($wordCount >= 1500) $score += 30;
        elseif ($wordCount >= 1000) $score += 25;
        elseif ($wordCount >= 500) $score += 15;

        // Vérifier les titres
        if (preg_match('/<h1[^>]*>/i', $content)) $score += 10;
        if (preg_match('/<h2[^>]*>/i', $content)) $score += 5;
        if (preg_match('/<h3[^>]*>/i', $content)) $score += 3;

        // Vérifier les images
        if (preg_match('/<img[^>]*>/i', $content)) $score += 10;
        
        // Vérifier les liens
        if (preg_match('/<a\s+href=[^>]*>/i', $content)) $score += 5;
        
        // Vérifier les listes
        if (preg_match('/<(ul|ol)[^>]*>/i', $content)) $score += 5;

        // Vérifier la FAQ
        if (preg_match('/faq|question|Foire aux questions/i', $content)) $score += 7;

        return min($score, 100);
    }

    /**
     * Obtenir les suggestions de sujets
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