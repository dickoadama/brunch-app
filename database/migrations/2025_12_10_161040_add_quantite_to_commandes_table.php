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
        Schema::table('commandes', function (Blueprint $table) {
            $table->integer('quantite')->default(1)->after('nombre_personnes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn('quantite');
        });
    }
};
