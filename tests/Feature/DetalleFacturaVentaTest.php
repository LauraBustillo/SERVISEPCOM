<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DetalleFacturaVentaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    // H8 - Estefany López
    public function test_9_acceder_verDetalles_ventas_despues_de_logueo_id_negativo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('venta.mostrar', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_10_acceder_verDetalles_ventas_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('venta.mostrar', ['id' => 1]));
        $response->assertStatus(200);
    }

    public function test_11_acceder_verDetalles_ventas_despues_de_logueo_id_negativo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('venta.mostrar', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_12_acceder_verDetalles_ventas_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('venta.mostrar', ['id' => 1]));
        $response->assertSeeText('Información');
    }


    public function test_13_acceder_verDetalles_ventas_despues_de_logueo_id_cadena_texto()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('venta.mostrar', ['id' => "id"]));
        $response->assertStatus(404);
    }
}
