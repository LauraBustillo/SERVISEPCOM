<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ValidacionesTest extends TestCase
{
    /** @test */
    public function test_n1_validar_seguridad_ruta_listado_reparaciones_de_equipos()
    {
        $response = $this->get(route('reparacion.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_n2_validar_acceso_a_ruta_con_usuario_administrador_listado_reparaciones_de_equipos()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('reparacion.index'));
        $response->assertStatus(200);
    }

    /** @test */
    public function test_n3_validar_seguridad_ruta_ver_informacion_de_reparacion()
    {
        $response = $this->get(route('repacionones.ver', ['id' => 1]));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_n4_validar_acceso_a_ruta_con_usuario_administrador_ver_informacion_de_reparacion()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('repacionones.ver', ['id' => 1]));
        $response->assertStatus(200);
    }

    /** @test */
    public function test_n5_validar_id_solo_numeros_ver_informacion_de_reparacion()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('repacionones.ver', ['id' => 'id']));
        $response->assertStatus(404);
    }


    /** @test */
    public function test_n6_validar_seguridad_ruta_ver_imprimir_garantia_reparaciones()
    {
        $response = $this->get(route('pdf.garantia', ['id' => 1]));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_n7_validar_acceso_a_ruta_con_usuario_administrador_ver_imprimir_garantia_reparaciones()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('pdf.garantia', ['id' => 1]));
        $response->assertStatus(200);
    }

    /** @test */
    public function test_n8_validar_id_solo_numeros_ver_imprimir_garantia_reparaciones()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('pdf.garantia', ['id' => 'id']));
        $response->assertStatus(404);
    }

    /** @test */
    public function test_n9_validar_id_solo_numeros_ver_imprimir_garantia_reparaciones_id_demasiado_grande()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('pdf.garantia', ['id' => 1787878787878787878787878787878787878]));
        $response->assertStatus(404);
    }
}
