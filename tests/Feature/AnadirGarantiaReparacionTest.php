<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnadirGarantiaReparacionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // H4 - Estefany López
    public function test_28_acceder_pdf_inventario_reparaciones_radio_garantia()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('RegistroReparacion'));
        $response->assertSeeText('Garantia por reparación');
    }

    public function test_29_acceder_pdf_inventario_reparaciones_campo_fecha_inicio()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('RegistroReparacion'));
        $response->assertSeeText('Fecha Inicio');
    }
}
