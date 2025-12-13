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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->decimal('montant', 10, 2);
            $table->string('methode');
            $table->string('statut')->default('en_attente');
            $table->text('qr_code')->nullable();
            $table->unsignedBigInteger('commande_id')->nullable();
            $table->unsignedBigInteger('reservation_id')->nullable();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
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
        Schema::dropIfExists('paiements');
    }
};
