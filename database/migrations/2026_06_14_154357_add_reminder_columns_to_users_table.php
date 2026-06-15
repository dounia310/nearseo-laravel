<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'last_article_published_at')) {
                $table->timestamp('last_article_published_at')->nullable()->after('settings');
            }
            if (!Schema::hasColumn('users', 'weekly_reminder_sent_at')) {
                $table->timestamp('weekly_reminder_sent_at')->nullable()->after('last_article_published_at');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_article_published_at', 'weekly_reminder_sent_at']);
        });
    }
};