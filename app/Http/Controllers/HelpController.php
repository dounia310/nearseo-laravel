<?php
// app/Http/Controllers/HelpController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        return view('help.index');
    }
    
    public function article($slug)
    {
        // Logique pour afficher un article spécifique
        $articles = [
            'create-first-article' => ['title' => 'Comment créer mon premier article ?', 'content' => '...'],
            'account-setup' => ['title' => 'Configuration initiale du compte', 'content' => '...'],
            // ... autres articles
        ];
        
        $article = $articles[$slug] ?? null;
        
        if (!$article) {
            abort(404);
        }
        
        return view('help.article', compact('article'));
    }
}