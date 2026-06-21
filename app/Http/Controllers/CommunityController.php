<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('status', 'published')
            ->with('user');

        // Filtre par pays
        if ($request->filled('country')) {
            $query->where('geo_pays', $request->country);
        }

        // Filtre par ville
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(12);

        // Liste des pays avec compteurs
        $countries = Article::where('status', 'published')
            ->whereNotNull('geo_pays')
            ->selectRaw('geo_pays, COUNT(*) as total')
            ->groupBy('geo_pays')
            ->get();

        // Liste des villes avec compteurs
        $cities = Article::where('status', 'published')
            ->whereNotNull('city')
            ->selectRaw('city, COUNT(*) as total')
            ->groupBy('city')
            ->get();

        return view('community.index', compact('articles', 'countries', 'cities'));
    }
}
