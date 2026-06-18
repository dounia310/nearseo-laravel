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
        // Vérifier si la colonne n'existe pas déjà
        if (!Schema::hasColumn('articles', 'image')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->string('image')->nullable()->after('content');
            });
        }

        // Vérifier si la colonne meta_description n'existe pas déjà
        if (!Schema::hasColumn('articles', 'meta_description')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->text('meta_description')->nullable()->after('focus_keyword');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['image', 'meta_description']);
        });
    }
};