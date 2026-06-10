<?php

namespace App\Services;

class SeoAnalyzerService
{
    public function analyze(string $content, ?string $title = null, ?string $keyword = null): array
    {
        $score = 30;
        $suggestions = [];
        $positives = [];
        
        $wordCount = str_word_count(strip_tags($content));
        
        // Longueur du contenu
        if ($wordCount > 1000) {
            $score += 20;
            $positives[] = "Excellent contenu ($wordCount mots)";
        } elseif ($wordCount > 500) {
            $score += 15;
            $positives[] = "Bonne longueur ($wordCount mots)";
        } elseif ($wordCount > 300) {
            $score += 10;
            $positives[] = "Contenu correct ($wordCount mots)";
        } else {
            $suggestions[] = "Ajoutez plus de contenu ($wordCount mots, 500+ recommandé)";
        }
        
        // Mot-clé
        if ($keyword && !empty($keyword)) {
            $keywordCount = substr_count(strtolower($content), strtolower($keyword));
            if ($keywordCount > 0) {
                $score += 15;
                $positives[] = "Mot-clé présent dans le contenu ($keywordCount fois)";
            } else {
                $suggestions[] = "Utilisez le mot-clé '$keyword' dans le contenu";
            }
        }
        
        // Titre
        if ($title && !empty($title)) {
            $titleLen = strlen($title);
            if ($titleLen >= 30 && $titleLen <= 60) {
                $score += 15;
                $positives[] = "Titre optimisé ($titleLen caractères)";
            } else {
                $suggestions[] = "Longueur du titre: $titleLen caractères (idéal 30-60)";
            }
        } else {
            $suggestions[] = "Ajoutez un titre";
        }
        
        // Structure
        if (preg_match('/<h[2-3]/i', $content)) {
            $score += 10;
            $positives[] = "Structure H2/H3 présente";
        } else {
            $suggestions[] = "Ajoutez des sous-titres (H2, H3)";
        }
        
        // Images
        if (preg_match('/<img/i', $content)) {
            $score += 10;
            $positives[] = "Images présentes";
        } else {
            $suggestions[] = "Ajoutez des images";
        }
        
        // Liens
        if (preg_match('/<a\s+href/i', $content)) {
            $score += 10;
            $positives[] = "Liens présents";
        } else {
            $suggestions[] = "Ajoutez des liens internes/externes";
        }
        
        $score = min($score, 100);
        
        $grade = 'F';
        if ($score >= 90) $grade = 'A+';
        elseif ($score >= 80) $grade = 'A';
        elseif ($score >= 70) $grade = 'B';
        elseif ($score >= 60) $grade = 'C';
        elseif ($score >= 50) $grade = 'D';
        
        return [
            'score' => $score,
            'grade' => $grade,
            'suggestions' => $suggestions,
            'positives' => $positives,
            'word_count' => $wordCount
        ];
    }
}