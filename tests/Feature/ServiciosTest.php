<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ServiciosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /************************   SERVICIOS   *****************/
/************************ PRUEBA 57 *****************/
    public function test_Ruta_Home()
    {
        //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /************************ PRUEBA 58 *****************/
    public function test_Submenu_Servicios_Expansion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/'); // Cambia la ruta a la URL de tu página
        
        $response->assertStatus(200);
        
        // Verifica que el submenú de "Servicios" esté presente en la página
        $response->assertSee('Servicios');

        // Visitar la página que realiza la redirección
        $response = $this->get('/redireccion');

        // Simula un clic en "Servicios"
        $response = $this->get('/mantenimiento'); 
        $response = $this->get('/reparacion'); 
        $response = $this->get('/ListadoMantenimiento');
        $response = $this->get('/ListadoReparacion');
        
        // Verifica que las opciones "Mantenimiento" y "Reparación" estén presentes después de hacer clic
        $response->assertSee('Mantenimiento');
        $response->assertSee('Reparación');
    }
    /************************ PRUEBA 59 *****************/
    public function test_usuario_sin_autenticacion_redirigido_servicio_registroMantenimiento()
    {
        $response = $this->get('/mantenimiento');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
        
    }
    /************************ PRUEBA 60 *****************/
    public function test_usuario_sin_autenticacion_redirigido_servicio_ListadoMantenimiento()
    {
        $response = $this->get('/ListadoMantenimiento');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
        
    }
    /************************ PRUEBA 61 *****************/
    public function test_usuario_sin_autenticacion_redirigido_servicio_RegistroReparacion()
    {
        $response = $this->get('/reparacion');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
        
    }
    /************************ PRUEBA 62 *****************/
    public function test_usuario_sin_autenticacion_redirigido_servicio_ListadoReparacion()
    {
        $response = $this->get('/ListadoReparacion');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
        
    }
    
    /************************ PRUEBA 63 *****************/
    public function test_Validar_ruta_invalida_servicios()
    {
        $response = $this->get('/Servicios');
        $response->assertStatus(404);
    }
    /************************ PRUEBA 64 *****************/
    public function test_validar_ruta_de_direccionamiento_Submenu_RegistroMantenimiento()
    {
        $response = $this->get('/mantenimiento'); 
        $response->assertStatus(302);
    }
    /************************ PRUEBA 65 *****************/
    public function test_validar_ruta_de_direccionamiento_Submenu_ListadoMantenimiento ()
    {
        $response = $this->get('/ListadoMantenimiento'); 
        $response->assertStatus(302);
    }
    /************************ PRUEBA 66 *****************/
    public function test_validar_ruta_de_direccionamiento_Submenu_RegistroReparacion()
    {
        $response = $this->get('/reparacion'); 
        $response->assertStatus(302);
    }
    /************************ PRUEBA 67 *****************/
    public function test_validar_ruta_de_direccionamiento_Submenu_ListadoReparacion()
    {
        $response = $this->get('/ListadoReparacion'); 
        $response->assertStatus(302);
    }
    /************************ PRUEBA 68 *****************/
    public function test_Validar_ruta_invalida_Mantenimiento()
    {
        $response = $this->get('/Mantenimiento');
        $response->assertStatus(404);
    }
    /************************ PRUEBA 69 *****************/
    public function test_Validar_ruta_invalida_ListadoMantenimiento()
    {
        $response = $this->get('/CrearMantenimiento');
        $response->assertStatus(404);
    }
    /************************ PRUEBA 70 *****************/
    public function test_Validar_ruta_invalida_ListadoReparacion()
    {
        $response = $this->get('/reparacionlistado');
        $response->assertStatus(404);
    }
    /************************ PRUEBA 71 *****************/
    public function test_Validar_ruta_invalida_Reparacion()
    {
        $response = $this->get('/reparacion.registro');
        $response->assertStatus(404);
    }
}
