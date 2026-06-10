<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class GeoController extends Controller
{
    public function index()
    {
        // Récupérer les articles géolocalisés de l'utilisateur
        $nearbyArticles = Article::where('user_id', Auth::id())
            ->where('status', 'published')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('dashboard.geo', compact('nearbyArticles'));
    }
    
    public function nearbyArticles(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'radius' => 'integer|min:1|max:50'
        ]);
        
        $radius = $request->radius ?? 10;
        
        // Calcul des articles dans le rayon
        $articles = Article::where('status', 'published')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->selectRaw("*, (
                6371 * acos(
                    cos(radians(?)) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) * sin(radians(latitude))
                )
            ) AS distance", [
                $request->lat,
                $request->lng,
                $request->lat
            ])
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->get();
            
        return response()->json($articles);
    }
    
    public function searchLocation(Request $request)
    {
        $request->validate([
            'query' => 'required|string'
        ]);
        
        try {
            $response = Http::get('https://nominatim.openstreetmap.org/search', [
                'q' => $request->query,
                'format' => 'json',
                'limit' => 5,
                'addressdetails' => 1
            ]);
            
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur de recherche'], 500);
        }
    }
    
    public function updateAddress(Request $request, Article $article)
    {
        $request->validate([
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);
        
        // Vérifier que l'article appartient à l'utilisateur
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }
        
        $article->update([
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        
        return response()->json(['success' => true]);
    }
}