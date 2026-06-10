<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private string $apiKey;
    private string $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';
    
    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key', '');
    }
    
    /**
     * Générer un article complet
     */
    public function generateArticle(string $subject, ?string $website, ?string $address, string $length = 'medium'): ?string
    {
        $lengthMap = [
            'short' => 'environ 500 mots',
            'medium' => 'environ 1000 mots',
            'long' => 'environ 1500 mots'
        ];
        
        $prompt = "Rédige un article de blog SEO optimisé de {$lengthMap[$length]} sur le sujet : '{$subject}'. 
        L'entreprise a pour site web : " . ($website ?? 'Non spécifié') . " et est située à l'adresse : " . ($address ?? 'Non spécifiée') . ".
        
        L'article doit :
        1. Être structuré avec des titres H1, H2, H3
        2. Inclure naturellement des mots-clés locaux
        3. Avoir une introduction accrocheuse et une conclusion avec appel à l'action
        4. Être rédigé dans un ton professionnel mais accessible
        5. Mentionner l'adresse de façon naturelle
        
        Retourne uniquement le contenu HTML de l'article (sans balise html/body).";
        
        return $this->callGemini($prompt);
    }
    
    /**
     * Reformuler pour les réseaux sociaux
     */
    public function rewriteForSocial(string $content, string $platform): ?string
    {
        $platforms = [
            'instagram' => 'Courte légende Instagram avec hashtags pertinents (max 2200 caractères)',
            'twitter' => 'Tweet percutant avec emojis (max 280 caractères)',
            'linkedin' => 'Post LinkedIn professionnel qui met en avant l\'expertise (max 3000 caractères)',
            'facebook' => 'Post Facebook engageant qui invite au partage (max 2000 caractères)'
        ];
        
        $prompt = "Reformule le contenu suivant pour {$platforms[$platform]}. 
        
        Contenu original : {$content}
        
        Retourne uniquement le texte reformulé, sans explications supplémentaires.";
        
        return $this->callGemini($prompt);
    }
    
    /**
     * Optimiser le SEO d'un article
     */
    public function optimizeSeo(string $content, string $keyword): ?string
    {
        $prompt = "Optimise le contenu suivant pour le mot-clé '{$keyword}'.
        
        Contenu à optimiser : {$content}
        
        Améliore :
        - La densité du mot-clé (entre 1% et 3%)
        - La structure des titres (H1, H2, H3)
        - Ajoute une méta-description optimisée
        - Propose des suggestions de liens internes
        
        Retourne le contenu optimisé en HTML, avec les améliorations intégrées directement.";
        
        return $this->callGemini($prompt);
    }
    
    /**
     * Appeler l'API Gemini
     */
    private function callGemini(string $prompt): ?string
    {
        if (empty($this->apiKey)) {
            Log::error('Gemini API Key manquante');
            return null;
        }
        
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(60)->post("{$this->apiUrl}?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 4096,
                ]
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            }
            
            Log::error('Gemini API Error: ' . $response->body());
            return null;
            
        } catch (\Exception $e) {
            Log::error('Gemini Exception: ' . $e->getMessage());
            return null;
        }
    }
}