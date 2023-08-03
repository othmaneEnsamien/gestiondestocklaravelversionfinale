<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command', function (Blueprint $table) {
            $table->id();
            $table->string('numero_commande')->unique();
            $table->unsignedBigInteger('client_id');
            $table->enum('type_commande', ['livre', 'sur place']);
            $table->enum('etat', ['en attente', 'livre'])->default('en attente');
            // Définissez les clés étrangères pour les relations avec les autres tables
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('command');
    }
}
