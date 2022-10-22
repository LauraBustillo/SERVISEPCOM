<?php

namespace Database\Factories;
use App\Models\Compra;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'Numero_factura'=> $this->faker->ean8,
            'Fecha_facturacion' => $this->faker->date,
            'Total_factura' => $this->faker->randomNumber,
        ];
    }
}
