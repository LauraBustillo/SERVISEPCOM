<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrarDevolucionGarantiaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // H5 - Estefany López
    public function test_30_acceder_lista_dev_garantia_antes_de_logueo()
    {
        $response = $this->get(route('devolucion.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_31_acceder_lista_dev_garantia_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('devolucion.index'));
        $response->assertStatus(200);
    }
}
