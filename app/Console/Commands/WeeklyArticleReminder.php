<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Console\Command;
use Carbon\Carbon;

class WeeklyArticleReminder extends Command
{
    protected $signature = 'notify:weekly-article-reminder';
    protected $description = 'Envoie un rappel hebdomadaire pour publier un article';

    public function handle()
    {
        $users = User::whereNotNull('last_article_published_at')
            ->where(function ($query) {
                $query->whereNull('weekly_reminder_sent_at')
                      ->orWhere('weekly_reminder_sent_at', '<', Carbon::now()->subDays(7));
            })
            ->get();
        
        $count = 0;
        
        foreach ($users as $user) {
            $lastArticleDate = Carbon::parse($user->last_article_published_at);
            $daysSinceLastArticle = $lastArticleDate->diffInDays(now());
            
            // Si ça fait plus de 5 jours sans publier
            if ($daysSinceLastArticle >= 5) {
                
                // Créer une notification
                Notification::create([
                    'user_id' => $user->id,
                    'title' => '📝 Rappel hebdomadaire',
                    'message' => "Cela fait {$daysSinceLastArticle} jours que vous n'avez pas publié d'article. 
                                  Publiez un nouvel article pour maintenir votre visibilité SEO !",
                    'type' => 'warning'
                ]);
                
                // Mettre à jour la date du dernier rappel
                $user->update(['weekly_reminder_sent_at' => now()]);
                $count++;
                
                $this->line("✓ Rappel envoyé à {$user->name}");
            }
        }
        
        $this->info("✅ $count rappel(s) hebdomadaire(s) envoyé(s)");
    }
}