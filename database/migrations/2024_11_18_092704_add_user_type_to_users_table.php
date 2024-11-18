<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('userType')->default(2)->after('id'); // 1: Super Admin, 2: Normal User
        });
    }

public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('userType');
        });
    }

};
