<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Badge;
use Illuminate\Console\Command;

class AwardBadges extends Command
{
    protected $signature = 'badges:award';
    protected $description = 'Attribue les badges automatiques aux utilisateurs';

    public function handle()
    {
        $users = User::all();
        $awarded = 0;
        
        foreach ($users as $user) {
            $articlesCount = $user->articles()->count();
            $totalViews = $user->articles()->sum('views');
            $maxSeoScore = $user->articles()->max('seo_score');
            $monthlyArticles = $user->articles()
                ->whereMonth('created_at', now()->month)
                ->count();
            
            // Badge: Premier article
            if ($articlesCount >= 1 && $this->awardBadge($user, 'first-article')) $awarded++;
            
            // Badge: 10 articles
            if ($articlesCount >= 10 && $this->awardBadge($user, '10-articles')) $awarded++;
            
            // Badge: 50 articles
            if ($articlesCount >= 50 && $this->awardBadge($user, '50-articles')) $awarded++;
            
            // Badge: 100 articles
            if ($articlesCount >= 100 && $this->awardBadge($user, '100-articles')) $awarded++;
            
            // Badge: Score SEO 80+
            if ($maxSeoScore >= 80 && $this->awardBadge($user, 'seo-80')) $awarded++;
            
            // Badge: Score SEO 95+
            if ($maxSeoScore >= 95 && $this->awardBadge($user, 'seo-95')) $awarded++;
            
            // Badge: 10k vues
            if ($totalViews >= 10000 && $this->awardBadge($user, '10k-views')) $awarded++;
            
            // Badge: 100k vues
            if ($totalViews >= 100000 && $this->awardBadge($user, '100k-views')) $awarded++;
            
            // Badge: Ponctualité
            if ($monthlyArticles >= 5 && $this->awardBadge($user, 'punctuality')) $awarded++;
        }
        
        $this->info("✅ $awarded badge(s) attribué(s) avec succès !");
        return Command::SUCCESS;
    }
    
    private function awardBadge($user, $badgeSlug)
    {
        $badge = Badge::where('slug', $badgeSlug)->first();
        if ($badge && !$user->badges()->where('badge_id', $badge->id)->exists()) {
            $user->badges()->attach($badge->id, ['awarded_at' => now()]);
            $this->line("✓ Badge '{$badge->name}' attribué à {$user->name}");
            return true;
        }
        return false;
    }
}