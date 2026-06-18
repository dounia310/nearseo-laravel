<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Article;

return new class extends Migration
{
    public function up()
    {
        $articles = Article::all();
        
        foreach ($articles as $article) {
            $content = $article->content;
            
            // 1. Supprimer les guillemets
            $content = trim($content);
            if (substr($content, 0, 1) === '"') {
                $content = substr($content, 1);
            }
            if (substr($content, -1) === '"') {
                $content = substr($content, 0, -1);
            }
            
            // 2. Remplacer les \n
            $content = str_replace('\\n', "\n", $content);
            $content = str_replace('\n', "\n", $content);
            
            // 3. Supprimer les "n" entre les balises et les "n" isolés
            $content = preg_replace('/>n+/', '>', $content);
            $content = preg_replace('/n+</', '<', $content);
            $content = preg_replace('/\bn\b/', ' ', $content);
            $content = preg_replace('/n{2,}/', '', $content);
            $content = preg_replace('/\s+n\s+/', ' ', $content);
            
            // 4. Déséchapper
            $content = stripslashes($content);
            
            // 5. Nettoyer les espaces
            $content = preg_replace('/\s+/', ' ', $content);
            $content = preg_replace('/>\s+</', '><', $content);
            
            $article->content = $content;
            $article->save();
        }
    }

    public function down() {}
};