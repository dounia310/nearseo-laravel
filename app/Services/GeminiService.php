<?php

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
    protected ContentCleanerService $cleaner;

    public function __construct(ContentCleanerService $cleaner)
    {
        $this->cleaner = $cleaner;
        $this->apiKey = config('services.gemini.api_key');
        $this->model = config('services.gemini.model', 'gemini-1.5-flash');
        $this->timeout = config('services.gemini.timeout', 45);
        $this->retryTimes = config('services.gemini.retry_times', 2);
        $this->retryMs = config('services.gemini.retry_milliseconds', 1500);
    }

    /**
     * Générer un article SEO premium
     * ✅ Sans fallback — Gemini uniquement
     * ✅ set_time_limit étendu
     * ✅ Gestion d'erreur propre
     */
    public function generateArticle(array $data): array
    {
        // ✅ Autoriser 3 minutes
        set_time_limit(180);
        ini_set('max_execution_time', 180);

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";

        Log::info('Gemini Generate Article Start', [
            'business_name' => $data['business_name'] ?? 'unknown',
            'mode' => $data['mode'] ?? 'unknown',
            'model' => $this->model
        ]);

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
                        'temperature' => 0.85,
                        'maxOutputTokens' => 8000,
                        'topP' => 0.95,
                        'responseMimeType' => 'application/json',
                    ]
                ]);

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? 'Erreur HTTP: ' . $response->status();
                Log::error('Gemini API Error Response', [
                    'status' => $response->status(),
                    'error' => $error
                ]);

                return [
                    'success' => false,
                    'error' => $error,
                    'code' => $response->status(),
                    'is_fallback' => false,
                ];
            }

            $content = $response->json('candidates.0.content.parts.0.text') ?? '';

            if (empty($content)) {
                Log::warning('Gemini returned empty content');
                return [
                    'success' => false,
                    'error' => 'Contenu vide retourné par l\'API',
                    'code' => 'empty_content',
                    'is_fallback' => false,
                ];
            }

            Log::info('Gemini article generated successfully', [
                'content_length' => strlen($content),
                'business_name' => $data['business_name'] ?? 'unknown'
            ]);

            $parsed = $this->parseArticleResponse($content, $data);

            if ($parsed['success']) {
                $parsed['content'] = $this->cleaner->clean($parsed['content']);
                $parsed['title'] = $this->cleaner->cleanTitle($parsed['title']);
                $parsed['meta_description'] = $this->cleaner->cleanMetaDescription($parsed['meta_description']);
            }

            return $parsed;

        } catch (\Exception $e) {
            Log::error('Gemini Exception during generation', [
                'message' => $e->getMessage(),
                'class' => get_class($e),
                'code' => $e->getCode()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
                'code' => 'exception',
                'is_fallback' => false,
            ];
        }
    }

    /**
     * ✅ Prompt simplifié et efficace
     */
    private function buildPremiumPrompt(array $data): string
    {
        $businessName = $data['business_name'] ?? 'Notre commerce';
        $topic = $data['topic'] ?? $businessName;
        $address = $data['address'] ?? '';
        $website = $data['website'] ?? '';
        $city = $data['geo_ville'] ?? '';
        $country = $data['geo_pays'] ?? 'Maroc';
        $language = $data['language'] ?? 'Français';
        $tone = $data['tone'] ?? 'Professionnel';
        $format = $data['format'] ?? 'medium';
        $goals = isset($data['goals']) && is_array($data['goals']) ? implode(', ', $data['goals']) : '';
        $keyword = $data['business_name'] ?? $topic;

        $wordCount = match($format) {
            'short' => 800,
            'medium' => 1200,
            'long' => 1600,
            default => 1200
        };

        $locationText = $city ? "{$city}, {$country}" : $country;
        $addressLine = $address ? "Adresse: {$address} | " : "";
        $websiteLine = $website ? "Site: {$website} | " : "";
        $goalsLine = $goals ? "Objectifs: {$goals}" : "";

        return <<<PROMPT
Tu es un rédacteur humain expert EEAT en {$topic} avec 15 ans d'expérience terrain à {$city}.

DONNÉES:
Commerce: {$businessName} | {$websiteLine}{$addressLine}Ville: {$locationText}
{$goalsLine}

MISSION: Rédige un article en {$language} qui doit être PLUS utile que les 10 premiers résultats Google sur "{$topic}".
Longueur cible: {$wordCount} mots. Ton: {$tone}.

RÈGLES ANTI-AI STRICTES:
- Interdit: "Dans le monde...", "Il est important de", "En conclusion", "plongez dans", "découvrez".
- Raconte 1 anecdote réelle terrain (invente une situation crédible).
- 1 paragraphe = 2 lignes max.
- Utilise des H2 sous forme de vraies questions utilisateurs (People Also Ask).
- Ajoute 1 lien interne vers {$website} et 2 liens externes vers sources fiables (Wikipedia, .gouv).
- Ajoute une section FAQ avec 3 questions en H3.

RÈGLES CRITIQUES POUR LE H1:
- Le <h1> doit être COURT (60 caractères MAX)
- NE JAMAIS mettre le contenu dans le H1
- Le H1 est juste un titre accrocheur

STRUCTURE HTML OBLIGATOIRE dans le champ "content":
- <h1> (court, 60 caractères max)
- <p> introduction avec accroche émotionnelle
- <h2> pour chaque section (au moins 4)
- <h3> pour les sous-sections
- <ul> ou <ol> pour les listes
- <strong> pour les points clés
- <a href="..."> pour les liens

RÉPONDS UNIQUEMENT EN JSON VALIDE selon ce schéma exact:

{
  "title": "Titre SEO 55 caractères max, bénéfice concret",
  "meta_description": "Meta description 155 caractères max, avec verbe d'action et phrase complète",
  "h1": "H1 court différent du title, avec émotion (60 car max)",
  "content": "HTML complet avec <h1>, <h2>, <h3>, <p>, <ul>, <li>, <a href='{$website}'>, <strong>",
  "keywords": ["mot-clé principal", "secondaire1", "secondaire2", "secondaire3", "secondaire4"]
}

CONTRAINTES:
- title: 55 caractères MAX
- meta_description: 155 caractères MAX
- h1: 60 caractères MAX
- content: HTML pur (pas de markdown)
- keywords: 5 mots-clés sémantiques
PROMPT;
    }

    /**
     * ✅ Parser la réponse JSON avec protections
     */
    private function parseArticleResponse(string $content, array $data): array
    {
        // Nettoyer le contenu
        $content = trim($content);
        $content = preg_replace('/^```json\s*/i', '', $content);
        $content = preg_replace('/\s*```$/', '', $content);
        $content = trim($content);

        // Forcer l'extraction du JSON
        if (preg_match('/\{.*\}/s', $content, $matches)) {
            $content = $matches[0];
        }

        // Décoder le JSON
        $jsonData = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE || !isset($jsonData['content'])) {
            Log::warning('Gemini JSON parse failed', [
                'error' => json_last_error_msg(),
                'content_preview' => substr($content, 0, 500)
            ]);

            return [
                'success' => false,
                'error' => 'Réponse JSON invalide de Gemini',
                'code' => 'json_parse_error',
                'is_fallback' => false,
            ];
        }

        $title = $jsonData['title'] ?? $data['topic'] ?? 'Article';
        $metaDescription = $jsonData['meta_description'] ?? '';
        $mainContent = $jsonData['content'] ?? '';
        $h1 = $jsonData['h1'] ?? '';

        // ✅ Vérifier que le H1 est court
        if (!empty($h1) && mb_strlen($h1) > 60) {
            // Extraire juste la première phrase
            $h1Lines = preg_split('/[.\n]/', $h1);
            $h1 = trim($h1Lines[0] ?? $h1);
            if (mb_strlen($h1) > 60) {
                $h1 = mb_substr($h1, 0, 57) . '...';
            }
        }

        // ✅ Vérifier si le H1 dans le content est trop long
        if (preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $mainContent, $h1InContent)) {
            $h1Text = trim(strip_tags($h1InContent[1]));
            if (mb_strlen($h1Text) > 60) {
                // Extraire la première phrase
                $firstSentence = preg_split('/[.\n]/', $h1Text)[0];
                $shortTitle = mb_substr(trim($firstSentence), 0, 57);
                
                // Remplacer le H1 long par un H1 court
                $mainContent = preg_replace(
                    '/<h1[^>]*>.*?<\/h1>/is',
                    '<h1>' . $shortTitle . '</h1>',
                    $mainContent,
                    1
                );
            }
        }

        // ✅ Ajouter le H1 si absent
        if (!empty($h1) && stripos($mainContent, '<h1') === false) {
            $mainContent = '<h1>' . $h1 . '</h1>' . "\n" . $mainContent;
        }

        // Si pas de meta description, en générer une
        if (empty($metaDescription)) {
            $plainText = strip_tags($mainContent);
            $metaDescription = mb_substr(trim($plainText), 0, 155);
        }

        return [
            'success' => true,
            'title' => trim($title),
            'content' => trim($mainContent),
            'meta_description' => trim($metaDescription),
            'focus_keyword' => trim($data['business_name'] ?? $data['topic'] ?? ''),
            'keywords' => $jsonData['keywords'] ?? [],
            'word_count' => str_word_count(strip_tags($mainContent)),
            'is_fallback' => false,
            'error' => null
        ];
    }

    /**
     * ✅ Analyse SEO moderne (sans densité de mots-clés)
     */
    public function analyzeSeo(string $content, string $keyword = '', string $city = ''): array
    {
        $wordCount = str_word_count(strip_tags($content));
        $plainText = strtolower(strip_tags($content));

        $hasH1 = preg_match('/<h1/i', $content);
        $hasH2 = preg_match('/<h2/i', $content);
        $hasH3 = preg_match('/<h3/i', $content);
        $hasFAQ = preg_match('/faq|question|foire aux questions/i', $content);
        $hasLists = preg_match('/<ul|<ol/i', $content);
        $hasImages = preg_match('/<img/i', $content);
        $hasInternalLinks = preg_match('/<a\s+href=["\']\/(?!https?:\/\/)/i', $content);
        $hasExternalLinks = preg_match('/<a\s+href=["\']https?:\/\//i', $content);
        $hasCityMention = $city ? (stripos($plainText, strtolower($city)) !== false) : false;
        $hasKeywordInFirstParagraph = false;

        if (preg_match('/<p[^>]*>(.*?)<\/p>/is', $content, $pMatch)) {
            $hasKeywordInFirstParagraph = stripos($pMatch[1], $keyword) !== false;
        }

        $score = 0;

        if ($wordCount >= 1200) $score += 20;
        elseif ($wordCount >= 800) $score += 15;
        elseif ($wordCount >= 500) $score += 10;
        elseif ($wordCount >= 300) $score += 5;

        if ($hasH1) $score += 5;
        if ($hasH2) $score += 10;
        if ($hasH3) $score += 5;
        if ($hasLists) $score += 5;

        if ($hasFAQ) $score += 15;

        if ($hasInternalLinks) $score += 8;
        if ($hasExternalLinks) $score += 7;

        if ($hasCityMention) $score += 10;

        if ($hasImages) $score += 10;

        if ($hasKeywordInFirstParagraph) $score += 5;

        $score = min($score, 100);

        $recommendations = [];
        if ($wordCount < 800) $recommendations[] = "Augmentez la longueur à 800+ mots";
        if (!$hasH2) $recommendations[] = "Ajoutez des H2 sous forme de questions";
        if (!$hasH3) $recommendations[] = "Ajoutez des H3 pour structurer";
        if (!$hasFAQ) $recommendations[] = "Ajoutez une section FAQ (signal EEAT)";
        if (!$hasInternalLinks) $recommendations[] = "Ajoutez des liens internes";
        if (!$hasExternalLinks) $recommendations[] = "Ajoutez 2 liens externes fiables";
        if (!$hasCityMention && $city) $recommendations[] = "Mentionnez {$city} pour le SEO local";
        if (!$hasImages) $recommendations[] = "Ajoutez des images avec ALT";
        if (!$hasKeywordInFirstParagraph) $recommendations[] = "Placez le mot-clé dans le 1er paragraphe";

        if (empty($recommendations)) {
            $recommendations[] = "Excellent ! Contenu prêt à ranker.";
        }

        $grade = match(true) {
            $score >= 90 => 'A+',
            $score >= 80 => 'A',
            $score >= 70 => 'B',
            $score >= 60 => 'C',
            $score >= 50 => 'D',
            default => 'F',
        };

        return [
            'score' => $score,
            'grade' => $grade,
            'word_count' => $wordCount,
            'has_headings' => $hasH2,
            'has_faq' => $hasFAQ,
            'has_images' => $hasImages,
            'has_internal_links' => $hasInternalLinks,
            'has_external_links' => $hasExternalLinks,
            'has_local_entity' => $hasCityMention,
            'recommendations' => $recommendations,
            'needs_improvement' => $score < 70
        ];
    }

    /**
     * Suggérer des mots-clés SEO
     */
    public function suggestKeywords(string $topic, string $location = ''): array
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";

        $prompt = "Génère 10 mots-clés SEO pertinents pour '{$topic}'" . ($location ? " à {$location}" : "") . ".
        
        Format: retourne UNIQUEMENT un tableau JSON comme ceci:
        [\"mot-clé 1\", \"mot-clé 2\", ...]";

        try {
            $response = Http::timeout(30)
                ->post($url, [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'responseMimeType' => 'application/json',
                    ]
                ]);

            if ($response->successful()) {
                $text = $response->json('candidates.0.content.parts.0.text') ?? '';
                $keywords = json_decode($text, true);
                if (is_array($keywords) && count($keywords) > 0) {
                    return $keywords;
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