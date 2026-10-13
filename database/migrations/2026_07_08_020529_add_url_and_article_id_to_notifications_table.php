<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // ✅ Ajouter les colonnes pour la redirection
            $table->string('icon')->nullable()->after('data');
            $table->string('url')->nullable()->after('data');
            $table->foreignId('article_id')->nullable()->after('data')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropColumn(['article_id', 'url', 'icon']);
        });
    }
};