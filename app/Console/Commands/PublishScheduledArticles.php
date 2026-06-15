<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class PublishScheduledArticles extends Command
{
    protected $signature = 'articles:publish-scheduled';
    protected $description = 'Publie les articles programmés';

    public function handle()
    {
        $articles = Article::where('scheduled_status', 'pending')
            ->where('scheduled_for', '<=', now())
            ->get();
        
        $count = 0;
        
        foreach ($articles as $article) {
            try {
                $article->update([
                    'status' => 'published',
                    'published_at' => now(),
                    'scheduled_status' => 'sent'
                ]);
                $count++;
                $this->info("✓ Article '{$article->title}' publié");
            } catch (\Exception $e) {
                $article->update(['scheduled_status' => 'failed']);
                $this->error("✗ Échec publication '{$article->title}'");
            }
        }
        
        $this->info("✅ $count article(s) publié(s) avec succès");
    }
}