<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class iniciosesion_recuperar_restablecercontraseña extends TestCase
{
    /** @test */
    public function n1_validar_seguridad_ruta_drashboard()
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function n2_validar_seguridad_ruta_drashboard_ruta_desconocida()
    {
        $response = $this->get('/user');
        $response->assertStatus(404);
    }

    /** @test */
    public function n3_validar_acceso_a_ruta_con_usuario_administrador_listado_reparaciones_de_equipos()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);
    }
    /** @test */
    public function n5_validar_login_datos_existentes()
    {
        $response = $this->post(route('login'), ['email' => 'admin@gmail.com', 'password' => '12345678']);

        $response->assertRedirect(route('dashboard'));
    }
    /** @test */
    public function n6_validar_login_email_no_existente()
    {
        $response = $this->post(route('login'), ['email' => 'admin@privado.com', 'password' => '12345678']);

        $response->assertInvalid([
            'email' => 'Estas credenciales no coinciden con nuestros registros.',
        ]);
    }
    /** @test */
    public function n7_validar_login_password_no_existente()
    {
        $response = $this->post(route('login'), ['email' => 'admin@gmail.com', 'password' => '12345673333']);

        $response->assertInvalid([
            'email' => 'Estas credenciales no coinciden con nuestros registros.',
        ]);
    }

    /** @test */
    public function n8_validar_ruta_password_reset()
    {
        $response = $this->get(route('password.request'));
        $response->assertStatus(200);
    }

    /** @test */
    public function n9_validar_ruta_password_reset_correo_existente()
    {
        $response = $this->post(route('password.request'), [
            'email' => 'admin@gmail.com'
        ]);


        $response->assertRedirect();
    }

    /** @test */
    public function n10_validar_ruta_password_reset_correo_inexistente()
    {
        $response = $this->post(route('password.email'), [
            'email' => 'cristiana.ferrera@unah.edu.hn'
        ]);


        $response->assertInvalid([
            'email' => 'No se ha encontrado un usuario con esa dirección de correo.',
        ]);
    }
}
