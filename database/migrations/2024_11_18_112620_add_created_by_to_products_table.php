<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Check if the column exists before adding it
            if (!Schema::hasColumn('products', 'createdBy')) {
                $table->unsignedBigInteger('createdBy')->nullable()->after('id');
                $table->foreign('createdBy')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the foreign key constraint and the column if they exist
            if (Schema::hasColumn('products', 'createdBy')) {
                $table->dropForeign(['createdBy']);
                $table->dropColumn('createdBy');
            }
        });
    }
};
