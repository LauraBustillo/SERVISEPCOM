<?php

namespace Database\Factories;
use App\Models\Empleado;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
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
            'Nombres'=> $this->faker->firstName,
            'Apellidos'=> $this->faker->lastName,
            'Numero_identidad'=> $this->faker->ean8,
            'Fecha_nacimiento'=> $this->faker->date,
            'Numero_telefono'=> $this->faker->phoneNumber,
            'Salrio'=> $this->faker->numberbetween(100, 9000),
            'Fecha_contrato'=> $this->faker->date,
            'Direccion'=> $this->faker->text(100)

        ];
    }
}

