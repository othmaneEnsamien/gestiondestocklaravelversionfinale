<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureproduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factureproduit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Facture');
            $table->unsignedBigInteger('ID_Produit');
            $table->integer('Quantite');
            $table->foreign('ID_Facture')->references('id')->on('factures');
            $table->foreign('ID_Produit')->references('id')->on('produits');
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
        Schema::dropIfExists('factureproduit');
    }
}
