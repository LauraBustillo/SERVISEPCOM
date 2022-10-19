<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'Proveedors_Id',
           'Nombre_producto',
           'Descripcion',
           'Marca',
           'Categorias_Id',
           'Cantidad',
           'Precio',
           'Impuesto',
        ];
    }
}
