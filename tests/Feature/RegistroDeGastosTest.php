<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegistroDeGastosTest extends TestCase
{
    /** @test */
    public function test_n3_validar_seguridad_ruta_nuevo_registro_de_gastos()
    {
        $response = $this->get(route('show.gasto'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_n4_validar_acceso_a_ruta_con_usuario_administrador_nuevo_registro_de_gastos()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('show.gasto'));
        $response->assertStatus(200);
    }


    public function test_n5_validar_seguridad_al_registrar_nuevo_registro_de_gastos()
    {
        DB::delete('delete from gastos where nombre_gasto = "Perdida"');

        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );
        $response->assertRedirect(route('login'));
    }
    /** @test */
    public function test_n6_validar_mensaje_de_exito_al_registrar_nuevo_registro_de_gastos()
    {
        $user = User::find(1);
        Auth::login($user);
        DB::delete('delete from gastos where nombre_gasto = "Perdida"');

        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertRedirect(route('gasto.index'));
    }


    /** @test */
    //'nombre_gasto.required' => 'El nombre del gasto es requerido',
    //'nombre_gasto.min'=>'El nombre del gasto debe tener minimo 3 letras',
    //'nombre_gasto.max'=>'El nombre del gasto no debe de tener más de 25 letras',
    //'nombre_gasto.regex'=>'El nombre del gasto solo puede tener letras',
    public function test_n7_validar_al_registrar_nuevo_registro_de_gastos_campo_nombre_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => '',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'nombre_gasto' => 'El nombre del gasto es requerido',
        ]);
    }
    /** @test */
    public function test_n8_validar_al_registrar_nuevo_registro_de_gastos_campo_nombre_caracteres_minimos()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'P',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'nombre_gasto' => 'El nombre del gasto debe tener minimo 3 letras',
        ]);
    }
    /** @test */
    public function test_n9_validar_al_registrar_nuevo_registro_de_gastos_campo_nombre_caracteres_maximos()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'PerdidaFiscadeCapitalPersonale',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'nombre_gasto' => 'El nombre del gasto no debe de tener más de 25 letras',
        ]);
    }
    /** @test */
    public function test_n10_validar_al_registrar_nuevo_registro_de_gastos_campo_nombre_caracteres_solo_texto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida31213',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'nombre_gasto' => 'El nombre del gasto solo puede tener letras',
        ]);
    }

    //   'tipo_gasto.required' => 'El tipo de gasto es requerido',
    //   'tipo_gasto.regex' => 'El tipo de gasto solo puede tener letras',
    /** @test */
    public function test_n11_validar_al_registrar_nuevo_registro_de_gastos_campo_tipo_gasto_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => '',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'tipo_gasto' => 'El tipo de gasto es requerido',
        ]);
    }
    /** @test */
    public function test_n12_validar_al_registrar_nuevo_registro_de_gastos_campo_tipo_gasto_solo_texto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo989898',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'tipo_gasto' => 'El tipo de gasto solo puede tener letras',
        ]);
    }

    /** @test */
    //'fecha_gasto.required' => 'La fecha del gasto es requerida',
    //'fecha_gasto.date' =>'La fecha debe tener un valor valido en formato Y-m-d',
    public function test_n13_validar_al_registrar_nuevo_registro_de_gastos_campo_fecha_gasto_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => null,
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'fecha_gasto' => 'La fecha del gasto es requerida',
        ]);
    }
    /** @test */
    public function test_n14_validar_al_registrar_nuevo_registro_de_gastos_campo_fecha_gasto_solo_formato_date()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => 'fecha',
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'fecha_gasto' => 'La fecha debe tener un valor valido en formato Y-m-d',
        ]);
    }

    /** @test */
    // 'descripcion_gasto.required' => 'La descripción del gasto es requerida',
    // 'descripcion_gasto.min'=>'La descripción debe tener minimo 5 letras',
    public function test_n15_validar_al_registrar_nuevo_registro_de_gastos_campo_descripcion_gasto_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => '',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'descripcion_gasto' => 'La descripción del gasto es requerida',
        ]);
    }
    /** @test */
    public function test_n16_validar_al_registrar_nuevo_registro_de_gastos_campo_descripcion_gasto_carateres_minimos()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gas',
                'total_gasto' => 900,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'descripcion_gasto' => 'La descripción debe tener minimo 5 letras',
        ]);
    }
    /** @test */
    // 'total_gasto.required' => 'El total del gasto es requerido',
    // 'total_gasto.numeric' => 'El total del gasto solo debe contener números',
    // 'total_gasto.min'=>'El total del gasto debe contener minimo 2 números y no acepta números negativos',
    // 'total_gasto.max'=>'El total del gasto debe contener maximo 5 números',
    public function test_n17_validar_al_registrar_nuevo_registro_de_gastos_campo_total_gasto_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => '',
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'total_gasto' => 'El total del gasto es requerido',
        ]);
    }
    /** @test */
    public function test_n18_validar_al_registrar_nuevo_registro_de_gastos_campo_total_gasto_solo_valores_numericos()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 'gasto',
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'total_gasto' => 'El total del gasto solo debe contener números',
        ]);
    }
    /** @test */
    public function test_n19_validar_al_registrar_nuevo_registro_de_gastos_campo_total_gasto_solo_numero_positivos()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => -10,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'total_gasto' => 'El total del gasto debe contener minimo 2 números y no acepta números negativos',
        ]);
    }
    /** @test */
    public function test_n20_validar_al_registrar_nuevo_registro_de_gastos_campo_total_gasto_ingresar_cero()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 0,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'total_gasto' => 'El total del gasto debe contener minimo 2 números y no acepta números negativos',
        ]);
    }

    /** @test */
    public function test_n21_validar_al_registrar_nuevo_registro_de_gastos_campo_total_gasto_ingresar_valores_inmensos()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 100000000,
                'responsable_gasto' => 1,
            ]
        );

        $response->assertInvalid([
            'total_gasto' => 'El total del gasto debe contener maximo 5 números',
        ]);
    }

    /** @test */
    //'responsable_gasto.required' => 'El responsable del gasto es requerido',
    //'responsable_gasto.integer' => 'El id responsable del gasto es un numero entero',
    public function test_n22_validar_al_registrar_nuevo_registro_de_gastos_campo_responsable_gasto_es_requerido()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => '',
            ]
        );

        $response->assertInvalid([
            'responsable_gasto' => 'El responsable del gasto es requerido',
        ]);
    }
    /** @test */
    public function test_n23_validar_al_registrar_nuevo_registro_de_gastos_campo_responsable_gasto_es_un_numero_entero()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from gastos where nombre_gasto = "Perdida"');
        $response = $this->post(
            route('store.gasto'),
            [
                'nombre_gasto' => 'Perdida',
                'tipo_gasto' => 'Fijo',
                'fecha_gasto' => Carbon::now()->format('Y-m-d'),
                'descripcion_gasto' => 'Gasto para prueba automatizada',
                'total_gasto' => 900,
                'responsable_gasto' => 'responsable',
            ]
        );

        $response->assertInvalid([
            'responsable_gasto' => 'El id responsable del gasto es un numero entero',
        ]);
    }
}
