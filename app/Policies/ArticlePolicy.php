<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * Vérifier si l'utilisateur peut modifier l'article
     */
    public function update(User $user, Article $article): bool
    {
        // Admin OU propriétaire peuvent modifier
        return $user->role === 'admin' || $user->id === $article->user_id;
    }

    /**
     * Vérifier si l'utilisateur peut supprimer l'article
     */
    public function delete(User $user, Article $article): bool
    {
        // Admin OU propriétaire peuvent supprimer
        return $user->role === 'admin' || $user->id === $article->user_id;
    }
    
    /**
     * Vérifier si l'utilisateur peut voir l'article
     */
    public function view(User $user, Article $article): bool
    {
        // Admin ou propriétaire voient tout
        if ($user->role === 'admin' || $user->id === $article->user_id) {
            return true;
        }
        // Sinon, seulement les articles publiés
        return $article->status === 'published';
    }
}