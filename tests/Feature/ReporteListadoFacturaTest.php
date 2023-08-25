<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use APP\Models\RangoFactura;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReporteListadoFacturaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
      /************************ REPORTE LISTADO FACTURA (es el pdf unicamente) *****************/
     /************************ PRUEBA 39 *****************/
    //Verifica que este bien la ruta para login
    public function test_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
     /************************ PRUEBA 40 *****************/
    //Verifica que este bien la ruta home
    public function test_Ruta_Home()
    {
        //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /************************ PRUEBA 41 *****************/
    //Ruta inválida para login
    public function test_Validar_ruta_invalida_login()
    {
        $response = $this->get('/15252hhg.com');
        $response->assertStatus(404);
    }
    
    /************************ PRUEBA 42 *****************/
    public function test_Vista_ReporteFactura()
    {
        //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        
        // Supongamos que tienes una ruta para generar el reporte de factura
        $response = $this->get('/listaRangoFactura');
        // Verifica que la respuesta tenga un código de estado exitoso
        $response->assertStatus(200);

        // Verifica que el contenido del reporte sea el esperado
        
        $response->assertSee('Listado de rangos de facturas'); //prueba para ver el titulo de la factura
        $response->assertSeeInOrder([ 
            'CAI',
            'Fecha Inicio',
            'Fecha Final',
            'Factura Inicial',
            'Factura Final',
            'Estado',
        ]);
    }

    /************************ PRUEBA 43 *****************/
     //verifica la ruta para reporte de rango factura
    public function test_ruta_ReporteFactura(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/listaRangoFactura');
        $response->assertStatus(200);
    }

    /************************ PRUEBA 44 *****************/
    //verifica que la ruta de reporte este autenticada
    public function test_usuario_sin_autenticacion_redirigido_listado_Rango_Factura()
    {
       //Listado rango factura
        $response = $this->get('/listaRangoFactura');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }
    
    /************************ PRUEBA 45 *****************/
     //Ruta inválida para Reporte Factura
    public function test_Validar_ruta_invalida_ReporteFactura()
    {
    $response = $this->get('/ReporteFactura');
        $response->assertStatus(404);
    }
     /************************ PRUEBA 46 *****************/
    public function test_Vista_RangoFactura_RegistroFactura(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado rango factura
        $response = $this->actingAs($user)->get('/createRangoFactura');
        $response->assertStatus(200);
        $response->assertSee('Registrar rango factura');  // Verificar que la vista contiene el título "Listado de Pedidos"
        $response->assertSee('Número CAI');
        $response->assertSee('Fecha Inicio'); //si coloco assertSee me tira error y no pasa la prueba
        $response->assertSee('Fecha Vencimiento'); //icono de basurero
        $response->assertSee('Factura Inicial');
        $response->assertSee('Factura Final'); //icono de agregar un nuevo pedido en el listado
        $response->assertSeeInOrder(['Guardar','Limpiar','Cerrar']);
    }

     /************************ PRUEBA 47 *****************/
    public function test_validar_ruta_listadorangofactura(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/createRangoFactura');
        $response->assertStatus(200);
    }
     /************************ PRUEBA 48 *****************/
    public function test_validar_ruta_sinAcceso_listadorangofactura(){
        //Listado rango factura
        $response = $this->get('/createRangoFactura');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }
    /************************ PRUEBA 49 *****************/
    public function test_validar_ruta_Invalida_listadorangofactura(){
        //Listado rango factura
        $response = $this->get('/12345678898');
        $response->assertStatus(404);
    }

}
