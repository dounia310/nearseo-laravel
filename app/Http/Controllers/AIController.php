<?php

namespace App\Http\Controllers;

use App\Services\SeoAnalyzerService;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AIController extends Controller
{
    public function __construct()
    {
        // Pas de constructeur spécifique
    }

    public function create()
    {
        return view('dashboard.ai.create');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|min:5',
            'website' => 'nullable|url',
            'address' => 'nullable|string',
            'length' => 'in:short,medium,long'
        ]);

        // Génération réelle via Gemini
        $length = $request->input('length', 'medium');

        $gemini = app(GeminiService::class);
        $articleHtml = $gemini->generateArticle(
            subject: $request->subject,
            website: $request->input('website'),
            address: $request->input('address'),
            length: $length
        );

        if (!$articleHtml) {
            return response()->json([
                'success' => false,
                'message' => 'La génération IA a échoué (clé GEMINI_API_KEY absente ou erreur API).'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'article' => $articleHtml,
        ]);
    }

    public function rewrite(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'platform' => 'required|in:instagram,twitter,linkedin,facebook'
        ]);

        return response()->json([
            'success' => true,
            'content' => 'Contenu reformulé pour ' . $request->platform
        ]);
    }

    public function optimize(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'keyword' => 'required|string|max:100'
        ]);

        return response()->json([
            'success' => true,
            'content' => $request->content . ' (optimisé pour ' . $request->keyword . ')'
        ]);
    }

    public function history()
    {
        return response()->json([
            'generations' => []
        ]);
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

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'score' => 50,
                'grade' => 'C',
                'suggestions' => ['Erreur temporaire'],
                'positives' => [],
                'word_count' => 0
            ], 200);
        }
    }
}
