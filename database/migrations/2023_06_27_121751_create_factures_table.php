<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('Num_Facture');
            $table->date('Date');
            $table->decimal('Prix_HT_Total', 10, 2);
            $table->decimal('Taux_TVA', 5, 2);
            $table->decimal('Prix_TTC_Total', 10, 2);
            $table->string('nomFournisseur');
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
        Schema::dropIfExists('factures');
    }
}
