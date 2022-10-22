<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           /*'proveedor_id',*/
           'Nombre_producto',
           'Descripcion',
           'Marca',
          /* 'categoria_id',*/
           'Cantidad',
           'Precio',
           'Impuesto',
        ];
    }
}
