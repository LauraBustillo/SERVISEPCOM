<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MensajeConfirmacionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // H10 - Estefany López
    public function test_16_acceder_pdf_ventas_id_negativo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('Venta.pdf', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_17_acceder_pdf_ventas_id_cadena_de_text()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('Venta.pdf', ['id' => 'id']));
        $response->assertStatus(404);
    }
}
