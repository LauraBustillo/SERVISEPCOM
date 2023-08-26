<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReparacionTest extends TestCase
{

    // =======================================================================
    //                  VALIDAR RUTAS Y ACCESOS A LAS RUTAS
    // =======================================================================

// Validar Ruta de registrar reparacion
    public function test_Validacion_ruta_registrar_reparacion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/reparacion');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de registrar reparacion.
    public function test_acceder_registrar_reparacion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('/reparacion');
        $response->assertStatus(200);
        $response->assertSeeInOrder(['Buscar cliente', 'Nuevo cliente']);
        $response->assertSee('Categorías');
        $response->assertSee('Nombre equipo');
        $response->assertSee('Marca');
        $response->assertSee('Modelo');
        $response->assertSee('Descripción');
        $response->assertSee('Fotos');
        $response->assertSee('Fecha ingreso');
        $response->assertSee('Fecha entrega');
        $response->assertSeeInOrder(['Guardar', 'Volver']);
    }

    // Validar Ruta de listado de reparacion
    public function test_Validacion_ruta_listado_reparacion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/ListadoReparacion');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de Listado de reparacion
    public function test_AccederAlListadoDeReparacion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->actingAs($user)->get('/ListadoReparacion');
        $response->assertStatus(200);
        $response->assertSee('Listado de reparación de equipos'); 
        $response->assertSee('Buscar por nombre de cliente, categoría o estado');
        $response->assertSeeText('uno');
    }

    // Validar Ruta de detalles de reparacion
    public function test_Validacion_ruta_detalles_reparacion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/reparacion/1');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de detalles reparacion.
    public function test_acceder_detalles_reparacion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('/repaciones/2');
        $response->assertStatus(200);
        $response->assertSee('Información de la reparación'); 
        $response->assertSee('Reparación: Carlos Daniel Bucardo Toledo'); 
        $response->assertSeeInOrder(['Editar', 'Volver', 'Imprimir', 'Garantia']);
    }

    // Validar Ruta de editar reparacion
    public function test_Validacion_ruta_editar_reparacion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/repaciones/1');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de editar reparacion.
    public function test_acceder_editar_reparacion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('/reparacion/2');
        $response->assertStatus(200);
        $response->assertSee('Categorías');
        $response->assertSee('Nombre equipo');
        $response->assertSee('Marca');
        $response->assertSee('Modelo');
        $response->assertSee('Descripción');
        $response->assertSee('Fotos');
        $response->assertSee('Fecha ingreso');
        $response->assertSee('Fecha entrega');
        $response->assertSeeInOrder(['Actualizar', 'Volver']);
    }

    // =======================================================================
    //                  VALIDAR USUARIO SIN AUTENTICACION
    // =======================================================================

    public function test_UsuarioSinAutenticacionEnReparacion()
    {
        $response = $this->get('/reparacion');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_UsuarioSinAutenticacionEnListadoDeReparacion()
    {
        $response = $this->get('/ListadoReparacion');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_UsuarioSinAutenticacionEnDetallesDeReparacion()
    {
        $response = $this->get('/repaciones/1');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_UsuarioSinAutenticacionEnEditarReparacion()
    {
        $response = $this->get('/reparacion/2');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    // =======================================================================
    //                 VALIDAR BOTONES DE REPARACIONES
    // =======================================================================

    public function test_BotonAgregarEnListadoDeReparaciones(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('/ListadoReparacion');
        $response = $this->followingRedirects()->actingAs($user)->get(route('show.registroReparacion'));
        $response->assertStatus(200);
    }

    public function test_BotonVolverEnRegistroDeReparaciones(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('/reparacion');
        $response = $this->followingRedirects()->actingAs($user)->get(route('reparacion.index'));
        $response->assertStatus(200);
    }

    public function test_BotonBuscarClienteEnReparacion(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('reparacion');
        $response = $this->followingRedirects()->actingAs($user)->get(route('show.registroReparacion'));
        $response->assertStatus(200);
    }

    public function test_BotonNuevoClienteEnReparacion(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('reparacion');
        $response = $this->followingRedirects()->actingAs($user)->get(route('show.registroReparacion'));
        $response->assertStatus(200);
    }

    public function test_BotonDetallesEnListadoDeReparaciones(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('/ListadoReparacion');
        $response = $this->followingRedirects()->actingAs($user)->get('repaciones/2');
        $response->assertStatus(200);
    }

    public function test_BotonVolverEnDetalleDeReparaciones(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('repaciones/2');
        $response = $this->followingRedirects()->actingAs($user)->get(route('reparacion.index'));
        $response->assertStatus(200);
    }

    public function test_BotonEditarEnDetallesDeReparacion(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('repaciones/2');
        $response = $this->followingRedirects()->get("/reparacion/2");
        $response->assertStatus(200);
    }

    public function test_BotonVolverEnEditarReparacion(){
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->actingAs($user)->get('reparacion/2');
        $response = $this->followingRedirects()->actingAs($user)->get(route('reparacion.index'));
        $response->assertStatus(200);
    }

    // =======================================================================
    //                 VALIDAR CAMPOS DE REPARACIONES
    // =======================================================================

    // Validar campo nombre_equipo solo letras
    public function test_ValidarLetrasEnNombreDeEquipo(){
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'nombre_equipo' => 'abc', 
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
    }

    // Validar campo nombre_equipo no puede estar vacio
    public function test_ValidarNoVacioEnNombreDeEquipo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'nombre_equipo' => '', 
        ]);

        $response->assertSessionHasErrors('nombre_equipo'); 
        $this->assertContains('El nombre del equipo es requerido', 
        session('errors')->get('nombre_equipo'));
    }

    // Validar no numeros en campo nombre_equipo 
    public function test_ValidarNoNumerosEnNombreDeEquipo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'nombre_equipo' => '12345', 
        ]);

        $response->assertSessionHasErrors('nombre_equipo'); 
        $this->assertContains('El nombre del equipo solo debe tener letras', 
        session('errors')->get('nombre_equipo'));
    }

    // Validar numeros con letras en campo nombre_equipo 
    public function test_ValidarNoLetrasConNumerosEnNombreDeEquipo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'nombre_equipo' => 'Laptop3000', 
        ]);

        $response->assertSessionHasErrors('nombre_equipo'); 
        $this->assertContains('El nombre del equipo solo debe tener letras', 
        session('errors')->get('nombre_equipo'));
    }

    // Validar simbolos con letras en campo nombre_equipo 
    public function test_ValidarNoLetrasConSimbolosEnNombreDeEquipo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'nombre_equipo' => '<Laptop>', 
        ]);

        $response->assertSessionHasErrors('nombre_equipo'); 
        $this->assertContains('El nombre del equipo solo debe tener letras', 
        session('errors')->get('nombre_equipo'));
    }

    // Validar minima cantidad de letras en campo nombre_equipo
    public function test_ValidarMinimaCantidadDeLetrasEnNombreDeEquipo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'nombre_equipo' => '12', 
        ]);

        $response->assertSessionHasErrors('nombre_equipo'); 
        $this->assertContains('El nombre del equipo debe tener mínimo 4 letras', 
        session('errors')->get('nombre_equipo'));    
    }

    // Validar maxima cantidad de letras en campo nombre_equipo
    public function test_ValidarMaximaCantidadDeLetrasEnNombreDeEquipo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'nombre_equipo' => 'LAPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP', 
        ]);

        $response->assertSessionHasErrors('nombre_equipo'); 
        $this->assertContains('El nombre del equipo  no debe de tener más de 25 letras', 
        session('errors')->get('nombre_equipo'));    
    }

    // Validar no simbolos en campo nombre_equipo
    public function test_ValidarNoSimbolosEnNombreDeEquipo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'nombre_equipo' => '-=-=-=-', 
        ]);

        $response->assertSessionHasErrors('nombre_equipo'); 
        $this->assertContains('El nombre del equipo solo debe tener letras', 
        session('errors')->get('nombre_equipo'));    
    }

    // Validar solo mayusculas en campo nombre_equipo
    public function test_ValidarSoloMayusculasEnNombreDeEquipo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'nombre_equipo' => 'LAPTOP', 
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
    }

    // Validar seleccion en campo categoria
    public function test_ValidarSeleccionEnCategoria()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'categoria' => '', 
        ]);

        $response->assertSessionHasErrors('categoria'); 
        $this->assertContains('La categoría es requerida', 
        session('errors')->get('categoria'));    
    }

    // Validar no numeros en campo categoria
    public function test_ValidarNoNumerosEnCategoria()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'categoria' => '123', 
        ]);

        $response->assertSessionHasErrors('categoria');   
    }

    // Validar no simbolos en campo categoria
    public function test_ValidarNoSimbolosEnCategoria()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'categoria' => '-/],>', 
        ]);

        $response->assertSessionHasErrors('categoria');   
    }

    // Validar campo marca no puede estar vacio
    public function test_ValidarNoVacioEnMarca()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'marca' => '', 
        ]);

        $response->assertSessionHasErrors('marca'); 
        $this->assertContains('La marca es requerida', 
        session('errors')->get('marca'));
    }

    // Validar letras en campo marca
    public function test_ValidarLetrasEnMarca()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'marca' => 'Dell', 
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
    }

    // Validar numeros con letras en campo marca
    public function test_ValidarLetrasConNumerosEnMarca()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'marca' => 'Dell3000', 
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
    }

    // Validar simbolos con letras en campo marca 
    public function test_ValidarLetrasConSimbolosEnMarca()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'marca' => '<Laptop>', 
        ]);

        $response->assertSessionHasErrors('marca'); 
        $this->assertContains('La marca solo puede tener letras y números', 
        session('errors')->get('marca'));    
    }

    // Validar minima cantidad de letras en campo marca
    public function test_ValidarMinimaCantidadDeCaracteresEnMarca()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'marca' => 'a', 
        ]);

        $response->assertSessionHasErrors('marca'); 
        $this->assertContains('La marca debe tener como mínimo 2 letras', 
        session('errors')->get('marca'));    
    }

    // Validar maxima cantidad de letras en campo marca
    public function test_ValidarMaximaCantidadDeCaracteresEnMarca()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'marca' => 'DELLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL', 
        ]);

        $response->assertSessionHasErrors('marca'); 
        $this->assertContains('La marca no debe de tener más de 25 letras', 
        session('errors')->get('marca'));    
    }

    // Validar solo mayusculas en campo marca
    public function test_ValidarSoloMayusculasEnMarca()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'marca' => 'DELL', 
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
    }

    // Validar no simbolos en campo marca
    public function test_ValidarNoSimbolosEnMarca()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'marca' => 'Dell.', 
        ]);

        $response->assertSessionHasErrors('marca'); 
        $this->assertContains('La marca solo puede tener letras y números', 
        session('errors')->get('marca'));    
    }

    // Validar campo modelo no puede estar vacio
    public function test_ValidarNoVacioEnModelo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'modelo' => '', 
        ]);

        $response->assertSessionHasErrors('modelo'); 
        $this->assertContains('El modelo es requerido', 
        session('errors')->get('modelo'));
    }

    // Validar letras en campo modelo
    public function test_ValidarLetrasEnModelo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'modelo' => 'Latitude', 
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
    }

    // Validar numeros con letras en campo modelo
    public function test_ValidarLetrasConNumerosEnModelo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'modelo' => 'Latitude 6440', 
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
    }

    // Validar no simbolos con letras en campo modelo
    public function test_ValidarNoLetrasConSimbolosEnModelo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'modelo' => '<Latitude>', 
        ]);

        $response->assertSessionHasErrors('modelo'); 
        $this->assertContains('El modelo solo puede tener letras y números', 
        session('errors')->get('modelo'));    
    }

    // Validar minima cantidad de letras en campo modelo
    public function test_ValidarMinimaCantidadDeCaracteresEnModelo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'modelo' => 'a', 
        ]);

        $response->assertSessionHasErrors('modelo'); 
        $this->assertContains('modelo debe contener al menos 4 caracteres.', 
        session('errors')->get('modelo'));    
    }

    // Validar maxima cantidad de letras en campo modelo
    public function test_ValidarMaximaCantidadDeCaracteresEnModelo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'modelo' => 'Latitudeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 
        ]);

        $response->assertSessionHasErrors('modelo'); 
        $this->assertContains('modelo no debe contener más de 20 caracteres.', 
        session('errors')->get('modelo'));    
    }

    // Validar no simbolos en campo modelo
    public function test_ValidarNoSimbolosEnModelo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'modelo' => '.[', 
        ]);

        $response->assertSessionHasErrors('modelo'); 
        $this->assertContains('El modelo solo puede tener letras y números', 
        session('errors')->get('modelo'));  
    }

    // Validar solo mayusculas en campo modelo
    public function test_ValidarSoloMayusculasEnModelo()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'modelo' => 'RQXG', 
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
    }
    
    // Validar campo descripcion no puede estar vacio
    public function test_ValidarNoVacioEnDescripcion()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'descripcionr' => '', 
        ]);

        $response->assertSessionHasErrors('descripcionr'); 
        $this->assertContains('La descripción es requerido', 
        session('errors')->get('descripcionr'));
    }

    // Validar cantidad minima de letras en campo descripcionr
    public function test_ValidarCantidadMinimaDeCaracteresEnDescripcion()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'descripcionr' => '1', 
        ]);

        $response->assertSessionHasErrors('descripcionr'); 
        $this->assertContains('La descripción debe tener como mínimo 4 letras', 
        session('errors')->get('descripcionr'));    
    }

    // Validar cantidad maxima de letras en campo descripcionr
    public function test_ValidarCantidadMaximaDeCaracteresEnDescripcion()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'descripcionr' => 
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 
        ]);

        $response->assertSessionHasErrors('descripcionr'); 
        $this->assertContains('La descripción debede tener más de 15 letras', 
        session('errors')->get('descripcionr'));    
    }

    // Validar solo mayusculas en campo descripcionr
    public function test_ValidarSoloMayusculasEnDescripcion()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'descripcionr' => 'ES UNA BUENA COMPUTADORA', 
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
    }

    // Validar campo foto no puede estar vacio
    public function test_ValidarNoVacioEnFoto()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'foto' => '', 
        ]);

        $response->assertSessionHasErrors('foto'); 
        $this->assertContains('La foto es requerida', 
        session('errors')->get('foto'));
    }

    // Validar campo cliente_id no puede estar vacio
    public function test_ValidarNoVacioEnClienteId()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'cliente_id' => '', 
        ]);

        $response->assertSessionHasErrors('cliente_id'); 
        $this->assertContains('Debe agregar un cliente', 
        session('errors')->get('cliente_id'));
    }

    // =======================================================================
    //                      VALIDAR FORMULARIO VACIO
    // =======================================================================

    // Formulario vacio en reparacion
    public function test_ValidacionFormularioVacioEnReparacion()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->post('/reparacion', [
            'cliente_id' => '',
            'categoria' => '',
            'nombre_equipo' => '',
            'marca' => '',
            'modelo' => '',
            'descripcionr' => '',
            'foto' => '',
        ]);

        $response->assertSessionHasErrors('cliente_id');
        $response->assertSessionHasErrors('categoria');
        $response->assertSessionHasErrors('nombre_equipo');
        $response->assertSessionHasErrors('marca');
        $response->assertSessionHasErrors('modelo');
        $response->assertSessionHasErrors('descripcionr');
        $response->assertSessionHasErrors('foto');
    }

    // =======================================================================
    //                      REGISTRAR Y REDIRECCIONAR
    // =======================================================================

    public function test_RegistrarReparacion()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $reparacionData = [
            'cliente_id' => '3',
            'categoria' => 'Computadoras',
            'nombre_equipo' => 'Laptop',
            'marca' => 'Dell',
            'modelo' => 'latitude 6440',
            'descripcionr' => 'prueba de formulario',
            'foto' => 'foto.png',
        ];

        $response = $this->withoutMiddleware()->post('/reparacion', $reparacionData);
        $this->assertDatabaseHas('reparacions', $reparacionData);
    }

    // Redirecciona despues de guardar una reparacion
    public function test_RedireccionDespuesDeRegistrarUnaReparacion()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user); // Autentica al usuario para la prueba 
        
        $response = $this->post('/reparacion',
        [  
            'cliente_id' => '3',
            'estado' => 'Pendiente',
            'fecha_factura' => '',
            'precio' => '5000.00',
            'descripcion' => 'es buena pc para oficina',
            'categoria' => 'Computadoras',
            'nombre_equipo' => 'Laptop',
            'marca' => 'Dell',
            'modelo' => 'latitude 6440',
            'descripcionr' => 'prueba de formulario',
            'foto' => 'foto.png',
            'cambio_pieza' => '',
            'categoria_producto_inv' => '',
            'marca_producto_inv' => '',
            'nombre_producto_inv' => '',
            'id_producto_inv' => '',
            'garantia' => 'No',
            'fecha_ingreso' => '2023-08-17',
            'fecha_entrega' => '',
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertRedirect('/ListadoReparacion'); // Verifica redirección a la ruta esperada
    }
}