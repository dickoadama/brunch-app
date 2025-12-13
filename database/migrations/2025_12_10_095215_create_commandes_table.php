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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('menu_id')->constrained('menus');
            $table->dateTime('date_commande');
            $table->integer('nombre_personnes');
            $table->decimal('montant_total', 8, 2);
            $table->string('statut'); // en attente, confirmée, annulée
            $table->text('commentaires')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
};
