<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Article;

return new class extends Migration
{
    public function up()
    {
        $articles = Article::where('id', 7)->get();
        
        foreach ($articles as $article) {
            $content = $article->content;
            
            // Restaurer les mots coupés
            $corrections = [
                'Introductio' => 'Introduction',
                'Conclusio' => 'Conclusion',
                'aiversaire' => 'anniversaire',
                'persoalisée' => 'personnalisée',
                'persoalisation' => 'personnalisation',
                'sélectioée' => 'sélectionnée',
                'sélectioons' => 'sélectionnons',
                'quotidiees' => 'quotidiennes',
                'exceptioelles' => 'exceptionnelles',
                'professioelles' => 'professionnelles',
                'professioels' => 'professionnels',
                'boutoière' => 'boutonnière',
                'aboements' => 'abonnements',
                'coaissances' => 'connaissances',
                'boe' => 'bonne',
                'aée' => 'année',
                'coaître' => 'connaître',
            ];
            
            foreach ($corrections as $wrong => $correct) {
                $content = str_replace($wrong, $correct, $content);
            }
            
            // Corriger les "n'" manquants
            $content = preg_replace('/(\s)l\'/', '$1l\'', $content);
            $content = preg_replace('/(\s)d\'/', '$1d\'', $content);
            
            $article->content = $content;
            $article->save();
        }
    }

    public function down() {}
};