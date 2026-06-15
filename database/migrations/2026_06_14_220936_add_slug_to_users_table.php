<?php
// database/migrations/xxxx_add_slug_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('name');
            }
        });
        
        // Générer les slugs pour les utilisateurs existants
        $users = \App\Models\User::all();
        foreach ($users as $user) {
            $user->slug = Str::slug($user->name);
            $user->save();
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};