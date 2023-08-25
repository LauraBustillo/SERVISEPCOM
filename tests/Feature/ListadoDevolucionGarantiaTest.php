<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListadoDevolucionGarantiaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // H7 - Estefany López
    public function test_34_acceder_lista_dev_garantia_correctamente_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('devolucion.index'));
        $response->assertSeeText('Listado');
    }

    public function test_35_acceder_nueva_dev_garantia_correctamente_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('show.devolucion'));
        $response->assertSeeText('Registrar');
    }
}
