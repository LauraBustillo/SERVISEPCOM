<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerInventarioReparacionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // H3 - Estefany López
    public function test_26_acceder_pdf_inventario_reparaciones_boton_agregar_inventario()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('RegistroReparacion'));
        $response->assertSeeText('Ver inventario');
    }

    public function test_27_acceder_pdf_inventario_reparaciones_modal_agregar_inventario()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('RegistroReparacion'));
        $response->assertSeeText('Agregar Producto Inventario');
    }
}
