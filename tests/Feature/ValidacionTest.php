<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidacionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    // H9 - Estefany López
    public function test_14_acceder_pdf_ventas_antes_de_logueo()
    {
        $response = $this->get(route('Venta.pdf', ['id' => 1]));
        $response->assertRedirect(route('login'));
    }

    public function test_15_acceder_pdf_ventas_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('Venta.pdf', ['id' => 1]));
        $response->assertStatus(200);
    }
}
