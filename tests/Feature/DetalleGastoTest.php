<?php

namespace Tests\Feature;

use App\Models\Empleado;
use App\Models\Gasto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DetalleGastoTest extends TestCase
{
    /** @test */
    public function test_n1_validar_seguridad_ruta_ver_detalle_de_gasto()
    {

        DB::delete('delete from gastos where nombre_gasto = "Deudas"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Deudas',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Por deuda',
                'total_gasto' => 1000,
                'responsable_gasto' => 1,
            ]
        );

        $gasto = Gasto::where('nombre_gasto', '=', 'Deudas')->get();

        if (count($gasto) > 0) {
            $response = $this->get(route('gasto.mostrar', ['id' =>  $gasto[0]->id]));
            $response->assertRedirect(route('login'));
        } else {
            $response->assertRedirect(route('login'));
        }
    }

    /** @test */
    public function test_n2_validar_acceso_a_ruta_con_usuario_administrador_ver_detalle_de_gasto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Deudas"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Deudas',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Por deuda',
                'total_gasto' => 1000,
                'responsable_gasto' => 1,
            ]
        );

        $gasto = Gasto::where('nombre_gasto', '=', 'Deudas')->get();

        $response = $this->get(route('gasto.mostrar', ['id' =>  $gasto[0]->id]));
        $response->assertStatus(200);
    }

    /** @test */
    public function test_n3_validar_id_solo_numeros_ver_detalle_de_gasto()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('gasto.mostrar', ['id' =>  'id']));
        $response->assertStatus(404);
    }

    /** @test */
    public function test_n4_validar_acceso_a_ruta_con_usuario_administrador_ver_detalle_de_gasto_texto_nombre_gasto_correcto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Deudas"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Deudas',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Por deuda',
                'total_gasto' => 1000,
                'responsable_gasto' => 1,
            ]
        );

        $gasto = Gasto::where('nombre_gasto', '=', 'Deudas')->get();

        $response = $this->get(route('gasto.mostrar', ['id' =>  $gasto[0]->id]));
        $response->assertSeeText('Deudas');
    }

    /** @test */
    public function test_n5_validar_acceso_a_ruta_con_usuario_administrador_ver_detalle_de_gasto_texto_tipo_gasto_correcto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Deudas"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Deudas',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Por deuda',
                'total_gasto' => 1000,
                'responsable_gasto' => 1,
            ]
        );

        $gasto = Gasto::where('nombre_gasto', '=', 'Deudas')->get();

        $response = $this->get(route('gasto.mostrar', ['id' =>  $gasto[0]->id]));
        $response->assertSeeText('Fijo');
    }
    /** @test */
    public function test_n6_validar_acceso_a_ruta_con_usuario_administrador_ver_detalle_de_gasto_texto_fecha_gasto_correcto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Deudas"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Deudas',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'descripcion_gasto' => 'Por deuda',
                'total_gasto' => 1000,
                'responsable_gasto' => 1,
            ]
        );

        $gasto = Gasto::where('nombre_gasto', '=', 'Deudas')->get();

        $response = $this->get(route('gasto.mostrar', ['id' =>  $gasto[0]->id]));
        $response->assertSeeText(Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'));
    }
    /** @test */
    public function test_n7_validar_acceso_a_ruta_con_usuario_administrador_ver_detalle_de_gasto_texto_descripcion_gasto_correcto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Deudas"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Deudas',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Por deuda',
                'total_gasto' => 1000,
                'responsable_gasto' => 1,
            ]
        );

        $gasto = Gasto::where('nombre_gasto', '=', 'Deudas')->get();

        $response = $this->get(route('gasto.mostrar', ['id' =>  $gasto[0]->id]));
        $response->assertSeeText('Por deuda');
    }
    /** @test */
    public function test_n8_validar_acceso_a_ruta_con_usuario_administrador_ver_detalle_de_gasto_texto_total_gasto_correcto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Deudas"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Deudas',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Por deuda',
                'total_gasto' => 1000,
                'responsable_gasto' => 1,
            ]
        );

        $gasto = Gasto::where('nombre_gasto', '=', 'Deudas')->get();

        $response = $this->get(route('gasto.mostrar', ['id' =>  $gasto[0]->id]));
        $response->assertSeeText('1000');
    }
    /** @test */
    public function test_n9_validar_acceso_a_ruta_con_usuario_administrador_ver_detalle_de_gasto_texto_responsable_gasto_correcto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Deudas"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Deudas',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Por deuda',
                'total_gasto' => 1000,
                'responsable_gasto' => 1,
            ]
        );

        $gasto = Gasto::where('nombre_gasto', '=', 'Deudas')->get();
        $responsable = Empleado::find(1);

        $response = $this->get(route('gasto.mostrar', ['id' =>  $gasto[0]->id]));
        $response->assertSeeText($responsable->Nombres . ' ' . $responsable->Apellidos);
    }
}

