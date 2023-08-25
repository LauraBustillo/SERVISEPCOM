<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImpresionFacturaVentaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // H1 - Estefany López
    public function test_18_acceder_pdf_ventas_vista_correcta()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('Venta.pdf', ['id' => 1]));
        $response->assertViewHas('factura');
    }

    public function test_19_acceder_pdf_ventas_valor_cliente_correcto()
    {
        $user = User::find(1);

        Auth::login($user);

        $factura = Venta::findOrFail(1);
        $response = $this->get(route('Venta.pdf', ['id' => 1]));
        $response->assertSeeText($factura->clienteFactura);
    }
}
