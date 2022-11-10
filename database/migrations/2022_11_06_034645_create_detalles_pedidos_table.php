<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('id_detallepedido');
            $table->string('numero_pedido');
            $table->string('Cantidad');
            $table->string('id_producto');
            $table->string('proveedor_id');
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('detalles_pedidos');
    }
}
