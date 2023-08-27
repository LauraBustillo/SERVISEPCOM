<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ListadoUsuarioTest extends TestCase
{

    /** @test */
    public function test_n1_validar_seguridad_ruta_listado_de_gastos()
    {
        $response = $this->get(route('gasto.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_n2_validar_acceso_a_ruta_con_usuario_administrador_listado_de_gastos()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('gasto.index'));
        $response->assertStatus(200);
    }
}

