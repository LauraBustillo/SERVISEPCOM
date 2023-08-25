<?php

namespace Tests\Feature;

use App\Models\PlanillaDetalle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class detalle_planilla extends TestCase
{

    /** @test */
    public function n7_modificar_detalle_planilla_dias_sin_logueo()
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

    /** @test */
    public function n8_modificar_detalle_planilla_dias_con_usuario_administrador()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => 8,
            ]
        );

        $dias = PlanillaDetalle::find($newP->id);

        $this->assertTrue($dias->no_trabajados == 8);
    }

    /** @test */
    public function n9_validar_detalle_planilla_id_detalle_vacios()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => '',
                'no_trabajo' => 8,
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n10_validar_detalle_planilla_id_detalle_vacios_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => '',
                'no_trabajo' => 8,
            ]
        );

        $response->assertInvalid([
            'id_detalle' => 'El id del detalle es obligatorio'
        ]);
    }

    /** @test */
    public function n11_validar_detalle_planilla_dias_no_trabajados_vacios()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => '',
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n12_validar_detalle_planilla_dias_no_trabajados_vacios_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => '',
            ]
        );

        $response->assertInvalid([
            'no_trabajo' => 'Los dias son obligatorios'
        ]);
    }

    /** @test */
    public function n13_validar_detalle_planilla_dias_no_trabajados_solo_numeros_enteros()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => 'dias',
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n14_validar_detalle_planilla_dias_no_trabajados_solo_numeros_enteros_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => 'dias',
            ]
        );

        $response->assertInvalid([
            'no_trabajo' => 'Los dias son numeros enteros'
        ]);
    }

    /** @test */
    public function n15_validar_detalle_planilla_dias_no_trabajados_numero_no_mayor_al_mes()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => 90,
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n16_validar_detalle_planilla_dias_no_trabajados_numero_no_mayor_al_mes_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => 90,
            ]
        );

        $response->assertInvalid([
            'no_trabajo' => 'No puede ser mayor al numero de dias del mes actual'
        ]);
    }

    /** @test */
    public function n17_validar_detalle_planilla_dias_no_trabajados_numero_negativos()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => -1,
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n18_validar_detalle_planilla_dias_no_trabajados_numero_negativos_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.dias'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => -1,
            ]
        );

        $response->assertInvalid([
            'no_trabajo' => 'Los dias no pueden ser negativos'
        ]);
    }


    /** @test */
    public function n19_validar_detalle_planilla_horas_diurnas_id_detalle_vacios()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_diurnas'),
            [
                'id_detalle' => '',
                'no_trabajo' => 8,
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n20_validar_detalle_planilla_horas_diurnas_id_detalle_vacios_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_diurnas'),
            [
                'id_detalle' => '',
                'no_trabajo' => 8,
            ]
        );

        $response->assertInvalid([
            'id_detalle' => 'El id del detalle es obligatorio'
        ]);
    }

    /** @test */
    public function n21_validar_detalle_planilla_horas_diurnas_vacios()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_diurnas'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => '',
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n22_validar_detalle_planilla_horas_diurnas_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_diurnas'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => '',
            ]
        );

        $response->assertInvalid([
            'no_trabajo' => 'Las horas son obligatorios'
        ]);
    }

    /** @test */
    public function n23_validar_detalle_planilla_horas_diurnas_solo_numeros_enteros()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_diurnas'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => 'dias',
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n24_validar_detalle_planilla_horas_diurnas_solo_numeros_enteros_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_diurnas'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => 'dias',
            ]
        );

        $response->assertInvalid([
            'no_trabajo' => 'Las horas son numeros enteros'
        ]);
    }


    /** @test */
    public function n25_validar_detalle_planilla_horas_diurnas_numero_negativos()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_diurnas'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => -1,
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n26_validar_detalle_planilla_horas_diurnas_numero_negativos_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_diurnas'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => -1,
            ]
        );

        $response->assertInvalid([
            'no_trabajo' => 'Las horas no pueden ser negativos'
        ]);
    }


    /** @test */
    public function n27_validar_detalle_planilla_nocturnas_horas_id_detalle_vacios()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_nocturna'),
            [
                'id_detalle' => '',
                'no_trabajo' => 8,
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n28_validar_detalle_planilla_nocturnas_horas_id_detalle_vacios_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_nocturna'),
            [
                'id_detalle' => '',
                'no_trabajo' => 8,
            ]
        );

        $response->assertInvalid([
            'id_detalle' => 'El id del detalle es obligatorio'
        ]);
    }

    /** @test */
    public function n28_validar_detalle_planilla_nocturnas_horas_vacios()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_nocturna'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => '',
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n29_validar_detalle_planilla_nocturnas_horas_vacios_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_nocturna'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => '',
            ]
        );

        $response->assertInvalid([
            'no_trabajo' => 'Las horas son obligatorios'
        ]);
    }

    /** @test */
    public function n30_validar_detalle_planilla_nocturnas_horas_solo_numeros_enteros()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_nocturna'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => 'dias',
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n31_validar_detalle_planilla_nocturnas_horas_solo_numeros_enteros_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_nocturna'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => 'dias',
            ]
        );

        $response->assertInvalid([
            'no_trabajo' => 'Las horas son numeros enteros'
        ]);
    }

    /** @test */
    public function n32_validar_detalle_planilla_nocturnas_horas_numero_negativos()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_nocturna'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => -1,
            ]
        );

        $response->assertStatus(302);
    }

    /** @test */
    public function n33_validar_detalle_planilla_nocturnas_horas_numero_negativos_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $newP = PlanillaDetalle::orderBy('id', 'desc')->first();

        $response = $this->put(
            route('put.planilla.hora_nocturna'),
            [
                'id_detalle' => $newP->id,
                'no_trabajo' => -1,
            ]
        );

        $response->assertInvalid([
            'no_trabajo' => 'Las horas no pueden ser negativos'
        ]);
    }
}
