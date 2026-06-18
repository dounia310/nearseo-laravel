<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Article;

return new class extends Migration
{
    public function up()
    {
        $articles = Article::all();
        
        foreach ($articles as $article) {
            $content = $article->content;
            
            // Supprimer les guillemets
            $content = trim($content);
            if (substr($content, 0, 1) === '"') {
                $content = substr($content, 1);
            }
            if (substr($content, -1) === '"') {
                $content = substr($content, 0, -1);
            }
            
            // Remplacer les \n littéraux par des vrais sauts de ligne
            $content = str_replace('\\n', "\n", $content);
            $content = str_replace('\n', "\n", $content);
            
            // Remplacer les \r
            $content = str_replace('\\r', "\r", $content);
            $content = str_replace('\r', "\r", $content);
            
            // Déséchapper les guillemets
            $content = str_replace('\"', '"', $content);
            $content = str_replace("\'", "'", $content);
            
            // Déséchapper les slashes
            $content = stripslashes($content);
            
            // Sauvegarder
            $article->content = $content;
            $article->save();
            
            echo "Article {$article->id} nettoyé.\n";
        }
    }

    public function down()
    {
        // Ne pas inverser
    }
};