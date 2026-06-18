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
            
            // Nettoyage radical
            $content = trim($content);
            if (substr($content, 0, 1) === '"') {
                $content = substr($content, 1);
            }
            if (substr($content, -1) === '"') {
                $content = substr($content, 0, -1);
            }
            
            // Remplacer tous les \n par des espaces
            $patterns = [
                '\\n', '\n', '\\r', '\r', '\\t', '\t',
                '\\"', '\"', "\\'", "\'", '\\/', '\/'
            ];
            
            foreach ($patterns as $pattern) {
                $content = str_replace($pattern, ' ', $content);
            }
            
            // Déséchapper
            $content = stripslashes($content);
            
            // Supprimer les "n" isolés
            $content = preg_replace('/\s+n\s+/', ' ', $content);
            $content = preg_replace('/^n\s+/', '', $content);
            $content = preg_replace('/\s+n$/', '', $content);
            
            // Nettoyer les espaces
            $content = preg_replace('/\s+/', ' ', $content);
            $content = trim($content);
            
            $article->content = $content;
            $article->save();
        }
    }

    public function down()
    {
        // Ne pas inverser
    }
};