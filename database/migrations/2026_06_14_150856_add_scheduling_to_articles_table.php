<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            if (!Schema::hasColumn('articles', 'scheduled_for')) {
                $table->timestamp('scheduled_for')->nullable()->after('published_at');
            }
            if (!Schema::hasColumn('articles', 'scheduled_status')) {
                $table->enum('scheduled_status', ['pending', 'sent', 'failed'])->nullable()->after('scheduled_for');
            }
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['scheduled_for', 'scheduled_status']);
        });
    }
};