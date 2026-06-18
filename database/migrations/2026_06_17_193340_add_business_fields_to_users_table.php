<?php
// database/migrations/xxxx_xx_xx_add_business_fields_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('business_type')->nullable()->after('role');
            $table->string('business_name')->nullable()->after('business_type');
            $table->string('business_address')->nullable()->after('business_name');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['business_type', 'business_name', 'business_address']);
        });
    }
};