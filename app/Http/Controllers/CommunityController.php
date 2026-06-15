<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('status', 'published')
            ->with('user');
        
        // Filtre par ville
        if ($request->filled('city')) {
            $query->where('address', $request->city);
        }
        
        $articles = $query->orderBy('created_at', 'desc')->paginate(9);
        
        // Ajouter un indicateur AI (score SEO > 80)
        foreach ($articles as $article) {
            $article->ai_generated = $article->seo_score >= 80;
        }
        
        // Villes avec nombre d'articles
        $cities = Article::where('status', 'published')
            ->whereNotNull('address')
            ->select('address', DB::raw('count(*) as articles_count'))
            ->groupBy('address')
            ->orderBy('articles_count', 'desc')
            ->limit(10)
            ->get();
        
        return view('dashboard.community', compact('articles', 'cities'));
    }
}