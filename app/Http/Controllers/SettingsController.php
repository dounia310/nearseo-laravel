<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Données communes
        $settings = $user->settings ?? [];
        
        // Si l'utilisateur est admin, charger les données supplémentaires
        if ($user->role === 'admin') {
            $totalUsers = User::count();
            $totalArticles = Article::count();
            $totalViews = Article::sum('views');
            $avgSeoScore = round(Article::avg('seo_score') ?? 0);
            
            $articlesByCity = Article::where('status', 'published')
                ->whereNotNull('address')
                ->select('address', DB::raw('count(*) as count'))
                ->groupBy('address')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->get();
            
            $users = User::withCount('articles')->paginate(10);
            
            return view('dashboard.settings', compact('settings', 'totalUsers', 'totalArticles', 'totalViews', 'avgSeoScore', 'articlesByCity', 'users'));
        }
        
        return view('dashboard.settings', compact('settings'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
        $settings = $user->settings ?? [];
        
        $validated = $request->validate([
            'language' => 'in:fr,en,ar',
            'theme' => 'in:light,dark,auto',
            'weekly_report' => 'boolean',
            'security_alerts' => 'boolean'
        ]);
        
        $settings = array_merge($settings, $validated);
        $user->settings = $settings;
        $user->save();
        
        return response()->json(['success' => true]);
    }
    
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed'
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json(['error' => 'Mot de passe incorrect'], 422);
        }
        
        $user->password = Hash::make($validated['new_password']);
        $user->save();
        
        return response()->json(['success' => true]);
    }
    
    public function updateTheme(Request $request)
    {
        $user = Auth::user();
        $settings = $user->settings ?? [];
        $settings['theme'] = $request->theme;
        $user->settings = $settings;
        $user->save();
        
        return response()->json(['success' => true]);
    }
}