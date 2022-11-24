<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->string("id_factura");
            $table->string("estado")->nullable();
            $table->string("categoria")->nullable();
            $table->string("nombre_equipo")->nullable();
            $table->string("marca")->nullable();
            $table->string("modelo")->nullable();
            $table->string("fecha_ingreso")->nullable();
            $table->string("fecha_entrega")->nullable();

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
        Schema::dropIfExists('mantenimientos');
    }
}
