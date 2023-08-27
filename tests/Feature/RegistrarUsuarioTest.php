<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegistrarUsuarioTest extends TestCase
{

    /** @test */
    public function test_n3_validar_seguridad_ruta_nuevo_registro_de_usuarios()
    {
        $response = $this->get(route('show.registroUsuarios'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_n4_validar_acceso_a_ruta_con_usuario_administrador_nuevo_registro_de_usuarios()
    {

        $user = User::find(1);
        Auth::login($user);
        $response = $this->get(route('show.registroUsuarios'));
        $response->assertStatus(200);
    }

    public function test_n5_validar_seguridad_al_registrar_nuevo_registro_de_usuarios()
    {
        $response = $this->post(
            route('store.gasto'),
            [
                'name' => 'usuario123',
                'id_empleado' => 1,
                'email' => 'usuario123@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_n6_validar_mensaje_de_exito_al_registrar_nuevo_registro_de_gastos()
    {
        $user = User::find(1);
        Auth::login($user);

        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            DB::delete('delete from roles where id_usuario = ?', [$newuser[0]->id]);
            DB::delete('delete from users where name = ?', [$newuser[0]->name]);
        }


        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 2,
                'email' => 'usuario123@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertRedirect(route('index.usuario'));
    }

    /** @test */
    public function test_n7_validar_mensaje_de_exito_al_registrar_nuevo_registro_de_gastos_con_usuario_sin_privilegios()
    {
        $newuser = User::where('name', '=', 'usuario123')->get();

        if (count($newuser) > 0) {
            Auth::login($newuser[0]);
        }

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 2,
                'email' => 'usuario123@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertRedirect(route('dashboard'));
    }


    /** @test */
    // 'name.required' => 'El usuario es obligatorio',
    // 'name.string'=>'El nombre debe ser una cadena de texto.',
    // 'name.max'=>'El nombre no puede tener más de 100 caracteres.',
    public function test_n8_validar_al_registrar_nuevo_registro_de_usuarios_campo_nombre_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => '',
                'id_empleado' => 2,
                'email' => 'usuario1234@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'name' => 'El usuario es obligatorio',
        ]);
    }

    /** @test */
    public function test_n9_validar_al_registrar_nuevo_registro_de_usuarios_campo_nombre_debe_ser_cadena_texto()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 909090,
                'id_empleado' => 2,
                'email' => 'usuario1234@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'name' => 'El nombre debe ser una cadena de texto.',
        ]);
    }

    /** @test */
    public function test_n10_validar_al_registrar_nuevo_registro_de_usuarios_campo_nombre_minimo_de_caracteres()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => '8as7d98as7d98a7s98d7a98sd7a98s7d98a7sd98a7s98d7a9s87d98as7d98as7d98a7uisa8dfy98sd7f98sad7f987sad987f98as7df98a7fds',
                'id_empleado' => 2,
                'email' => 'usuario1234@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'name' => 'El nombre no puede tener más de 100 caracteres.',
        ]);
    }

    // 'id_empleado.required'=>'Selecione un empleado',
    // 'id_empleado.unique'=>'El empleado ya está registrado',
    /** @test */
    public function test_n11_validar_al_registrar_nuevo_registro_de_usuarios_campo_id_empleado_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => '',
                'email' => 'usuario1234@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'id_empleado' => 'Selecione un empleado',
        ]);
    }
    /** @test */
    public function test_n12_validar_al_registrar_nuevo_registro_de_usuarios_campo_id_empleado_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 1,
                'email' => 'usuario1234@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'id_empleado' => 'El empleado ya está registrado',
        ]);
    }

    /** @test */
    // 'email.required'=>'El correo es obligatorio',
    // 'email.unique'=>'El correo ya esta en uso',
    // 'email.string' => 'El correo debe ser una cadena de texto.',
    // 'email.email' => 'El formato del correo no es válido.',
    // 'email.max' => 'El correo no puede tener más de 100 caracteres.',
    public function test_n13_validar_al_registrar_nuevo_registro_de_usuarios_campo_email_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 3,
                'email' => '',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'email' => 'El correo es obligatorio',
        ]);
    }
    /** @test */
    public function test_n14_validar_al_registrar_nuevo_registro_de_usuarios_campo_email_unico()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 3,
                'email' => 'admin@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'email' => 'El correo ya esta en uso',
        ]);
    }

    /** @test */
    public function test_n15_validar_al_registrar_nuevo_registro_de_usuarios_campo_email_debe_ser_cadena_texto()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario1223',
                'id_empleado' => 3,
                'email' => 887878,
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'email' => 'El correo debe ser una cadena de texto.',
        ]);
    }
    /** @test */
    public function test_n16_validar_al_registrar_nuevo_registro_de_usuarios_campo_email_formato_correo_invalido()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario1223',
                'id_empleado' => 3,
                'email' => 'admingmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'email' => 'El formato del correo no es válido.',
        ]);
    }
    /** @test */
    public function test_n17_validar_al_registrar_nuevo_registro_de_usuarios_campo_email_maximo_caracteres()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario1223',
                'id_empleado' => 3,
                'email' => 'adminasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasddasfasdasdasdasdasdasdasdasdasdasdasdasdasdasdasd@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'email' => 'El correo no puede tener más de 100 caracteres.',
        ]);
    }

    /** @test */
    // 'password.required'=>'La contraseña es obligatoria',
    // 'password.min'=>'La contraseña debe tener minimo 8 caracteres',
    public function test_n18_validar_al_registrar_nuevo_registro_de_usuarios_campo_password_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 2,
                'email' => 'usuario1234@gmail.com',
                'password' => '',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'password' => 'La contraseña es obligatoria',
        ]);
    }
    /** @test */
    public function test_n19_validar_al_registrar_nuevo_registro_de_usuarios_campo_password_minimo_carateres()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 2,
                'email' => 'usuario1234@gmail.com',
                'password' => '12',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'password' => 'La contraseña debe tener minimo 8 caracteres',
        ]);
    }

    /** @test */
    // 'password_confirmation.required'=>'Debe confirmar la contraseña',
    // 'password_confirmation.min'=>'La contraseña debe tener minimo 8 caracteres',
    // 'password_confirmation.same'=>'La contraseña deben coincidir con al confirmacion',
    public function test_n20_validar_al_registrar_nuevo_registro_de_usuarios_campo_password_confirmation_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 2,
                'email' => 'usuario1234@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => '',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'password_confirmation' => 'Debe confirmar la contraseña',
        ]);
    }

    /** @test */
    public function test_n21_validar_al_registrar_nuevo_registro_de_usuarios_campo_password_confirmation_minimo_caracteres()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 2,
                'email' => 'usuario1234@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'd',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'password_confirmation' => 'La contraseña debe tener minimo 8 caracteres',
        ]);
    }
    /** @test */
    public function test_n22_validar_al_registrar_nuevo_registro_de_usuarios_campo_password_confirmation_coincidencia_con_password()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 2,
                'email' => 'usuario1234@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@',
                'rol_usuario' => 'Empleado',
            ]
        );

        $response->assertInvalid([
            'password_confirmation' => 'La contraseña deben coincidir con al confirmacion',
        ]);
    }

    /** @test */
    //'rol_usuario.required'=>'Selecione un rol',
    public function test_n23_validar_al_registrar_nuevo_registro_de_usuarios_campo_rol_usuario_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->post(
            route('store.registroUsuarios'),
            [
                'name' => 'usuario123',
                'id_empleado' => 3,
                'email' => 'usuario1234@gmail.com',
                'password' => 'Usuario123@@',
                'password_confirmation' => 'Usuario123@@',
                'rol_usuario' => '',
            ]
        );

        $response->assertInvalid([
            'rol_usuario' => 'Selecione un rol',
        ]);
    }
}
