<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceHopitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_hopital', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hopital_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->unsignedInteger('lits');

            $table->foreign('hopital_id')->references('id')->on('hopitals')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

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
        Schema::dropIfExists('service_hopital');
    }
}
