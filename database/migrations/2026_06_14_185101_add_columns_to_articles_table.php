<?php
// database/migrations/xxxx_add_columns_to_articles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->integer('likes')->default(0)->after('views');
            $table->integer('read_time')->default(5)->after('likes');
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['likes', 'read_time']);
        });
    }
};