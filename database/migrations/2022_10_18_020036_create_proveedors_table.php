<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_empresa');
            $table->string('Direccion');
            $table->string('Correo')->unique();
            $table->string('Telefono_empresa')->unique();
            $table->string('Nombre_encargado');
            $table->string('Apellido_encargado');
            $table->string('Telefono_encargado')->unique();
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
        Schema::dropIfExists('proveedors');
    }
}
