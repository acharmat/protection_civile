<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->enum('sexe', ['homme', 'femme'])->nullable();
            $table->integer('age')->unsigned();
            $table->string('type');
            $table->string('etat');
            $table->string('wilaya');
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
        Schema::dropIfExists('interventions');
    }
}
