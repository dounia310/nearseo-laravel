<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        $user = Auth::user();
        
        $stats = [
            'published_articles' => Article::where('user_id', $user->id)->where('status', 'published')->count(),
            'total_views' => Article::where('user_id', $user->id)->sum('views'),
            'avg_seo_score' => round(Article::where('user_id', $user->id)->avg('seo_score') ?? 0),
        ];
        
        $badges = [
            ['name' => 'Expert', 'icon' => 'workspace_premium', 'active' => true, 'title' => 'Publié 50 articles'],
            ['name' => 'Précision', 'icon' => 'verified', 'active' => true, 'title' => 'Score SEO parfait'],
            ['name' => 'Viralité', 'icon' => 'bolt', 'active' => true, 'title' => '1000 vues en 24h'],
            ['name' => 'Loyauté', 'icon' => 'military_tech', 'active' => false, 'title' => 'À débloquer'],
            ['name' => 'Elite', 'icon' => 'star', 'active' => false, 'title' => 'À débloquer'],
            ['name' => 'Gagnant', 'icon' => 'emoji_events', 'active' => false, 'title' => 'À débloquer'],
            ['name' => 'Lancement', 'icon' => 'rocket_launch', 'active' => false, 'title' => 'À débloquer'],
            ['name' => 'Social', 'icon' => 'forum', 'active' => false, 'title' => 'À débloquer'],
            ['name' => 'AI Savvy', 'icon' => 'psychology', 'active' => false, 'title' => 'À débloquer'],
        ];
        
        return view('dashboard.profile', compact('stats', 'badges'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $userId = Auth::id();
        
        // Utiliser update directement sans passer par l'objet User
        User::where('id', $userId)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
        ]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's avatar.
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048'
        ]);

        $userId = Auth::id();
        $user = User::find($userId);

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        
        // Utiliser update directement
        User::where('id', $userId)->update([
            'avatar' => $path
        ]);

        return response()->json(['success' => true, 'avatar_url' => Storage::url($path)]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $userId = Auth::id();
        
        Auth::logout();
        
        // Utiliser destroy directement
        User::destroy($userId);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    /**
     * Get user statistics (API).
     */
    public function stats()
    {
        $user = Auth::user();
        
        return response()->json([
            'articles_count' => Article::where('user_id', $user->id)->count(),
            'published_count' => Article::where('user_id', $user->id)->where('status', 'published')->count(),
            'total_views' => Article::where('user_id', $user->id)->sum('views'),
            'avg_seo_score' => round(Article::where('user_id', $user->id)->avg('seo_score') ?? 0),
        ]);
    }
}