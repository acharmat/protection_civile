<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matricule')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('photo')->default('default.jpg');
            $table->string('email')->unique();
            $table->text('adresse');
            $table->string('telephone')->unique();
            $table->enum('sexe', ['Homme', 'Femme']);
            $table->date('date_n');
            $table->string('lieu_n');
            $table->string('grade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
