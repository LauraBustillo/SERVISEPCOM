<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\RangoFactura;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RangoFacturaTest extends TestCase
{

    // =======================================================================
    //                  VALIDAR RUTAS Y ACCESOS A LAS RUTAS
    // =======================================================================

    // Validar Ruta de registro de rangos
    public function test_Validacion_ruta_registro_rango_factura()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/createRangoFactura');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de registrar rango
    public function test_AccederRegistrarRango()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('/createRangoFactura');
        $response->assertStatus(200);
        $response->assertSee('Registrar rango factura');
        $response->assertSee('Número CAI');
        $response->assertSee('Fecha Inicio');
        $response->assertSee('Fecha Vencimiento');
        $response->assertSee('Factura Inicial');
        $response->assertSee('Factura Final');
        $response->assertSeeInOrder(['Guardar', 'Limpiar', 'Cerrar']);
    }

    // Validar Ruta de listados de rangos
    public function test_Validacion_ruta_listado_rango_factura()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/listaRangoFactura');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de Listado de rango de factura
    public function test_AccederAlListadoDeRangoDeFacturas()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->actingAs($user)->get('/listaRangoFactura');
        $response->assertStatus(200);
        $response->assertSee('Listado de rangos de facturas'); 
        $response->assertSee('Fecha minima:'); 
        $response->assertSee('Fecha máxima:'); 
        $response->assertSee('Buscar por CAI y factura (Inicial/Final)');
        $response->assertSeeText('uno');
        $response->assertSeeText('dos');
    }


    // =======================================================================
    //                  VALIDAR USUARIO SIN AUTENTICACION
    // =======================================================================
    
    public function test_UsuarioSinAutenticacionEnRegistroDeRangoDeFactura()
    {
        $response = $this->get('/createRangoFactura');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_UsuarioSinAutenticacionEnListaDeRangoDeFactura()
    {
        $response = $this->get('/listaRangoFactura');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    // =======================================================================
    //                 VALIDAR BOTONES DE RANGO DE FACTURA
    // =======================================================================

    public function test_BotonAgregarEnListadoDeRangoDeFacturas(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('/listaRangoFactura');
        $response = $this->followingRedirects()->actingAs($user)->get(route('create.rangofactura'));
        $response->assertStatus(200);
    }

    public function test_BotonVolverEnRegistroDeRangoDeFactura(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('createRangoFactura');
        $response = $this->followingRedirects()->actingAs($user)->get(route('RangoFactura.index'));
        $response->assertStatus(200);
    }

    // =======================================================================
    //                 VALIDAR CAMPOS DE RANGO DE FACTURAS
    // =======================================================================

    // Validar numeros en campo caiRango
    public function test_ValidarNumerosEnCai()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);
        
        $response = $this->post('/createRangoFactura', [
            'caiRango' => '111111-111111-111111-111111-111111-19', 
        ]);

        $response->assertStatus(302);
    }

    // Validar no letras en campo caiRango
    public function test_ValidarNoLetrasEnCai()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'caiRango' => 'Hola Mundo', 
        ]);

        $response->assertSessionHasErrors('caiRango');
        $this->assertContains('El numero CAI solo adminte valores hexadecimales (0-F)', 
            session('errors')->get('caiRango'));
    }

    // Validar numeros con letras en campo caiRango
    public function test_ValidarLetrasConNumerosEnCai()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'caiRango' => 'Mundo3000', 
        ]);

        $response->assertSessionHasErrors('caiRango'); 
        $this->assertContains('El numero CAI solo adminte valores hexadecimales (0-F)', 
        session('errors')->get('caiRango'));    
    }

    // Validar simbolos con letras en campo caiRango 
    public function test_ValidarLetrasConSimbolosEnCai()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'caiRango' => '<mundo>', 
        ]);

        $response->assertSessionHasErrors('caiRango'); 
        $this->assertContains('El numero CAI solo adminte valores hexadecimales (0-F)', 
        session('errors')->get('caiRango'));    
    }

    // Validar minima cantidad de letras en campo caiRango
    public function test_ValidarMinimaCantidadDeCaracteresEnCai()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'caiRango' => '1', 
        ]);

        $response->assertSessionHasErrors('caiRango'); 
        $this->assertContains('El numero CAI solo adminte valores hexadecimales (0-F)', 
        session('errors')->get('caiRango'));    
    }

    // Validar maxima cantidad de letras en campo caiRango
    public function test_ValidarMaximaCantidadDeCaracteresEnCai()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'caiRango' => '99999999999999999999999999999999999999999999999999999999999999', 
        ]);

        $response->assertSessionHasErrors('caiRango'); 
        $this->assertContains('El numero CAI solo adminte valores hexadecimales (0-F)', 
        session('errors')->get('caiRango'));    
    }

    // Validar no simbolos en campo caiRango
    public function test_ValidarNoSimbolosEnCai()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'marca' => '-=/;<>', 
        ]);

        $response->assertSessionHasErrors('caiRango'); 
        $this->assertContains('El numero CAI solo adminte valores hexadecimales (0-F)', 
        session('errors')->get('caiRango'));    
    }

    // Validar campo caiRango no puede estar vacio
    public function test_ValidarNoVacioEnCai()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'caiRango' => '', 
        ]);

        $response->assertSessionHasErrors('caiRango'); 
        $this->assertContains('El CAI es obligatorio', 
        session('errors')->get('caiRango'));
    }

    // Validar campo fechaInicial
    public function test_ValidarFechaInicial()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'fechaInicio' => '24/08/2023', 
        ]);

        $response->assertStatus(302);
    }

    // Validar campo fechaInicial no puede estar vacio
    public function test_ValidarNoVacioEnFechaInicial()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'fechaInicio' => '', 
        ]);

        $response->assertSessionHasErrors('fechaInicio'); 
        $this->assertContains('La fecha de inicio es obligatoria', 
        session('errors')->get('fechaInicio'));
    }

    // Validar campo fechaInicial con fecha inferior
    public function test_ValidarFechaInicialInferior()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'fechaInicio' => '21/08/2022', 
        ]);

        $response->assertSessionHasErrors('fechaInicio'); 
        $this->assertContains('La fecha de inicio debe de ser menor a la fecha de vencimiento', 
        session('errors')->get('fechaInicio'));
    }

    // Validar campo fechaInicial con fecha muy inferior año 0099
    public function test_ValidarFechaInicialMuyInferior()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'fechaInicio' => '21/08/0099', 
        ]);

        $response->assertSessionHasErrors('fechaInicio'); 
    }

    // Validar campo fechaVencimiento
    public function test_ValidarFechaVencimiento()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'fechaInicio' => '25/08/2023', 
        ]);

        $response->assertStatus(302);
    }

    // Validar campo fechaVencimiento no puede estar vacio
    public function test_ValidarNoVacioEnFechaFinal()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'fechaVencimiento' => '', 
        ]);

        $response->assertSessionHasErrors('fechaVencimiento'); 
        $this->assertContains('La fecha final es obligatoria', 
        session('errors')->get('fechaVencimiento'));
    }

    // Validar campo facturaInicial
    public function test_ValidarFacturaInicial()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'facturaInicial' => '000-001-04-00000008', 
        ]);

        $response->assertStatus(302);
    }

    // Validar campo facturaInicial no puede estar vacio
    public function test_ValidarNoVacioEnFacturaInicial()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'facturaInicial' => '', 
        ]);

        $response->assertSessionHasErrors('facturaInicial'); 
        $this->assertContains('La fecha final es obligatoria', 
        session('errors')->get('facturaInicial'));
    }

    // Validar campo facturaInicial no permitir letras
    public function test_ValidarNoLetrasEnFacturaInicial()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post(route('create.rangofactura'), [
        'facturaInicial' => 'HOLA MUNDO',
        ]);

        $response->assertSessionHasErrors('facturaInicial'); 
        $this->assertContains('El formato del campo factura inicial es inválido.', 
        session('errors')->get('facturaInicial'));
    }

    // Validar campo facturaInicial no permitir simbolos
    public function test_ValidarNoSimbolosEnFacturaInicial()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post(route('create.rangofactura'), [
        'facturaInicial' => '{[><]}',
        ]);

        $response->assertSessionHasErrors('facturaInicial'); 
        $this->assertContains('El formato del campo factura inicial es inválido.', 
        session('errors')->get('facturaInicial'));
    }

    // Validar campo facturaInical no permitir numeros con letras
    public function test_ValidarNoNumerosConLetrasEnFacturaInicial()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post(route('create.rangofactura'), [
        'facturaInicial' => '000-999-99-999999CA',
        ]);

        $response->assertSessionHasErrors('facturaInicial'); 
        $this->assertContains('El formato del campo factura inicial es inválido.', 
        session('errors')->get('facturaInicial'));
    }

    // Validar campo facturaInicial con poca cantidad de numeros
    public function test_ValidarMinimoDeNumerosEnFacturaInicial()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post(route('create.rangofactura'), [
        'facturaInicial' => '000-001-04-00',
        ]);

        $response->assertSessionHasErrors('facturaInicial'); 
        $this->assertContains('El formato del campo factura inicial es inválido.', 
        session('errors')->get('facturaInicial'));
    }

    // Validar campo facturaInicial con mucha cantidad de numeros
    public function test_ValidarMaximoDeNumerosEnFacturaInicial()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post(route('create.rangofactura'), [
        'facturaInicial' => '000-001-04-0000001009999999999',
        ]);

        $response->assertSessionHasErrors('facturaInicial'); 
        $this->assertContains('factura inicial no debe contener más de 19 caracteres.', 
        session('errors')->get('facturaInicial'));
    }



    // Validar campo facturaFinal
    public function test_ValidarFacturaFinal()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'facturaFinal' => '000-001-04-00000010', 
        ]);

        $response->assertStatus(302);
    }

    // Validar campo facturaFinal no puede estar vacio
    public function test_ValidarNoVacioEnFacturaFinal()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
            'facturaFinal' => '', 
        ]);

        $response->assertSessionHasErrors('facturaFinal'); 
        $this->assertContains('La factura final es obligatoria', 
        session('errors')->get('facturaFinal'));
    }

    // Validar campo facturaFinal no permitir letras
    public function test_ValidarNoLetrasEnFacturaFinal()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post(route('create.rangofactura'), [
        'facturaFinal' => 'HOLA MUNDO',
        ]);

        $response->assertSessionHasErrors('facturaFinal'); 
        $this->assertContains('El formato del campo factura final es inválido.', 
        session('errors')->get('facturaFinal'));
    }

    // Validar campo facturaFinal no permitir letras
    public function test_ValidarNoSimbolosEnFacturaFinal()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post(route('create.rangofactura'), [
        'facturaFinal' => '{}[]><',
        ]);

        $response->assertSessionHasErrors('facturaFinal'); 
        $this->assertContains('El formato del campo factura final es inválido.', 
        session('errors')->get('facturaFinal'));
    }

    // Validar campo facturaFinal no permitir numeros con letras
    public function test_ValidarNoNumerosConLetrasEnFacturaFinal()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post(route('create.rangofactura'), [
        'facturaFinal' => '999-999-99-999999CA',
        ]);

        $response->assertSessionHasErrors('facturaFinal'); 
        $this->assertContains('El formato del campo factura final es inválido.', 
        session('errors')->get('facturaFinal'));
    }

    // Validar campo facturaFinal con mucha cantidad de numeros
    public function test_ValidarMinimoDeNumerosEnFacturaFinal()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post(route('create.rangofactura'), [
        'facturaFinal' => '000-001-04-00',
        ]);

        $response->assertSessionHasErrors('facturaFinal'); 
        $this->assertContains('El número de factura final debe ser mayor que el número de factura inicial.', 
        session('errors')->get('facturaFinal'));
    }

    // Validar campo facturaFinal con mucha cantidad de numeros
    public function test_ValidarMaximoDeNumerosEnFacturaFinal()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post(route('create.rangofactura'), [
        'facturaFinal' => '000-001-04-0000001009999999999',
        ]);

        $response->assertSessionHasErrors('facturaFinal'); 
        $this->assertContains('factura final no debe contener más de 19 caracteres.', 
        session('errors')->get('facturaFinal'));
    }

    // =======================================================================
    //                 VALIDAR FORMULARIOS VACIOS
    // =======================================================================

    public function test_ValidacionFormularioVacioEnRangoDeFacturas()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/createRangoFactura', [
        'fechaInicio' => '',
        'fechaVencimiento' => '',
        'facturaInicial' => '',
        'facturaFinal' => '',
        'caiRango' => '',
        ]);

        $response->assertSessionHasErrors('fechaInicio');
        $response->assertSessionHasErrors('fechaVencimiento');
        $response->assertSessionHasErrors('facturaInicial');
        $response->assertSessionHasErrors('facturaFinal');
        $response->assertSessionHasErrors('caiRango');
    }


    // =======================================================================
    //                      REGISTRAR Y REDIRECCIONAR
    // =======================================================================

    public function test_RegistrarRangoDeFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $rangoData = [
            "id"=> 7,
            "fechaInicio"=> "2023-09-26",
            "fechaVencimiento"=> "2023-10-26",
            "facturaInicial"=> 3,
            "facturaFinal"=> 20,
            "caiRango"=> "111115-111111-111111-111111-111111-39",
            "facturaActual"=> 1,
            "ocupadas"=> 0,
            "facturaDisponibles"=> 5,
            "estado"=> 0,
        ];

        $response = $this->withoutMiddleware()->post('/createRangoFactura', $rangoData);
          $this->assertDatabaseHas('rango_facturas', $rangoData); // Verifica que el cliente se ha creado en la base de datos
    }

    public function test_RedireccionDespuesDeRegistrarUnRangoDeFactura()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user); // Autentica al usuario para la prueba 
        
        $response = $this->post('/createRangoFactura',
        [  
        "id"=> 2,
            "fechaInicio"=> "2023-08-25",
            "fechaVencimiento"=> "2023-09-26",
            "facturaInicial"=> 2,
            "facturaFinal"=> 10,
            "caiRango"=> "111111-111111-111111-111111-111111-19",
            "facturaActual"=> 2,
            "ocupadas"=> 0,
            "facturaDisponibles"=> 8,
            "estado"=> 1,
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertRedirect('/listaRangoFactura'); // Verifica redirección a la ruta esperada
    }
}
