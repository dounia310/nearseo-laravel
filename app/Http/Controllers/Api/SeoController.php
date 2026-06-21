<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function analyze(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $content = $request->content;
        $wordCount = str_word_count(strip_tags($content));
        
        // Calcul du score SEO
        $score = 50;
        if ($wordCount > 800) $score += 20;
        elseif ($wordCount > 400) $score += 10;
        if (preg_match_all('/<h[1-6]/', $content) >= 3) $score += 15;
        if (preg_match_all('/<p>/', $content) >= 5) $score += 10;
        if (preg_match_all('/<strong>/', $content) >= 2) $score += 5;
        $score = min($score, 100);
        
        // Suggestions
        $suggestions = [];
        if ($wordCount < 600) $suggestions[] = 'Augmentez la longueur de l\'article (600+ mots)';
        if (preg_match_all('/<h[1-6]/', $content) < 3) $suggestions[] = 'Ajoutez des sous-titres (H2, H3)';
        if (!str_contains($content, '<strong>')) $suggestions[] = 'Ajoutez des mots-clés en gras';
        
        return response()->json([
            'success' => true,
            'score' => $score,
            'suggestions' => $suggestions,
            'word_count' => $wordCount,
            'read_time' => ceil($wordCount / 200),
        ]);
    }
}