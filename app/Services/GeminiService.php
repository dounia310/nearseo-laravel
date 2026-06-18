<?php
// app/Services/GeminiService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private string $apiKey;
    private string $model;
    private int $timeout;
    private int $retryTimes;
    private int $retryMs;
    
    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->model = config('services.gemini.model', 'gemini-2.5-flash');
        $this->timeout = config('services.gemini.timeout', 120);
        $this->retryTimes = config('services.gemini.retry_times', 3);
        $this->retryMs = config('services.gemini.retry_milliseconds', 1000);
    }
    
    /**
     * Vérifier si l'API Gemini est accessible
     */
    public function checkConnection(): array
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models?key={$this->apiKey}";
        $urlLog = "https://generativelanguage.googleapis.com/v1beta/models?key=" . substr($this->apiKey, 0, 10) . "...";
        
        Log::info('Gemini Connection Check', ['url' => $urlLog, 'timeout' => $this->timeout]);
        
        try {
            $response = Http::timeout($this->timeout)
                ->retry($this->retryTimes, $this->retryMs)
                ->get($url);
            
            if ($response->successful()) {
                Log::info('Gemini API accessible', ['status' => $response->status()]);
                return ['success' => true, 'message' => 'API accessible'];
            }
            
            Log::error('Gemini API Error', [
                'url' => $urlLog,
                'status' => $response->status(),
                'body' => substr($response->body(), 0, 500)
            ]);
            
            return ['success' => false, 'message' => 'API key invalide ou expirée', 'code' => $response->status()];
            
        } catch (\Exception $e) {
            Log::error('Gemini Connection Exception', [
                'message' => $e->getMessage(),
                'class' => get_class($e),
                'code' => $e->getCode()
            ]);
            return ['success' => false, 'message' => $e->getMessage(), 'code' => 'connection_failed'];
        }
    }
    
    /**
     * Générer un article SEO premium
     */
    public function generateArticle(array $data): array
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";
        $urlLog = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key=" . substr($this->apiKey, 0, 10) . "...";
        
        Log::info('Gemini Generate Article Start', [
            'business_name' => $data['business_name'] ?? 'unknown',
            'mode' => $data['mode'] ?? 'unknown'
        ]);
        
        $connection = $this->checkConnection();
        if (!$connection['success']) {
            Log::warning('Gemini connection failed, using fallback', ['error' => $connection['message']]);
            return $this->getFallbackArticle($data, $connection['message']);
        }
        
        $prompt = $this->buildPremiumPrompt($data);
        
        try {
            $response = Http::timeout($this->timeout)
                ->retry($this->retryTimes, $this->retryMs)
                ->post($url, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 8000,
                        'topP' => 0.95,
                    ]
                ]);
            
            if ($response->successful()) {
                $content = $response->json('candidates.0.content.parts.0.text') ?? '';
                
                if (empty($content)) {
                    Log::warning('Gemini returned empty content');
                    return $this->getFallbackArticle($data, 'Contenu vide retourné par l\'API');
                }
                
                Log::info('Gemini article generated successfully', [
                    'content_length' => strlen($content),
                    'business_name' => $data['business_name'] ?? 'unknown'
                ]);
                
                return $this->parseArticleResponse($content, $data);
            }
            
            $error = $response->json('error.message') ?? 'Erreur HTTP: ' . $response->status();
            Log::error('Gemini API Error Response', [
                'status' => $response->status(),
                'error' => $error
            ]);
            
            return $this->getFallbackArticle($data, $error);
            
        } catch (\Exception $e) {
            Log::error('Gemini Exception during generation', [
                'message' => $e->getMessage(),
                'class' => get_class($e),
                'code' => $e->getCode()
            ]);
            return $this->getFallbackArticle($data, $e->getMessage());
        }
    }
    
    /**
     * Construction du prompt premium pour article SEO (sans icônes)
     */
    private function buildPremiumPrompt(array $data): string
    {
        $businessName = $data['business_name'] ?? 'Notre commerce';
        $topic = $data['topic'] ?? $businessName;
        $address = $data['address'] ?? '';
        $website = $data['website'] ?? '';
        $hours = $data['hours'] ?? '';
        $goals = isset($data['goals']) && is_array($data['goals']) ? implode(', ', $data['goals']) : '';
        $language = $data['language'] ?? 'Français';
        $tone = $data['tone'] ?? 'Professionnel & Chaleureux';
        $format = $data['format'] ?? 'medium';
        $keyword = $data['business_name'] ?? $topic;
        
        $wordCount = match($format) {
            'short' => 600,
            'medium' => 1000,
            'long' => 1600,
            default => 1000
        };
        
        $addressText = $address ? "Adresse : {$address}" : "Adresse : non fournie";
        $websiteText = $website ? "Site web : {$website}" : "Site web : non fourni";
        $hoursText = $hours ? "Horaires : {$hours}" : "";
        $goalsText = $goals ? "Objectifs : {$goals}" : "";
        
        return <<<PROMPT
Tu es un rédacteur SEO expert en marketing local. Rédige un article SEO premium en {$language}, 100% naturel et humain, optimisé pour Google.

DONNÉES DE L'ARTICLE :
- Sujet : {$topic}
- Nom du commerce : {$businessName}
- {$websiteText}
- {$addressText}
- {$hoursText}
- {$goalsText}
- Ton : {$tone}
- Longueur cible : {$wordCount} mots

INSTRUCTIONS GÉNÉRALES :
- Style : storytelling naturel, ton professionnel mais chaleureux
- Structure : H1, H2, H3 + sommaire (table of contents)
- Introduction : accroche forte et émotionnelle
- Paragraphes variés, transitions naturelles, phrases concises
- Descriptions immersives et sensorielles
- Questions rhétoriques pour engager le lecteur
- Texte 100% original, doit sembler écrit par un humain expert
- Éviter répétitions et phrases génériques

SEO ON-PAGE :
- Générer automatiquement un mot-clé principal à partir du sujet "{$topic}"
- Titre SEO : différent du sujet, utilise le mot-clé principal près du début, contient un power word, un nombre et un sentiment positif/négatif
- META DESCRIPTION : Génère UNIQUEMENT UNE META DESCRIPTION de 150-160 caractères incluant le mot-clé principal. Commence par une phrase d'accroche.
- FORMAT DE LA META DESCRIPTION : "Découvrez [mot-clé principal] ..."
- La meta description doit être différente du titre.
- URL courte : /mot-cle-principal
- Intégrer le mot-clé principal au début du contenu avec densité ~1%
- Ajouter le mot-clé principal dans certains sous-titres (H2, H3)
- IMAGES ET ALT TEXT : Chaque suggestion d'image doit inclure l'attribut ALT avec le mot-clé principal "{$keyword}"
- Format des images : <img src="[url]" alt="[mot-clé principal] - description">
- Exemple : <img src="image.jpg" alt="Restaurant Marrakech - Tajine d'agneau traditionnel">
- Maillage et netlinking : ajouter des liens internes vers {$website} si fourni, ajouter des liens externes DoFollow vers sources fiables
- Champ lexical riche et varié
- Suivre Google EEAT (Expertise, Expérience, Autorité, Confiance)
- Ajouter des suggestions d'images pour rendre l'article attractif

STRUCTURE EXIGÉE :

<article>
<h1>[TITRE SEO OPTIMISÉ]</h1>

<div class="meta">
<p><strong>Meta description :</strong> [META DESCRIPTION ICI]</p>
<p><strong>URL :</strong> /[mot-cle-principal]</p>
<p><strong>Mot-clé principal :</strong> [MOT-CLÉ]</p>
</div>

<div class="sommaire">
<h2>Sommaire</h2>
<ul>
<li><a href="#introduction">Introduction</a></li>
<li><a href="#pourquoi">Pourquoi choisir {$businessName} ?</a></li>
<li><a href="#services">Nos services et produits</a></li>
<li><a href="#localisation">Où nous trouver</a></li>
<li><a href="#avis">Ce que disent nos clients</a></li>
<li><a href="#conseils">Conseils d'expert</a></li>
<li><a href="#faq">Questions fréquentes</a></li>
<li><a href="#conclusion">Conclusion</a></li>
</ul>
</div>

<h2 id="introduction">Introduction</h2>
<p>Introduction immersive de 100-150 mots avec accroche émotionnelle et mot-clé principal.</p>

<h2 id="pourquoi">Pourquoi choisir {$businessName} ?</h2>
<p>Développez les avantages uniques avec descriptions sensorielles et questions rhétoriques.</p>

<h2 id="services">Nos services et produits</h2>
<p>Détail des services proposés, avec sous-titres H3 pour chaque service.</p>

<h2 id="localisation">Où nous trouver</h2>
<p><strong>Adresse :</strong> {$address}</p>
<p>Indications pour s'y rendre et ambiance du quartier.</p>

<h2 id="avis">Ce que disent nos clients</h2>
<p>Témoignages imaginaires mais réalistes de clients satisfaits.</p>

<h2 id="conseils">Conseils d'expert</h2>
<p>Conseils pratiques démontrant l'expertise (EEAT).</p>

<h2 id="faq">Questions fréquentes</h2>
<div class="faq-item">
<p><strong>Question 1 ?</strong></p>
<p>Réponse détaillée.</p>
</div>
<div class="faq-item">
<p><strong>Question 2 ?</strong></p>
<p>Réponse détaillée.</p>
</div>
<div class="faq-item">
<p><strong>Question 3 ?</strong></p>
<p>Réponse détaillée.</p>
</div>

<h2 id="conclusion">Conclusion</h2>
<p>Conclusion inspirante avec appel à l'action (visiter {$businessName} à {$address}).</p>

<div class="image-suggestions">
<p><strong>Images suggérées :</strong></p>
<ul>
<li>Image 1 : [description] - Alt: {$keyword}</li>
<li>Image 2 : [description] - Alt: {$keyword}</li>
<li>Image 3 : [description] - Alt: {$keyword}</li>
</ul>
</div>

</article>

CONSIGNES IMPORTANTES :
1. Longueur totale : environ {$wordCount} mots
2. Intégrez naturellement le nom du commerce "{$businessName}", l'adresse et les horaires
3. Style immersif, professionnel mais chaleureux
4. HTML uniquement, pas de markdown
5. Texte 100% original, doit sembler écrit par un humain
6. N'utilisez PAS d'émojis ou d'icônes

Génère l'article complet en HTML, directement, sans commentaires supplémentaires.
PROMPT;
    }
    
    /**
     * Parser la réponse de l'API
     */
    private function parseArticleResponse(string $content, array $data): array
    {
        // Extraire le titre H1
        preg_match('/<h1>(.*?)<\/h1>/i', $content, $titleMatch);
        $title = $titleMatch[1] ?? "Découvrez {$data['business_name']}";
        
        // Extraire la meta description - amélioré
        preg_match('/Meta description :\s*(.*?)(?=\n|<\/p>|$)/i', $content, $metaMatch);
        
        if (empty($metaMatch)) {
            // Fallback : générer depuis le contenu
            $cleanContent = strip_tags($content);
            $metaDescription = substr($cleanContent, 0, 160);
        } else {
            $metaDescription = trim($metaMatch[1]);
        }
        
        // Nettoyer les balises HTML de la meta description
        $metaDescription = strip_tags($metaDescription);
        
        // Extraire le mot-clé principal
        preg_match('/Mot-clé principal :\s*(.*?)(?=\n|<\/p>)/i', $content, $keywordMatch);
        $focusKeyword = $keywordMatch[1] ?? $data['topic'] ?? $data['business_name'];
        
        // Nettoyer le contenu (supprimer les div meta et image-suggestions)
        $cleanContent = preg_replace('/<div class="meta">.*?<\/div>/s', '', $content);
        $cleanContent = preg_replace('/<div class="image-suggestions">.*?<\/div>/s', '', $cleanContent);
        
        return [
            'success' => true,
            'title' => trim($title),
            'content' => $cleanContent,
            'meta_description' => trim($metaDescription),
            'focus_keyword' => trim($focusKeyword),
            'word_count' => str_word_count(strip_tags($cleanContent)),
            'is_fallback' => false,
            'error' => null
        ];
    }
    
    /**
     * Nettoyer le contenu HTML
     */
    private function cleanContent(string $content): string
    {
        $content = preg_replace('/<div class="meta">.*?<\/div>/s', '', $content);
        $content = preg_replace('/<div class="image-suggestions">.*?<\/div>/s', '', $content);
        return $content;
    }
    
    /**
     * Article de fallback quand l'API ne répond pas
     */
    private function getFallbackArticle(array $data, string $error = ''): array
    {
        Log::warning('Using fallback article generation', [
            'error' => $error,
            'business_name' => $data['business_name'] ?? 'unknown'
        ]);
        
        $businessName = $data['business_name'] ?? 'Notre commerce';
        $address = $data['address'] ?? 'notre adresse';
        $hours = $data['hours'] ?? 'nos horaires';
        
        $content = <<<HTML
<article>
<h1>Découvrez {$businessName} - Votre expert local</h1>

<div class="alert alert-warning">
<strong>Note :</strong> Mode dégradé. L'API Gemini n'est pas accessible actuellement.
<br>
<strong>Erreur technique :</strong> {$error}
</div>

<h2>Introduction</h2>
<p>Bienvenue chez <strong>{$businessName}</strong>, votre référence locale. Nous sommes ravis de vous accueillir et de vous faire découvrir nos services.</p>

<h2>Pourquoi choisir {$businessName} ?</h2>
<p>Notre équipe d'experts met tout en œuvre pour vous offrir la meilleure expérience. Qualité, professionnalisme et proximité sont nos maîtres-mots.</p>

<h2>Où nous trouver</h2>
<p><strong>Adresse :</strong> {$address}</p>

<h2>Horaires d'ouverture</h2>
<p><strong>Nos horaires :</strong> {$hours}</p>

<h2>Questions fréquentes</h2>
<div class="faq-item">
<p><strong>Question : Quels sont vos horaires ?</strong></p>
<p>Réponse : {$hours}</p>
</div>

<h2>Conclusion</h2>
<p>N'hésitez pas à nous rendre visite à {$address} !</p>
</article>
HTML;
        
        return [
            'success' => true,
            'title' => "Découvrez {$businessName}",
            'content' => $content,
            'meta_description' => "Découvrez {$businessName} à {$address}",
            'focus_keyword' => $businessName,
            'word_count' => str_word_count(strip_tags($content)),
            'is_fallback' => true,
            'error' => $error
        ];
    }
    
    /**
     * Analyser le SEO d'un article existant
     */
    public function analyzeSeo(string $content, string $keyword = ''): array
    {
        $wordCount = str_word_count(strip_tags($content));
        $keywordCount = $keyword ? substr_count(strtolower($content), strtolower($keyword)) : 0;
        $keywordDensity = ($wordCount > 0 && $keywordCount > 0) ? round(($keywordCount / $wordCount) * 100, 2) : 0;
        
        $hasHeadings = preg_match('/<h[2-3]/i', $content);
        $hasImages = preg_match('/<img/i', $content);
        $hasInternalLinks = preg_match('/<a\s+href=["\']\/(?!https?:\/\/)/i', $content);
        $hasExternalLinks = preg_match('/<a\s+href=["\']https?:\/\//i', $content);
        
        $score = 50;
        if ($wordCount >= 1200) $score += 20;
        elseif ($wordCount >= 800) $score += 15;
        elseif ($wordCount >= 500) $score += 10;
        
        if ($keywordDensity >= 0.8 && $keywordDensity <= 1.5) $score += 15;
        elseif ($keywordCount > 0) $score += 5;
        
        if ($hasHeadings) $score += 10;
        if ($hasImages) $score += 10;
        if ($hasInternalLinks) $score += 5;
        if ($hasExternalLinks) $score += 5;
        
        $score = min($score, 100);
        
        $recommendations = [];
        if ($wordCount < 800) $recommendations[] = "Augmentez la longueur à 800+ mots";
        if ($keywordDensity < 0.5 && $keyword) $recommendations[] = "Utilisez plus le mot-clé '{$keyword}'";
        if (!$hasHeadings) $recommendations[] = "Ajoutez des sous-titres (H2, H3)";
        if (!$hasImages) $recommendations[] = "Ajoutez des images pertinentes";
        if (!$hasInternalLinks) $recommendations[] = "Ajoutez des liens internes";
        if (!$hasExternalLinks) $recommendations[] = "Ajoutez des liens externes";
        
        if (empty($recommendations)) {
            $recommendations[] = "Excellent ! Cet article est bien optimisé SEO.";
        }
        
        return [
            'score' => $score,
            'word_count' => $wordCount,
            'keyword_count' => $keywordCount,
            'keyword_density' => $keywordDensity,
            'has_headings' => $hasHeadings,
            'has_images' => $hasImages,
            'has_internal_links' => $hasInternalLinks,
            'has_external_links' => $hasExternalLinks,
            'recommendations' => $recommendations,
            'needs_improvement' => $score < 70
        ];
    }
    
    /**
     * Suggérer des mots-clés SEO
     */
    public function suggestKeywords(string $topic, string $location = ''): array
    {
        $prompt = "Génère 10 mots-clés SEO pertinents pour '{$topic}'" . ($location ? " à {$location}" : "") . ".
        
        Format: retourne uniquement un tableau JSON comme ceci:
        [\"mot-clé 1\", \"mot-clé 2\", ...]";
        
        try {
            $response = Http::timeout(60)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => ['temperature' => 0.7]
                ]);
            
            if ($response->successful()) {
                $text = $response->json('candidates.0.content.parts.0.text') ?? '';
                preg_match('/\[.*\]/s', $text, $matches);
                if (!empty($matches)) {
                    $keywords = json_decode($matches[0], true);
                    if (is_array($keywords) && count($keywords) > 0) {
                        return $keywords;
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Keyword suggestion error: ' . $e->getMessage());
        }
        
        return [
            $topic,
            "meilleur {$topic}",
            "guide {$topic}",
            "prix {$topic}",
            "avis {$topic}",
            "{$topic} pas cher",
            "comment choisir {$topic}",
            "top {$topic}",
            "{$topic} 2026",
            "{$topic} professionnel"
        ];
    }
}