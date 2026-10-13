<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ✅ Colonnes business complémentaires (avec protection anti-doublon)
            if (!Schema::hasColumn('users', 'business_category')) {
                $table->string('business_category')->nullable()->after('business_name');
            }
            if (!Schema::hasColumn('users', 'business_city')) {
                $table->string('business_city')->nullable()->after('business_address');
            }
            if (!Schema::hasColumn('users', 'business_district')) {
                $table->string('business_district')->nullable()->after('business_city');
            }
            if (!Schema::hasColumn('users', 'business_country')) {
                $table->string('business_country')->default('Maroc')->after('business_district');
            }
            if (!Schema::hasColumn('users', 'business_website')) {
                $table->string('business_website')->nullable()->after('business_country');
            }
            if (!Schema::hasColumn('users', 'business_mode')) {
                $table->enum('business_mode', ['local', 'online'])->default('local')->after('business_website');
            }
            if (!Schema::hasColumn('users', 'onboarding_completed')) {
                $table->boolean('onboarding_completed')->default(false)->after('business_mode');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'business_category',
                'business_city',
                'business_district',
                'business_country',
                'business_website',
                'business_mode',
                'onboarding_completed',
            ]);
        });
    }
};