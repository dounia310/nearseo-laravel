<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // ✅ Champs pour le contenu
            $table->string('title')->nullable();              // Titre de la notification (optionnel)
            $table->text('message');                          // Message principal (requis)
            
            // ✅ Types de notification
            $table->string('type')->default('info');          // info, success, warning, error, article_published, comment, mention, badge_earned, like, follow
            
            // ✅ Statut
            $table->boolean('is_read')->default(false);
            
            // ✅ Données supplémentaires (JSON)
            $table->json('data')->nullable();                 // Stocke article_id, comment_id, url, etc.
            
            // ✅ Pour la redirection
            $table->foreignId('article_id')->nullable()->constrained()->onDelete('cascade');  // Lien vers l'article
            $table->string('url')->nullable();                // URL personnalisée
            $table->string('icon')->nullable();               // Icône Material Symbols
            
            $table->timestamps();
            
            // ✅ Index pour les requêtes rapides
            $table->index(['user_id', 'is_read']);
            $table->index(['user_id', 'created_at']);
            $table->index(['type']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};