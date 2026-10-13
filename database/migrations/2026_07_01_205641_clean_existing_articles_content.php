<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Services\ContentCleanerService;

return new class extends Migration
{
    public function up()
    {
        // ⚠️ Vérifier que le service existe
        if (!class_exists(ContentCleanerService::class)) {
            return;
        }

        $cleaner = app(ContentCleanerService::class);
        
        $articles = DB::table('articles')->get();
        
        $count = 0;
        foreach ($articles as $article) {
            $cleanContent = $cleaner->clean($article->content);
            $cleanTitle = $cleaner->cleanTitle($article->title);
            
            if ($cleanContent !== $article->content || $cleanTitle !== $article->title) {
                DB::table('articles')
                    ->where('id', $article->id)
                    ->update([
                        'content' => $cleanContent,
                        'title' => $cleanTitle,
                    ]);
                $count++;
            }
        }
        
        DB::table('migrations')->insert([
            'migration' => '2026_07_01_clean_existing_articles_completed',
            'batch' => 999,
        ]);
    }

    public function down()
    {
        // Ne pas annuler
    }
};