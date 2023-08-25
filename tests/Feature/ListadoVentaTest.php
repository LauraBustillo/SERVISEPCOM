<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListadoVentaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // H6 - Estefany López
    public function test_1_acceder_lista_ventas_antes_de_logueo()
    {
        $response = $this->get(route('Venta.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_2_acceder_lista_ventas_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('Venta.index'));
        $response->assertStatus(200);
    }

    public function test_3_acceder_nueva_ventas_antes_de_logueo()
    {
        $response = $this->get(route('show.registroventa'));
        $response->assertRedirect(route('login'));
    }

    public function test_4_acceder_nueva_ventas_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('show.registroventa'));
        $response->assertStatus(200);
    }

    public function test_5_acceder_lista_ventas_correctamente_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('Venta.index'));
        $response->assertSeeText('Listado');
    }

    public function test_6_acceder_nueva_ventas_correctamente_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('show.registroventa'));
        $response->assertSeeText('Registro');
    }
}
