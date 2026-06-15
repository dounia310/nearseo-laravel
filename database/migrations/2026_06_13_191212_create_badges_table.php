<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Table des badges
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // 'Premier article'
            $table->string('slug')->unique();  // 'first-article'
            $table->string('icon');            // 'article'
            $table->string('color')->default('#8c4a2f');
            $table->text('description');
            $table->string('condition_type');  // 'articles_count', 'seo_score', 'views_total', 'streak', 'manual'
            $table->integer('condition_value')->nullable();
            $table->boolean('is_automatic')->default(true);
            $table->timestamps();
        });

        // Table des badges des utilisateurs
        Schema::create('user_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('badge_id')->constrained()->onDelete('cascade');
            $table->timestamp('awarded_at')->nullable();
            $table->timestamps();
            
            // Éviter les doublons
            $table->unique(['user_id', 'badge_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_badges');
        Schema::dropIfExists('badges');
    }
};