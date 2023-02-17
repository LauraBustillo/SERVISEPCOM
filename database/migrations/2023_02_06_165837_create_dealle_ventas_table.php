<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealle_ventas', function (Blueprint $table) {
            $table->id();
            $table->string("id_detalleV"); 
            $table->string("id_provV");
            $table->string("id_productV");
            $table->string("nombre_productoV");
            $table->string("Numero_facturaformV");
            $table->string("DescripcionV");
            $table->string("MarcaV");
            $table->string("DescuentoV");
            $table->string("CantidadV");
            $table->string("Precio_ventaV");
            $table->string("ImpuestoV");
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
        Schema::dropIfExists('dealle_ventas');
    }
}
