<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReparacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->string("id_factura");
            $table->string("estado")->nullable();
            $table->string("categoria")->nullable();
            $table->string("nombre_equipo")->nullable();
            $table->string("marca")->nullable();
            $table->string("modelo")->nullable();
            $table->string("descripcionr")->nullable();
            $table->string("foto")->nullable();
            $table->string("foto1")->nullable();
            $table->string("foto2")->nullable();
            $table->string("foto3")->nullable();
            $table->string("foto4")->nullable();
            $table->string("cambio_pieza")->nullable();
            $table->string("categoria_producto_inv")->nullable();
            $table->string("marca_producto_inv")->nullable();
            $table->string("nombre_producto_inv")->nullable();
            $table->string("id_producto_inv")->nullable();
            $table->string("garantia")->nullable();
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
        Schema::dropIfExists('reparacions');
    }
}
