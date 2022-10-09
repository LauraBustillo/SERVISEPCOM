<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
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
            
            'Nombre'=> $this->faker->firstName,
            'Apellido'=> $this->faker->lastName,
            'Numero_identidad'=> $this->faker->ean8,
            'Numero_telefono'=> $this->faker->phoneNumber,
            'Direccion'=> $this->faker->text( 100),
        ];
    }
}


