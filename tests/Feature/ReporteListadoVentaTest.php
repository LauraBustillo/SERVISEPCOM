<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReporteListadoVentaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    // H7 - Estefany López
    public function test_7_acceder_verDetalles_ventas_antes_de_logueo()
    {
        $response = $this->get(route('venta.mostrar', ['id' => 1]));
        $response->assertRedirect(route('login'));
    }

    public function test_8_acceder_verDetalles_ventas_antes_de_logueo_id_negativo()
    {
        $response = $this->get(route('venta.mostrar', ['id' => -1]));
        $response->assertRedirect(route('login'));
    }
}
