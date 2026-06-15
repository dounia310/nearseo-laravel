<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            if (!Schema::hasColumn('articles', 'upvotes')) {
                $table->integer('upvotes')->default(0)->after('views');
            }
            if (!Schema::hasColumn('articles', 'downvotes')) {
                $table->integer('downvotes')->default(0)->after('upvotes');
            }
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['upvotes', 'downvotes']);
        });
    }
};Schema::getColumnListing('articles');