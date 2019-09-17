<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEjecutoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejecutores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idcargoejecutor');
            $table->string('nombre',100);
            $table->string('direccion',150);
            $table->boolean('estado')->default(1);
            $table->timestamps();

            $table->foreign('idcargoejecutor')->references('id')->on('cargoejecutores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejecutores');
    }
}
