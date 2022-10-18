<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
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

            'Nombre_empresa'=> $this->faker->firstName,
            'Direccion'=> $this->faker->firstName,
            'Correo'=> $this->faker->email(),
            'Telefono_empresa'=> $this->faker->phoneNumber(),
            'Nombre_encargado'=> $this->faker->firstName,
            'Apellido_encargado'=> $this->faker->lastName,
            'Telefono_encargado'=> $this->faker->phoneNumber(),
        ];
    }
}
