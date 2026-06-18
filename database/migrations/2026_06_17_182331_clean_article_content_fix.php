<?php
// database/migrations/xxxx_xx_xx_clean_article_content_fix.php

use Illuminate\Database\Migrations\Migration;
use App\Models\Article;

return new class extends Migration
{
    public function up()
    {
        $articles = Article::all();
        foreach ($articles as $article) {
            $content = $article->content;
            
            // Nettoyer
            $content = trim($content);
            if (substr($content, 0, 1) === '"') {
                $content = substr($content, 1);
            }
            if (substr($content, -1) === '"') {
                $content = substr($content, 0, -1);
            }
            
            $content = stripslashes($content);
            $content = str_replace(['\\n', '\n', '\\r', '\r'], '', $content);
            $content = preg_replace('/\s+/', ' ', $content);
            
            $article->content = $content;
            $article->save();
        }
    }

    public function down()
    {
        // Ne pas inverser
    }
};