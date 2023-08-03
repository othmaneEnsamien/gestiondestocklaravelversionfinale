<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
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
            $table->string('numero_commande')->unique();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('produit_id');
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('sous_categorie_id');
            $table->integer('quantite');
            $table->enum('type_commande', ['livre', 'sur place']);
            $table->enum('etat', ['en attente', 'livre'])->default('en attente');

            // Définissez les clés étrangères pour les relations avec les autres tables
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('produit_id')->references('id')->on('produits');
            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->foreign('sous_categorie_id')->references('id')->on('sous_categories');
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
}
