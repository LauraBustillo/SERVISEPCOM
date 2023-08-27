<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PermisosTest extends TestCase
{

    /** @test */
    public function test_n11_validar_ruta_usuario_sin_privilegios_empleado_vista_nuevo()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->get(route('show.registroEmpleado'));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n12_validar_ruta_usuario_sin_privilegios_empleado_registrar()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->post(route('datos'));

        $response->assertRedirect(route('dashboard'));
    }
    /** @test */
    public function test_n13_validar_ruta_usuario_sin_privilegios_empleado_lista()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->get(route('empleado.index'));

        $response->assertRedirect(route('dashboard'));
    }
    /** @test */
    public function test_n14_validar_ruta_usuario_sin_privilegios_empleado_lista_post()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->post(route('empleado.index'));

        $response->assertRedirect(route('dashboard'));
    }
    /** @test */
    public function test_n15_validar_ruta_usuario_sin_privilegios_empleado_ver()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->get(route('empleado.mostrar', ['id' => 1]));

        $response->assertRedirect(route('dashboard'));
    }
    /** @test */
    public function test_n16_validar_ruta_usuario_sin_privilegios_empleado_ver_actualizar()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->get(route('empleado.editar', ['id' => 1]));

        $response->assertRedirect(route('dashboard'));
    }
    /** @test */
    public function test_n17_validar_ruta_usuario_sin_privilegios_empleado_actualizar()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->put(route('empleado.update', ['id' => 1]));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n18_validar_ruta_planilla_sin_privilegios_empleado_planilla_registrar()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->get(route('show.registroPlanilla'));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n19_validar_ruta_planilla_sin_privilegios_empleado_planilla_listado()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->get(route('index.planilla'));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n20_validar_ruta_planilla_sin_privilegios_empleado_planilla_restar_horas()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->put(route('put.planilla.dias'));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n21_validar_ruta_planilla_sin_privilegios_empleado_planilla_horas_diurnas()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->put(route('put.planilla.hora_diurnas'));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n22_validar_ruta_planilla_sin_privilegios_empleado_planilla_nocturnas_horas()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->put(route('put.planilla.hora_nocturna'));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n23_validar_ruta_planilla_sin_privilegios_empleado_planilla_borrar()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->delete(route('delete.planilla', ['id' => 1]));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n24_validar_ruta_planilla_sin_privilegios_empleado_planilla_guardar_planilla()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->post(route('guardar.planilla', ['id' => 1]));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n25_validar_ruta_planilla_sin_privilegios_empleado_planilla_mostrar_planilla()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->get(route('planilla.mostrar', ['id' => 1]));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n26_validar_ruta_rango_factura_sin_privilegios_empleado_mostrar_lista_rangos()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->get(route('RangoFactura.index'));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n27_validar_ruta_rango_factura_sin_privilegios_empleado_mostrar_nuevo_rango_factura()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->get(route('create.rangofactura'));

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function test_n28_validar_ruta_rango_factura_sin_privilegios_empleado_mostrar_registro_nuevo_rango_factura()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->post(route('store.rangofactura'));

        $response->assertRedirect(route('dashboard'));
    }
}
