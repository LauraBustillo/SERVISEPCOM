<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GarantiaVentaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    // H2 - Estefany López
    public function test_20_acceder_pdf_garantias_ventas_antes_de_logueo()
    {
        $response = $this->get(route('VentaGarantia.pdf', ['id' => 1]));
        $response->assertRedirect(route('login'));
    }

    public function test_21_acceder_pdf_garantias_ventas_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('VentaGarantia.pdf', ['id' => 1]));
        $response->assertStatus(200);
    }

    public function test_22_acceder_pdf_garantias_ventas_id_negativo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('VentaGarantia.pdf', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_23_acceder_pdf_garantias_ventas_id_cadena_de_text()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('VentaGarantia.pdf', ['id' => 'id']));
        $response->assertStatus(404);
    }

    public function test_24_acceder_pdf_garantias_ventas_vista_correcta()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('VentaGarantia.pdf', ['id' => 1]));
        $response->assertViewIs('facturaGarantia');
    }

    public function test_25_acceder_pdf_garantias_ventas_valor_fecha_inicio_correcto()
    {
        $user = User::find(1);

        Auth::login($user);

        $factura = Garantia::findOrFail(1);
        $response = $this->get(route('VentaGarantia.pdf', ['id' => 1]));
        $response->assertSeeText(Carbon::parse($factura->fecha_inicio)->setTimezone('America/Tegucigalpa')->format('d-m-Y'));
    }
}
