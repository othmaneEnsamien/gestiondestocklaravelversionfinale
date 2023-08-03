<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('nomproduit');
            $table->decimal('Prix', 8, 2);
            $table->string('Image');
            $table->enum('Mesure', ['quantite', 'poids']);
            $table->unsignedBigInteger('id_categorie');
            $table->unsignedBigInteger('id_souscategorie')->nullable();
            $table->foreign('id_categorie')->references('id')->on('categories');
            $table->foreign('id_souscategorie')->references('id')->on('sous_categories');
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
        Schema::dropIfExists('produits');
    }
}
