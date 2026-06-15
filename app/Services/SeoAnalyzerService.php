<?php
// app/Services/SeoAnalyzerService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SeoAnalyzerService
{
    private ?GeminiService $gemini;
    
    public function __construct(?GeminiService $gemini = null)
    {
        $this->gemini = $gemini;
    }
    
    /**
     * Analyse SEO complète d'un article
     */
    public function analyze(string $content, ?string $title = null, ?string $keyword = null): array
    {
        $score = 30;
        $suggestions = [];
        $positives = [];
        $details = [];
        
        $wordCount = str_word_count(strip_tags($content));
        $contentClean = strip_tags($content);
        
        // ==================== 1. ANALYSE DU CONTENU ====================
        
        // Longueur du contenu (0-20 points)
        $lengthScore = 0;
        if ($wordCount > 1500) {
            $lengthScore = 20;
            $positives[] = "📝 Excellent contenu ! {$wordCount} mots, très complet.";
            $details['length'] = ['score' => 20, 'value' => $wordCount, 'status' => 'excellent'];
        } elseif ($wordCount > 1000) {
            $lengthScore = 18;
            $positives[] = "✅ Bonne longueur : {$wordCount} mots (>1000 recommandé)";
            $details['length'] = ['score' => 18, 'value' => $wordCount, 'status' => 'good'];
        } elseif ($wordCount > 600) {
            $lengthScore = 12;
            $suggestions[] = "📏 Contenu de {$wordCount} mots. Visez 1000+ mots pour un meilleur référencement.";
            $details['length'] = ['score' => 12, 'value' => $wordCount, 'status' => 'medium'];
        } elseif ($wordCount > 300) {
            $lengthScore = 6;
            $suggestions[] = "⚠️ Contenu court ({$wordCount} mots). Ajoutez au moins 300 mots supplémentaires.";
            $details['length'] = ['score' => 6, 'value' => $wordCount, 'status' => 'low'];
        } else {
            $suggestions[] = "🔴 Contenu très insuffisant ({$wordCount} mots). Minimum 500 mots requis.";
            $details['length'] = ['score' => 0, 'value' => $wordCount, 'status' => 'critical'];
        }
        $score += $lengthScore;
        
        // ==================== 2. ANALYSE DU TITRE ====================
        
        $titleScore = 0;
        if ($title && !empty($title)) {
            $titleLen = strlen($title);
            $titleWords = str_word_count($title, 1);
            
            if ($titleLen >= 30 && $titleLen <= 60) {
                $titleScore = 15;
                $positives[] = "🎯 Titre parfaitement optimisé ({$titleLen} caractères)";
                $details['title'] = ['score' => 15, 'length' => $titleLen, 'status' => 'perfect'];
            } elseif ($titleLen >= 20 && $titleLen <= 70) {
                $titleScore = 10;
                $positives[] = "✅ Titre correct ({$titleLen} caractères)";
                $suggestions[] = "💡 Idéalement 30-60 caractères pour le titre (actuellement {$titleLen})";
                $details['title'] = ['score' => 10, 'length' => $titleLen, 'status' => 'good'];
            } else {
                $titleScore = 5;
                $suggestions[] = "📌 Longueur du titre : {$titleLen} caractères. Visez 30-60 caractères.";
                $details['title'] = ['score' => 5, 'length' => $titleLen, 'status' => 'poor'];
            }
            
            // Vérification des mots puissants dans le titre
            $powerWords = ['Guide', 'Ultime', 'Complet', 'Expert', 'Top', 'Meilleur', '2026', 'Découvrez', 'Secret', 'Astuces'];
            $foundPowerWords = [];
            foreach ($powerWords as $pw) {
                if (stripos($title, $pw) !== false) {
                    $foundPowerWords[] = $pw;
                }
            }
            if (count($foundPowerWords) > 0) {
                $titleScore += 3;
                $positives[] = "⚡ Mots puissants dans le titre : " . implode(', ', $foundPowerWords);
                $details['title_power_words'] = $foundPowerWords;
            }
        } else {
            $suggestions[] = "🏷️ Ajoutez un titre H1 optimisé (30-60 caractères)";
            $details['title'] = ['score' => 0, 'status' => 'missing'];
        }
        $score += $titleScore;
        
        // ==================== 3. ANALYSE DU MOT-CLÉ ====================
        
        $keywordScore = 0;
        if ($keyword && !empty($keyword)) {
            $keywordCount = substr_count(strtolower($contentClean), strtolower($keyword));
            $keywordDensity = ($wordCount > 0) ? round(($keywordCount / $wordCount) * 100, 2) : 0;
            
            if ($keywordDensity >= 0.8 && $keywordDensity <= 1.5) {
                $keywordScore = 20;
                $positives[] = "🔑 Densité idéale du mot-clé '{$keyword}' : {$keywordDensity}% (apparu {$keywordCount} fois)";
                $details['keyword'] = ['score' => 20, 'density' => $keywordDensity, 'count' => $keywordCount, 'status' => 'perfect'];
            } elseif ($keywordDensity > 0 && $keywordDensity < 3) {
                $keywordScore = 12;
                $positives[] = "✅ Mot-clé '{$keyword}' présent {$keywordCount} fois (densité {$keywordDensity}%)";
                if ($keywordDensity < 0.8) {
                    $suggestions[] = "📈 Augmentez légèrement l'utilisation du mot-clé '{$keyword}' (densité idéale 1-1.5%)";
                } else {
                    $suggestions[] = "🎯 Densité mot-clé à {$keywordDensity}%. Idéalement 1-1.5%";
                }
                $details['keyword'] = ['score' => 12, 'density' => $keywordDensity, 'count' => $keywordCount, 'status' => 'good'];
            } elseif ($keywordCount > 0) {
                $keywordScore = 8;
                $suggestions[] = "🔍 Mot-clé '{$keyword}' peu utilisé (apparu {$keywordCount} fois). Visez 1-1.5% de densité.";
                $details['keyword'] = ['score' => 8, 'density' => $keywordDensity, 'count' => $keywordCount, 'status' => 'low'];
            } else {
                $suggestions[] = "🎯 Mot-clé '{$keyword}' absent du contenu. Intégrez-le naturellement.";
                $details['keyword'] = ['score' => 0, 'count' => 0, 'status' => 'missing'];
            }
            
            // Vérification dans le premier paragraphe
            $firstParagraph = substr($contentClean, 0, 200);
            if (stripos($firstParagraph, $keyword) !== false) {
                $keywordScore += 5;
                $positives[] = "✓ Mot-clé présent dans l'introduction (SEO important)";
                $details['keyword_first_paragraph'] = true;
            } else {
                $suggestions[] = "📝 Placez le mot-clé '{$keyword}' dans les 100 premiers mots.";
            }
        } else {
            $suggestions[] = "🔑 Définissez un mot-clé principal pour améliorer le référencement.";
            $details['keyword'] = ['status' => 'undefined'];
        }
        $score += $keywordScore;
        
        // ==================== 4. ANALYSE DE LA STRUCTURE ====================
        
        $structureScore = 0;
        $hasH1 = preg_match('/<h1/i', $content);
        $hasH2 = preg_match('/<h2/i', $content);
        $hasH3 = preg_match('/<h3/i', $content);
        $headingCount = count(preg_grep('/<h[1-6]/i', explode("\n", $content)));
        
        if ($hasH1 && $hasH2) {
            $structureScore += 10;
            $positives[] = "📚 Structure hiérarchique correcte (H1 + H2 présents)";
            if ($headingCount >= 5) {
                $structureScore += 5;
                $positives[] = "🏗️ Excellente structure avec {$headingCount} titres (H1, H2, H3)";
            }
            $details['structure'] = ['score' => 15, 'headings' => $headingCount, 'status' => 'good'];
        } elseif ($hasH1 || $hasH2) {
            $structureScore += 5;
            $suggestions[] = "🏗️ Structure à améliorer : ajoutez des sous-titres H2 et H3.";
            $details['structure'] = ['score' => 5, 'headings' => $headingCount, 'status' => 'poor'];
        } else {
            $suggestions[] = "📋 Structure manquante : utilisez H1 pour le titre, H2 pour les sections, H3 pour les sous-sections.";
            $details['structure'] = ['score' => 0, 'status' => 'missing'];
        }
        
        // Vérification des balises de liste
        if (preg_match('/<ul|<ol/i', $content)) {
            $structureScore += 5;
            $positives[] = "✓ Utilisation de listes (améliore la lisibilité)";
            $details['has_lists'] = true;
        }
        $score += $structureScore;
        
        // ==================== 5. ANALYSE DES MÉDIAS ====================
        
        $mediaScore = 0;
        $imageCount = preg_match_all('/<img/i', $content, $matches);
        
        if ($imageCount >= 3) {
            $mediaScore = 15;
            $positives[] = "🖼️ Excellente utilisation des images ({$imageCount} images)";
            $details['media'] = ['score' => 15, 'images' => $imageCount, 'status' => 'excellent'];
        } elseif ($imageCount >= 1) {
            $mediaScore = 10;
            $positives[] = "✅ {$imageCount} image(s) présente(s) dans l'article";
            if ($imageCount < 3) {
                $suggestions[] = "📸 Ajoutez plus d'images (3+ recommandé) pour améliorer l'engagement.";
            }
            $details['media'] = ['score' => 10, 'images' => $imageCount, 'status' => 'good'];
        } else {
            $suggestions[] = "🖼️ Aucune image détectée. Ajoutez des images avec des balises ALT optimisées.";
            $details['media'] = ['score' => 0, 'images' => 0, 'status' => 'missing'];
        }
        
        // Vérification des balises ALT
        $hasAlt = preg_match('/alt=["\'][^"\']*["\']/i', $content);
        if ($imageCount > 0 && $hasAlt) {
            $mediaScore += 5;
            $positives[] = "✓ Balises ALT présentes sur les images (bon pour l'accessibilité)";
            $details['has_alt_tags'] = true;
        } elseif ($imageCount > 0) {
            $suggestions[] = "🏷️ Ajoutez des balises ALT descriptives sur vos images.";
        }
        $score += $mediaScore;
        
        // ==================== 6. ANALYSE DES LIENS ====================
        
        $linksScore = 0;
        $internalLinks = preg_match_all('/<a\s+href=["\']\/(?!https?:\/\/)/i', $content, $internalMatches);
        $externalLinks = preg_match_all('/<a\s+href=["\']https?:\/\//i', $content, $externalMatches);
        
        if ($internalLinks >= 3 && $externalLinks >= 2) {
            $linksScore = 15;
            $positives[] = "🔗 Excellent maillage : {$internalLinks} liens internes, {$externalLinks} liens externes";
            $details['links'] = ['score' => 15, 'internal' => $internalLinks, 'external' => $externalLinks, 'status' => 'excellent'];
        } elseif ($internalLinks >= 2 || $externalLinks >= 2) {
            $linksScore = 10;
            $positives[] = "✅ Liens présents : {$internalLinks} interne(s), {$externalLinks} externe(s)";
            if ($internalLinks < 2) $suggestions[] = "🔗 Ajoutez plus de liens internes vers d'autres articles de votre site.";
            if ($externalLinks < 2) $suggestions[] = "🌐 Ajoutez des liens externes vers des sources fiables (autorité).";
            $details['links'] = ['score' => 10, 'internal' => $internalLinks, 'external' => $externalLinks, 'status' => 'good'];
        } elseif ($internalLinks > 0 || $externalLinks > 0) {
            $linksScore = 5;
            $suggestions[] = "🔗 Maillage insuffisant. Ajoutez au moins 2 liens internes et 2 liens externes.";
            $details['links'] = ['score' => 5, 'internal' => $internalLinks, 'external' => $externalLinks, 'status' => 'poor'];
        } else {
            $suggestions[] = "🔗 Aucun lien détecté. Le maillage est crucial pour le SEO.";
            $details['links'] = ['score' => 0, 'status' => 'missing'];
        }
        $score += $linksScore;
        
        // ==================== 7. ANALYSE DE LA LISIBILITÉ ====================
        
        $readabilityScore = 0;
        $sentences = preg_split('/[.!?]+/', $contentClean);
        $avgSentenceLength = count($words ?? []) > 0 ? count($words) / max(1, count($sentences)) : 0;
        
        if ($avgSentenceLength > 0) {
            if ($avgSentenceLength <= 15) {
                $readabilityScore = 10;
                $positives[] = "📖 Excellent ! Phrases courtes et percutantes (moyenne {$avgSentenceLength} mots)";
                $details['readability'] = ['score' => 10, 'avg_sentence' => round($avgSentenceLength, 1), 'status' => 'excellent'];
            } elseif ($avgSentenceLength <= 20) {
                $readabilityScore = 7;
                $positives[] = "✅ Bonne lisibilité, phrases de longueur correcte (moyenne {$avgSentenceLength} mots)";
                $details['readability'] = ['score' => 7, 'avg_sentence' => round($avgSentenceLength, 1), 'status' => 'good'];
            } elseif ($avgSentenceLength <= 25) {
                $readabilityScore = 4;
                $suggestions[] = "📖 Phrases un peu longues (moyenne {$avgSentenceLength} mots). Visez 15-20 mots par phrase.";
                $details['readability'] = ['score' => 4, 'avg_sentence' => round($avgSentenceLength, 1), 'status' => 'medium'];
            } else {
                $suggestions[] = "⚠️ Phrases trop longues (moyenne {$avgSentenceLength} mots). Raccourcissez pour améliorer la lisibilité.";
                $details['readability'] = ['score' => 0, 'avg_sentence' => round($avgSentenceLength, 1), 'status' => 'poor'];
            }
        }
        $score += $readabilityScore;
        
        // ==================== 8. SCORE FINAL ET GRADE ====================
        
        $score = min($score, 100);
        
        // Détermination du grade
        $grade = 'F';
        $gradeColor = 'red';
        if ($score >= 90) {
            $grade = 'A+';
            $gradeColor = 'green';
            $message = "🏆 Exceptionnel ! Cet article est parfaitement optimisé SEO.";
        } elseif ($score >= 80) {
            $grade = 'A';
            $gradeColor = 'green';
            $message = "🎉 Excellent travail ! L'article est très bien optimisé.";
        } elseif ($score >= 70) {
            $grade = 'B';
            $gradeColor = 'blue';
            $message = "👍 Bon article ! Quelques petites améliorations suffisent.";
        } elseif ($score >= 60) {
            $grade = 'C';
            $gradeColor = 'yellow';
            $message = "📈 Correct. Appliquez les recommandations pour atteindre 80+.";
        } elseif ($score >= 50) {
            $grade = 'D';
            $gradeColor = 'orange';
            $message = "⚠️ À améliorer. Suivez les suggestions ci-dessous.";
        } else {
            $grade = 'F';
            $gradeColor = 'red';
            $message = "🔴 Score SEO faible. Besoin d'une optimisation importante.";
        }
        
        // ==================== 9. RECOMMANDATIONS AVEC IA (optionnel) ====================
        
        $aiRecommendations = [];
        if ($this->gemini && ($score < 70 || count($suggestions) > 3)) {
            try {
                $aiResult = $this->gemini->analyzeSeo($content, $keyword);
                $aiRecommendations = $aiResult['recommendations'] ?? [];
            } catch (\Exception $e) {
                Log::warning('AI SEO analysis failed: ' . $e->getMessage());
            }
        }
        
        return [
            'score' => $score,
            'grade' => $grade,
            'grade_color' => $gradeColor,
            'message' => $message,
            'suggestions' => $suggestions,
            'positives' => $positives,
            'ai_recommendations' => $aiRecommendations,
            'word_count' => $wordCount,
            'details' => $details,
            'needs_improvement' => $score < 70,
            'is_excellent' => $score >= 85,
            'checklist' => [
                'title_optimized' => isset($details['title']) && $details['title']['status'] === 'perfect',
                'content_length_sufficient' => $wordCount >= 800,
                'keyword_used' => isset($details['keyword']) && $details['keyword']['status'] !== 'missing',
                'has_headings' => $hasH2,
                'has_images' => $imageCount > 0,
                'has_links' => $internalLinks > 0 || $externalLinks > 0,
            ]
        ];
    }
    
    /**
     * Génère un rapport SEO complet formaté pour l'affichage
     */
    public function getReportHtml(array $analysis): string
    {
        $html = '<div class="seo-report p-4 bg-white rounded-lg shadow-sm">';
        $html .= '<h3 class="text-lg font-bold mb-3">📊 Rapport SEO</h3>';
        $html .= '<div class="flex items-center gap-4 mb-4">';
        $html .= '<div class="text-center">';
        $html .= '<div class="text-4xl font-bold text-' . $analysis['grade_color'] . '-600">' . $analysis['score'] . '</div>';
        $html .= '<div class="text-sm text-gray-500">/100</div>';
        $html .= '</div>';
        $html .= '<div>';
        $html .= '<div class="font-semibold">Grade ' . $analysis['grade'] . '</div>';
        $html .= '<div class="text-sm text-gray-600">' . $analysis['message'] . '</div>';
        $html .= '</div>';
        $html .= '</div>';
        
        if (!empty($analysis['positives'])) {
            $html .= '<div class="mb-4 p-3 bg-green-50 rounded-lg">';
            $html .= '<p class="font-semibold text-green-700 mb-2">✅ Points positifs</p>';
            $html .= '<ul class="list-disc pl-5 text-sm text-green-600">';
            foreach ($analysis['positives'] as $positive) {
                $html .= '<li>' . $positive . '</li>';
            }
            $html .= '</ul></div>';
        }
        
        if (!empty($analysis['suggestions'])) {
            $html .= '<div class="mb-4 p-3 bg-yellow-50 rounded-lg">';
            $html .= '<p class="font-semibold text-yellow-700 mb-2">📝 Suggestions d\'amélioration</p>';
            $html .= '<ul class="list-disc pl-5 text-sm text-yellow-700">';
            foreach ($analysis['suggestions'] as $suggestion) {
                $html .= '<li>' . $suggestion . '</li>';
            }
            $html .= '</ul></div>';
        }
        
        if (!empty($analysis['ai_recommendations'])) {
            $html .= '<div class="mt-4 p-3 bg-purple-50 rounded-lg">';
            $html .= '<p class="font-semibold text-purple-700 mb-2">🤖 Recommandations IA</p>';
            $html .= '<ul class="list-disc pl-5 text-sm text-purple-700">';
            foreach ($analysis['ai_recommendations'] as $rec) {
                $html .= '<li>' . $rec . '</li>';
            }
            $html .= '</ul></div>';
        }
        
        $html .= '</div>';
        return $html;
    }
}