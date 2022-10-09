<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('Primer_nombre');
            $table->string('Segundo_nombre')->nullable();
            $table->string('Primer_apellido');
            $table->string('Segundo_apellido')->nullable();
            $table->string('Numero_identidad');
            $table->string('Fecha_nacimiento');
            $table->string('Numero_telefono');
            $table->string('Salrio');
            $table->string('Fecha_contrato');
            $table->string('Direccion');
            
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
        Schema::dropIfExists('empleados');
    }
}
