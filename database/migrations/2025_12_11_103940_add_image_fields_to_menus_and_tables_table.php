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
        Schema::table('menus', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('type');
        });
        
        Schema::table('tables', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('statut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
        
        Schema::table('tables', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};