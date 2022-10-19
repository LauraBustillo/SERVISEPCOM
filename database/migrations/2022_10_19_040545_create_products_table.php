<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Proveedors_Id');
            $table->string('Nombre_producto');
            $table->string('Descripcion');
            $table->string('Marca');
            $table->unsignedBigInteger('Categorias_Id');
            $table->string('Cantidad');
            $table->string('Precio');
            $table->string('Impuesto');
           
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
        Schema::dropIfExists('products');
    }
}
