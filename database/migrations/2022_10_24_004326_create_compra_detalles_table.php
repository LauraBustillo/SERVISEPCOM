<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_detalles', function (Blueprint $table) {
            $table->id();
            $table->string("id_detalle"); 
            $table->string("id_prov");
            $table->string("id_product");
            $table->string("nombre_producto");
            $table->string("Numero_facturaform");
            $table->string("Descripcion");
            $table->string("Marca");
            $table->string("id_cat");
            $table->string("Categoria");
            $table->string("Cantidad");
            $table->string("Costo");
            $table->string("Precio_venta");
            $table->string("Impuesto");
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
        Schema::dropIfExists('compra_detalles');
    }
}
