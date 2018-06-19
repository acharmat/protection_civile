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
            $table->string('nom')->default('Inconnu')->nullable();
            $table->string('prenom')->default('Inconnu')->nullable();
            $table->enum('sexe', ['homme', 'femme']);
            $table->integer('age')->unsigned();
            $table->enum('type',['Secours et Evacuation', 'Accidents de la circulation', 'Incendies', 'Operations diverses'] );
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->enum('etat', ['dcd', 'malade', 'blessé' , 'autre']);
            $table->string('wilaya');
            $table->enum('groupage', ['A+', 'A-','B+', 'B-','AB+', 'AB-','O+', 'O-'])->nullable();
            $table->enum('situation', ['hospitaliser', 'non hospitaliser'])->default('non hospitaliser');
            $table->integer('hopital_id')->unsigned();
            $table->integer('service_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('hopital_id')->references('id')->on('hopitals')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

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
