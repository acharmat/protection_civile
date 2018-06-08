<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHopitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hopitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('designation');
            $table->string('adresse');
            $table->string('wilaya');
            $table->string('tel');
            $table->string('email')->unique();
            $table->string('latitude');
            $table->string('longitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hopitals');
    }
}
