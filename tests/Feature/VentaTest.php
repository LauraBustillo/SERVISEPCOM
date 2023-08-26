<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VentaTest extends TestCase
{

    // =======================================================================
    //                  VALIDAR RUTAS Y ACCESOS A LAS RUTAS
    // =======================================================================


    // Validar Ruta de registro de venta
    public function test_ValidacionRutaRegistroDeVenta()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/registroventa');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de registro de venta
    public function test_AccederAlRegistroDeVenta()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->actingAs($user)->get('/registroventa');
        $response->assertStatus(200);
        $response->assertSee('Registro de venta'); 
        $response->assertSee('Número de Factura'); 
        $response->assertSee('Empleado'); 
        $response->assertSee('Fecha de facturación');
        $response->assertSee('Cliente');
        $response->assertSee('Garantia');
        // $response->assertSee('Agregar detalle');
        $response->assertSeeInOrder(['Facturar', 'Cerrar']);
    }

    // Validar Ruta de detalles de factura
    public function test_ValidacionRutaDetallesDeFactura()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/LVentas/1');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de detalles de factura
    public function test_AccederDetallesDeFactura()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->actingAs($user)->get('/LVentas/1');
        $response->assertStatus(200);
        $response->assertSee('Información de la factura de Ventas'); 
        $response->assertSee('Factura N° :'); 
        $response->assertSee('CAI :'); 
        $response->assertSeeInOrder(['Volver a la lista', 'Imprimir']);
    }

    // =======================================================================
    //                  VALIDAR USUARIO SIN AUTENTICACION
    // =======================================================================

    public function test_UsuarioSinAutenticacionEnRegistroDeVenta()
    {
        $response = $this->get('/registroventa');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_UsuarioSinAutenticacionEnListadoDeVenta()
    {
        $response = $this->get('/venta');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_UsuarioSinAutenticacionEnDetalleDeVenta()
    {
        $response = $this->get('/LVentas/1');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    // =======================================================================
    //                 VALIDAR BOTONES DE REPARACIONES
    // =======================================================================

    public function test_BotonAgregarEnListadoDeVentas(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('/venta');
          $response = $this->followingRedirects()->actingAs($user)->get(route('show.registroventa'));
        $response->assertStatus(200);
    }

    public function test_BotonVolverEnRegistroDeVenta(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('registroventa');
          $response = $this->followingRedirects()->actingAs($user)->get(route('Venta.index'));
        $response->assertStatus(200);
    }

    public function test_BotonDetallesEnListadoDeVentas(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('/venta');
        $response = $this->followingRedirects()->actingAs($user)->get('/LVentas/1');
        $response->assertStatus(200);
    }

    public function test_BotonVolverEnDetallesDeVenta(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('LVentas/1');
          $response = $this->followingRedirects()->actingAs($user)->get(route('Venta.index'));
        $response->assertStatus(200);
    }

    // =======================================================================
    //                 VALIDAR CAMPOS DE VENTA
    // =======================================================================

    // Validar campo numeroFactura
    public function test_ValidarNumeroDeFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'numeroFactura' => '000-001-04-00000010', 
        ]);

        $response->assertStatus(302);
    }

    // Validar campo numeroFactura no puede estar vacio
    public function test_ValidarNoVacioEnNumeroDeFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'numeroFactura' => '', 
        ]);

        $response->assertSessionHasErrors('numeroFactura'); 
        $this->assertContains('El numero de la factura es obligatorio', 
        session('errors')->get('numeroFactura'));
    }

    // Validar campo numeroFactura con poca cantidad de numeros
    public function test_ValidarMinimoDeNumerosEnNumeroDeFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'numeroFactura' => '000-001', 
        ]);

        $response->assertSessionHasErrors('numeroFactura'); 

        $this->assertContains('El numero de la factura es obligatorio', 
        session('errors')->get('numeroFactura'));
    }

    // Validar campo numeroFactura con mucha cantidad de numeros
    public function test_ValidarMaximoDeNumerosEnNumeroDeFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'numeroFactura' => '000-001-04-000000109999999999999999', 
        ]);

        $response->assertSessionHasErrors('numeroFactura'); 

        $this->assertContains('El numero de la factura es obligatorio', 
        session('errors')->get('numeroFactura'));
    }

    // Validar campo fechaFactura
    public function test_ValidarFechaFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'fechaFactura' => '24/08/2023', 
        ]);

        $response->assertStatus(302);
    }

    // Validar campo fechaFactura con 0
    public function test_ValidarConCeroFechaFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'fechaFactura' => '00/00/0000', 
        ]);

        $response->assertSessionHasErrors('fechaFactura');
    }

    // Validar campo fechaFactura con 9
    public function test_ValidarConNueveFechaFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'fechaFactura' => '99/99/9999', 
        ]);

        $response->assertSessionHasErrors('fechaFactura');
    }

    // Validar campo fechaFactura no puede estar vacio
    public function test_ValidarNoVacioEnFechaDeFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'fechaFactura' => '', 
        ]);

        $response->assertSessionHasErrors('fechaFactura');
        $this->assertContains('La fecha de la factura es obligatoria', 
        session('errors')->get('fechaFactura'));
    }

    // Validar campo clienteFactura
    public function test_ValidarClienteFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'clienteFactura' => 'Carlos Daniel Bucardo Toledo', 
        ]);

        $response->assertStatus(302);
    }
    
    // Validar campo clienteFactura no puede estar vacio
    public function test_ValidarNoVacioEnClienteFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'clienteFactura' => '', 
        ]);

        $response->assertSessionHasErrors('clienteFactura'); 
        $this->assertContains('El cliente es obligatorio', 
        session('errors')->get('clienteFactura'));
    }

    // Validar campo clienteFactura no debe permitir numeros
    public function test_ValidarNoNumerosEnClienteFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'clienteFactura' => '123', 
        ]);

        $response->assertSessionHasErrors('clienteFactura'); 

        $this->assertContains('El cliente es obligatorio', 
        session('errors')->get('clienteFactura'));
    }

    // Validar campo clienteFactura no debe permitir todo mayusculas
    public function test_ValidarMayusculasEnClienteFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'clienteFactura' => 'CARLOS DANIEL BUCARDO TOLEDO', 
        ]);

        $response->assertSessionHasErrors('clienteFactura'); 
    }

    // Validar campo clienteFactura no debe permitir todo minusculas
    public function test_ValidarMinusculasEnClienteFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'clienteFactura' => 'carlos daniel bucardo toledo', 
        ]);

        $response->assertSessionHasErrors('clienteFactura'); 
    }

    // Validar campo clienteFactura no debe permitir simbolos
    public function test_ValidarNoSimbolosEnClienteFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'clienteFactura' => '.<>{}_', 
        ]);

        $response->assertSessionHasErrors('clienteFactura'); 
    }

    // =======================================================================
    //                 VALIDAR CAMPOS DE AGREGAR DETALLES
    // =======================================================================

    // Validar campo detallefactura
    public function test_ValidarDetalleDeFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/detalle_ventas', [
            'detallefactura' => 'El cliente Carlos Daniel Bucardo Toledo compro', 
        ]);

        $response->assertStatus(302);
    }

    // Validar campo detallefactura no puede estar vacio
    public function test_ValidarNoVacioEnDetalleFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/detalle_ventas', [
            'detallefactura' => '', 
        ]);

        $response->assertSessionHasErrors('detallefactura'); 
        $this->assertContains('Debe de agregar detalles', 
        session('errors')->get('detallefactura'));
    }

    // Validar campo nombre_producto no puede estar vacio
    public function test_ValidarNoVacioEnNombreProductoAgregarDetalles()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/detalle_ventas', [
            'nombre_producto' => '', 
        ]);

        $response->assertSessionHasErrors('nombre_producto'); 
        $this->assertContains('Seleccionar producto', 
        session('errors')->get('nombre_producto'));
    }

    // Validar campo Marca no puede estar vacio
    public function test_ValidarNoVacioEnMarcaAgregarDetalles()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/detalle_ventas', [
            'Marca' => '', 
        ]);

        $response->assertSessionHasErrors('Marca'); 
        $this->assertContains('Seleccionar producto', 
        session('errors')->get('Marca'));
    }

    // Validar campo Cantidad no puede estar vacio
    public function test_ValidarNoVacioEnCantidadAgregarDetalles()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/detalle_ventas', [
            'Cantidad' => '',
        ]);

        $response->assertSessionHasErrors('Cantidad'); 
        $this->assertContains('La cantidad es obligatoria', 
        session('errors')->get('Cantidad'));
    }
    
    // =======================================================================
    //                      VALIDAR FORMULARIO VACIO
    // =======================================================================

    // Formulario vacio en venta
    public function test_ValidacionFormularioVacioEnVenta()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);
        
        $response = $this->post('/registroventa', [
            'numeroFactura' => '',
            'fechaFactura' => '',
            'empleadoVentas' => '',
            'totalFactura' => '',
            'clienteFactura' => '',
        ]);
        $response->assertSessionHasErrors('numeroFactura');
        $response->assertSessionHasErrors('fechaFactura');
        $response->assertSessionHasErrors('empleadoVentas');
        $response->assertSessionHasErrors('totalFactura');
        $response->assertSessionHasErrors('clienteFactura');
    }

    // =======================================================================
    //                      REGISTRAR Y REDIRECCIONAR
    // =======================================================================

    public function test_RegistrarVenta()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $ventaData = [
            'numeroFactura' => '000-001-04-00000000',
            'fechaFactura' => '2023-08-16',
            'empleadoVentas' => 'Administrador',
            'totalFactura' => '1380.00',
            'clienteFactura' => 'Carlos Daniel Bucardo Toledo',
        ];

        $response = $this->withoutMiddleware()->post('/venta', $ventaData);
        $this->assertDatabaseHas('ventas', $ventaData);
    }

    public function test_agregar_venta_sin_duplicar_factura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/registroventa', [
            'numeroFactura' => '000-001-04-00000000',
        ]);

        $ventaData = [
            'numeroFactura' => '000-001-04-00000000',
            'fechaFactura' => '2023-08-16',
            'empleadoVentas' => 'Administrador',
            'totalFactura' => '1380.00',
            'clienteFactura' => 'Carlos Daniel Bucardo Toledo',
        ];

        $response = $this->post('/registroventa', $ventaData);
        $response->assertSessionHasErrors('numeroFactura');
    }

    public function test_RedireccionDespuesDeRegistrarUnaVenta()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);
        
        $response = $this->post('/registroventa',
        [
            'numeroFactura' => '000-001-04-00000000',
            'fechaFactura' => '2023-08-16',
            'empleadoVentas' => 'Administrador',
            'totalFactura' => '1380.00',
            'clienteFactura' => 'Carlos Daniel Bucardo Toledo',
        ]);

        $response->assertStatus(302); 
        $response->assertRedirect('/venta');
    }
}