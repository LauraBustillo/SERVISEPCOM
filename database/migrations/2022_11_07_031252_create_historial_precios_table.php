<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialPreciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_precios', function (Blueprint $table) {
            $table->id();
            $table->string('num_factura');
            $table->string('fecha_cambio');
            $table->string('id_producto');
            $table->string('precio_antiguo');
            $table->string('costo_antiguo');
            $table->string('precio_nuevo');
            $table->string('costo_nuevo');
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
        Schema::dropIfExists('historial_precios');
    }
}
