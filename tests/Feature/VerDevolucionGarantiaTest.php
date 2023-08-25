<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerDevolucionGarantiaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // H6 - Estefany López
    public function test_32_acceder_nueva_dev_garantia_antes_de_logueo()
    {
        $response = $this->get(route('show.devolucion'));
        $response->assertRedirect(route('login'));
    }

    public function test_33_acceder_nueva_dev_garantia_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('show.devolucion'));
        $response->assertStatus(200);
    }
}
