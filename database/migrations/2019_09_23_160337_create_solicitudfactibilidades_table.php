<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudfactibilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudfactibilidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('direccionobra',50);
            $table->string('codigoinmueble',20);
            $table->string('noexpediente',20)->nullable();
            $table->string('noexpedienteinterno',20)->nullable();
          //  $table->string('fechasolicitud',20)->nullable();
          $table->string('nofinca',20)->nullable();
          $table->string('nofolio',20)->nullable();
          $table->string('libro',20)->nullable();
          $table->string('nocatastral',20)->nullable();
          $table->string('solvenciamunicipal',20)->nullable();
          $table->string('observacion',20)->nullable();
          $table->string('longitud',20)->nullable();
          $table->string('ancho',20)->nullable();
          $table->string('profundidad',20)->nullable();
          $table->string('diametrotubo',20)->nullable();
          $table->string('diametrocolector',20)->nullable();
          $table->unsignedBigInteger('idtipoobra');
          $table->unsignedBigInteger('idejecutor');
          $table->unsignedBigInteger('idpersona');
          $table->unsignedBigInteger('idestadofactibilidad');
            $table->timestamps();

            $table->foreign('idtipoobra')->references('id')->on('tipoobra');
            $table->foreign('idejecutor')->references('id')->on('ejecutores');
            $table->foreign('idpersona')->references('id')->on('personas');
            $table->foreign('idestadofactibilidad')->references('id')->on('estadofactibilidades');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudfactibilidades');
    }
}
