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
            'Primer_nombre'=> $this->faker->firstName,
            'Segundo_nombre'=> $this->faker-> firstName,
            'Primer_apellido'=> $this->faker->lastName,
            'Segundo_apellido'=> $this->faker->lastName,
            'Numero_identidad'=> $this->faker->ean8,
            'Fecha_nacimiento'=> $this->faker->date,
            'Numero_telefono'=> $this->faker->phoneNumber,
            'Salrio'=> $this->faker->numberbetween(100, 9000),
            'Fecha_contrato'=> $this->faker->date,
            'Direccion'=> $this->faker->text(100)

        ];
    }
}

