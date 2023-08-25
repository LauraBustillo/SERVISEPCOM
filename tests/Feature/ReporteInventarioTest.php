<?php

namespace Tests\Feature;

use App\Models\Inventario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReporteInventarioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /************************ REPORTE LISTADO INVENTARIO (ES EL PDF) *****************/
    /************************ PRUEBA 50 *****************/
    //Verifica la ruta de home sea correctamente implementada
    public function test_Ruta_Home()
    {
        //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /************************ PRUEBA 51 *****************/
    //Verifica que sea la ruta correcta en la que se encuentra el reporte del listado de investario
    public function test_Ruta_Reporte_Listado_Inventario()
    {
        //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/Inventario');
        $response->assertStatus(200);
    }
    /************************ PRUEBA 52 *****************/
    public function test_Vista_Reporte_Inventario_pdf()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        // Visitar la página del reporte de inventario
        $response = $this->get('/Inventario');
        // Verificar que la vista se cargó correctamente
        $response->assertStatus(200);

        // Verificar que el contenido esperado está presente en la vista
        $response->assertSeeText('listado de inventario'); 
        $response->assertDontSee('nombre_producto'); 
        $response->assertSee('Marca'); 
        $response->assertSee('Proveedor'); 
        $response->assertSee('Cantidad'); 
        $response->assertSee('Categoría'); 
        $response->assertSee('Detalles'); 
    
    }
    /************************ PRUEBA 53 *****************/
    public function test_boton_descarga_pdf_reporte_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        // Realiza una solicitud GET a la ruta de descarga
        $response = $this->get('/Inventario');
        // Verifica que la respuesta tenga el código de estado 200 (OK)
        $response->assertStatus(200);
        // Verifica que el contenido del PDF se encuentra en la respuesta
        $response->assertSee('Reporte de listado de inventario');
    }
    /************************ PRUEBA 54 *****************/
    public function test_boton_imprimir_pdf_reporte_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        // Realiza una solicitud GET a la ruta de descarga
        $response = $this->get('/Inventario');
        // Verifica que la respuesta tenga el código de estado 200 (OK)
        $response->assertStatus(200);
        // Verifica que el contenido del PDF se encuentra en la respuesta
        $response->assertSee('Reporte de listado de inventario');
    }
     /************************ PRUEBA 55 *****************/
    public function test_validar_ruta_sinAcceso_Reporte_Inventario(){
        //Listado rango factura
        $response = $this->get('/Inventario');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }
    /************************ PRUEBA 56 *****************/
    //Verifica que sea la ruta correcta en la que se encuentra el reporte del listado de investario
    public function test_validar_ruta_Invalida_Reporte_Inventario(){
        //Listado rango factura
        $response = $this->get('/123ABC_Inventario.pdf');
        $response->assertStatus(404);
    }
}
