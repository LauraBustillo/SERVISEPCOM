<?php

namespace Tests\Feature;


use App\Models\PlanillaDetalle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegistroPlanillaTest extends TestCase
{
    /** @test */
    public function test_n1_validar_seguridad_ruta_listado_de_planillas()
    {
        $response = $this->get(route('index.planilla'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_n2_validar_acceso_a_ruta_con_usuario_administrador_listado_de_planillas()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->get(route('index.planilla'));
        $response->assertStatus(200);
    }

    /** @test */
    public function test_n3_validar_seguridad_ruta_nuevo_registro_de_planilla()
    {
        $response = $this->get(route('show.registroPlanilla'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_n4_validar_acceso_a_ruta_con_usuario_administrador_nuevo_registro_de_planilla()
    {

        $user = User::find(1);
        Auth::login($user);
        $response = $this->get(route('show.registroPlanilla'));
        $response->assertStatus(200);
    }

    /** @test */
    public function test_n5_validar_seguridad_al_registrar_nuevo_registro_de_planilla()
    {
        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => 8,
            ]
        );

        $response->assertRedirect(route('login'));
    }
}
