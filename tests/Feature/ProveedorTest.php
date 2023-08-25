<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Auth;

class ProveedorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    //Acceso a rutas 
    //Acceder a la ruta de registro de proveedor GET
    public function test_ruta_registro_proveedor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registro proveedor
        $response = $this->actingAs($user)->get('/registroproveedores');
        $response->assertStatus(200);   
    }

    //Acceder a la ruta de Listado de proveedor GET
    public function test_ruta_listado_proveedor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado proveedor
        $response = $this->actingAs($user)->get('/Proveedor');
        $response->assertStatus(200);
    }

     //Acceder a la ruta de Detalle del proveedor GET
     public function test_ruta_detalle_proveedor()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         //realiza una solicitud GET a la ruta de listado proveedor
         $response = $this->actingAs($user)->get('/Proveedores/1');
         $response->assertStatus(200);
     }

     //Acceder a la ruta de editar del cliente GET
     public function test_ruta_editar_proveedor()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         //realiza una solicitud GET a la ruta de editar proveedor
         $response = $this->actingAs($user)->get('/proveedor/1/editar');
         $response->assertStatus(200);
     }


    //Verificar que se muestre el contenido
    public function test_registro_proveedor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registro proveedor
        $response = $this->actingAs($user)->get('/registroproveedores');
        $response->assertStatus(200);
        $response->assertSee('Registrar proveedor');  // Verificar que la vista contiene el título "Registrar proveedor"
        $response->assertSee('Nombre de la empresa');
        $response->assertSee('Correo de la empresa');
        $response->assertSee('Teléfono de la empresa');
        $response->assertSee('Dirección');
        $response->assertSee('Nombre del encargado');
        $response->assertSee('Apellido del encargado');
        $response->assertSee('Teléfono del encargado');
        $response->assertSeeInOrder(['Guardar', 'Limpiar', 'Cerrar']);  // Verifica que los botones aparezcan en orden específico en la respuesta HTML     
    }

    //Acceder a la ruta de Listado de proveedor GET
    public function test_listado_proveedor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado proveedor
        $response = $this->actingAs($user)->get('/Proveedor');
        $response->assertStatus(200);
        $response->assertSee('Listado de proveedores');  // Verificar que la vista contiene el título "Listado de proveedors"
        $response->assertSee('Buscar por nombre, apellidos o identidad');
        $response->assertSee('Nombre de la empresa');
        $response->assertSee('Teléfono de la empresa');
        $response->assertSee('Nombre del encargado');
        $response->assertSee('Detalles');
        $response->assertSee('Editar');
        $response->assertSeeText('uno'); //icono de agregar un nuevo proveedor en el listado
    }

    //Acceder a la ruta de Detalle del proveedor GET
    public function test_detalle_empleados()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado empleado
        $response = $this->actingAs($user)->get('/Proveedores/1');
        $response->assertStatus(200);
        $response->assertSee('Información del proveedor');  // Verificar que la vista contiene el título "Infromación del empleado"
        $response->assertSeeInOrder(['Nombre de la empresa', 
        'Dirección exacta', 
        'Correo electrónico',
        'Teléfono de la empresa',
        'Nombres del encargado',
        'Apellidos del encargado',
        'Teléfono del encargado',
        'Editar',
        'Volver' ]);
    }

    //Acceder a la ruta de editar del proveedor GET
    public function test_editar_proveedor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
 
        //realiza una solicitud GET a la ruta de editar proveedor
        $response = $this->actingAs($user)->get('/proveedor/1/editar');
        $response->assertStatus(200);
        $response->assertSee('Editar proveedor');  // Verificar que la vista contiene el título "Editar empleado"
        $response->assertSee('Nombre de la empresa');
        $response->assertSee('Correo de la empresa');
        $response->assertSee('Teléfono de la empresa');
        $response->assertSee('Dirección');
        $response->assertSee('Nombres del encargado');
        $response->assertSee('Apellidos del encargado');
        $response->assertSee('Teléfono del encargado');
        $response->assertSeeInOrder(['Actualizar', 'Restaurar', 'Cancelar']);  // Verifica que los botones aparezcan en orden específico en la respuesta HTML  
    }


    //Acceso restringido
    public function test_usuario_sin_autenticacion_redirigido_registro_proveedor()
    {
        $response = $this->get('/registroproveedores');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_usuario_sin_autenticacion_redirigido_listado_proveedor()
    {
        $response = $this->get('/Proveedor');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_usuario_sin_autenticacion_redirigido_detalle_proveedor()
    {
        $response = $this->get('/Proveedores/1');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_usuario_sin_autenticacion_redirigido_editar_empleado()
    {
        $response = $this->get('/proveedor/1/editar');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }


     //Acceder a los botones de agregar en listado y editar en detalles
    public function test_boton_agregar_en_Listado_Proveedor(){
        $user = User::findOrFail(1);
        Auth::login($user);

        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/Proveedor');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get(route('show.registroProveedor'));

        // Verifica que se redirige correctamente a la ruta
        $response->assertStatus(200);
        $response->assertSee('Registrar proveedor'); //Muestra titulo de la ventana de registro proveedor.
    }

    public function test_boton_editar_en_detalles_proveedor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de detalle empleado
        $response = $this->actingAs($user)->get('/Proveedores/1');
        $response->assertStatus(200);;
    
         // Hacer clic en el botón de editar y seguir la redirección
        $response = $this->followingRedirects()->get("/proveedor/1/editar");
    
        // Verifica que se redirige correctamente a la ruta de edición del cliente
        $response->assertStatus(200);

        $response->assertSee('Editar proveedor');

        // Obtiene el contenido HTML de la respuesta
        $content = $response->getContent();

        // Verifica que el valor "Unah" esté presente en el campo Nombre_empresa
        $this->assertStringContainsString('Unah', $content);
    }

    public function test_boton_volver_en_detalle_proveedor(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de detalle
        $response = $this->actingAs($user)->get('/Proveedores/1');
        $response->assertStatus(200);
    
         // Hacer clic en el botón de atrás y seguir la redirección
        $response = $this->followingRedirects()->get("/Proveedor");
    
        // Verifica que se redirige correctamente a la ruta listado proveedor
        $response->assertStatus(200);

        $response->assertSee('Listado de proveedores');

        // Obtiene el contenido HTML de la respuesta
        $content = $response->getContent();

        // Verifica que el valor "Unah" esté presente en el campo Nombres
        $this->assertStringContainsString('Unah', $content);
    }

    public function test_boton_cancelar_en_editar_proveedor(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de editar proveedor
        $response = $this->actingAs($user)->get('/proveedor/1/editar');
        $response->assertStatus(200);
    
        //Hacer clic en el botón de cancelar y seguir la redirección
        $response = $this->followingRedirects()->get("/Proveedor");
    
        //Verifica que se redirige correctamente a la ruta de listado
        $response->assertStatus(200);

        $response->assertSee('Listado de proveedores');

        //Obtiene el contenido HTML de la respuesta
        $content = $response->getContent();

        //Verifica que el valor "Unah" esté presente en el campo Nombres
        $this->assertStringContainsString('Unah', $content);
    }


     //Agregar Nuevo registro a la tabla proveedor
     public function test_agregar_nuevo_proveedor()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user); // Autentica al usuario para la prueba

        $proveedorData = [
            'Nombre_empresa' => 'Thurman',
            'Direccion' => 'La Sevilla',
            'Correo' => 'thuman@gmail.com',
            'Telefono_empresa' => '33334267',
            'Nombre_encargado' => 'Melvin',
            'Apellido_encargado' => 'Sanchez',
            'Telefono_encargado' => '98767876',
        ];

        $response = $this->withoutMiddleware()->post('/registroproveedores', $proveedorData);
        $this->assertDatabaseHas('proveedors', $proveedorData); // Verifica que el cliente se ha creado en la base de datos
    }

    public function test_redireccion_despues_de_agregar_proveedor()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user); // Autentica al usuario para la prueba 
        
        $response = $this->post('/registroproveedores', 
            ['Nombre_empresa' => 'Many',
            'Direccion' => 'La Conce',
            'Correo' => 'manttel@gmail.com',
            'Telefono_empresa' => '23677876',
            'Nombre_encargado' => 'Cesar Julio',
            'Apellido_encargado' => 'Ramirez',
            'Telefono_encargado' => '33717145',]);

        $response->assertStatus(302); // Verifica redirección después de agregar
        //$response->assertRedirect('/Proveedor'); // Verifica redirección a la ruta esperada REVISAR
    }

    
    //Validaciones campos
    public function test_validacion_formulario_proveedor_vacio()
    {
        // Crea un usuario 
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Nombre_empresa' => '',
            'Direccion' => '',
            'Correo' => '',
            'Telefono_empresa' => '',
            'Nombre_encargado' => '',
            'Apellido_encargado' => '',
            'Telefono_encargado' => '',
        ]);

        $response->assertSessionHasErrors('Nombre_empresa'); // Verifica que se muestre un error de validación para el campo Nombre
        $response->assertSessionHasErrors('Direccion');
        $response->assertSessionHasErrors('Correo');
        $response->assertSessionHasErrors('Telefono_empresa');
        $response->assertSessionHasErrors('Nombre_encargado');
        $response->assertSessionHasErrors('Apellido_encargado');
        $response->assertSessionHasErrors('Telefono_encargado');

    }

    public function test_nombre_empresa_vacio_no_enviar_formulario()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre_empresa' => '',// Campo vacío
            'Direccion' => 'Barrio abajo',
            'Correo' => 'mlovode@gmail.com',
            'Telefono_empresa' => '32345678',
            'Nombre_encargado' => 'Celeste',
            'Apellido_encargado' => 'Garcia',
            'Telefono_encargado' => '876765456', 
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroproveedores', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('proveedors', $datos);
    }

    public function test_direccion_vacio_no_enviar_formulario()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre_empresa' => 'Umbrella',
            'Direccion' => '',// Campo vacío
            'Correo' => 'mlovode@gmail.com',
            'Telefono_empresa' => '32345678',
            'Nombre_encargado' => 'Celeste',
            'Apellido_encargado' => 'Garcia',
            'Telefono_encargado' => '876765456', 
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroproveedores', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('proveedors', $datos);
    }

    public function test_correo_vacio_no_enviar_formulario()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre_empresa' => 'Umbrella',
            'Direccion' => 'Res lomas',
            'Correo' => '',// Campo vacío
            'Telefono_empresa' => '32345678',
            'Nombre_encargado' => 'Celeste',
            'Apellido_encargado' => 'Garcia',
            'Telefono_encargado' => '876765456', 
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroproveedores', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('proveedors', $datos);
    }

    public function test_telefono_empresa_vacio_no_enviar_formulario()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre_empresa' => 'Umbrella',
            'Direccion' => 'Res lomas',
            'Correo' => 'mmerl@gmail.com',
            'Telefono_empresa' => '',// Campo vacío
            'Nombre_encargado' => 'Celeste',
            'Apellido_encargado' => 'Garcia',
            'Telefono_encargado' => '876765456', 
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroproveedores', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('proveedors', $datos);
    }

    public function test_nombre_encargado_vacio_no_enviar_formulario()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre_empresa' => 'Umbrella',
            'Direccion' => 'Res lomas',
            'Correo' => 'mmerl@gmail.com',
            'Telefono_empresa' => '23453454',
            'Nombre_encargado' => '',// Campo vacío
            'Apellido_encargado' => 'Garcia',
            'Telefono_encargado' => '876765456', 
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroproveedores', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('proveedors', $datos);
    }

    public function test_apellido_encargado_vacio_no_enviar_formulario()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre_empresa' => 'Umbrella',
            'Direccion' => 'Res lomas',
            'Correo' => 'mmerl@gmail.com',
            'Telefono_empresa' => '23453454',
            'Nombre_encargado' => 'Marisela',
            'Apellido_encargado' => '',// Campo vacío
            'Telefono_encargado' => '876765456', 
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroproveedores', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('proveedors', $datos);
    }

    public function test_telefono_encargado_vacio_no_enviar_formulario()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre_empresa' => 'Umbrella',
            'Direccion' => 'Res lomas',
            'Correo' => 'mmerl@gmail.com',
            'Telefono_empresa' => '23453454',
            'Nombre_encargado' => 'Marisela',
            'Apellido_encargado' => '33321589',
            'Telefono_encargado' => '', // Campo vacío
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroproveedores', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('proveedors', $datos);
    }

    public function test_agregar_proveedor_sin_duplicar_correo()
    {
        // Crea un usuario
        $user = User::factory()->create();
        $this->actingAs($user);
    
        // Crea un proveedor existente con un correo
        Proveedor::factory()->create([
            'Correo' => 'mlovo@unah.com',
        ]);
    
        // Datos del proveedor a agregar
        $nuevoproveedor = [
            'Nombre_empresa' => 'Many',
            'Direccion' => 'La Conce',
            'Correo' => 'mlovo@unah.com',
            'Telefono_empresa' => '83677876',
            'Nombre_encargado' => 'Cesar Julio',
            'Apellido_encargado' => 'ramirez',
            'Telefono_encargado' => '93765478',
        ];

        //Intenta agregar el proveedor con el mismo correo
        $response = $this->post('/registroproveedores', $nuevoproveedor);

        // Verifica que el cliente no se agregó debido a la duplicación de correo
        $response->assertSessionHasErrors('Correo');
    }


    //PRUEBAS DE DATOS VALIDOS Y UNO INVALIDO
    public function test_nombre_empresa_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $proveedorData = [
            'Nombre_empresa' => '88*76Unah', // nombre de empresa inválido
            'Direccion' => 'Barrio guamilito',
            'Correo' => 'celestelovo@gmail.com', 
            'Telefono_empresa' => '33677876',
            'Nombre_encargado' => 'Cesar Julio',
            'Apellido_encargado' => 'Ramirez',
            'Telefono_encargado' => '23767878',
        ];

        $response = $this->post('/registroproveedores', $proveedorData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Nombre_empresa']); // Verifica que haya errores de validación en el campo Nombre_empresa
        $this->assertDatabaseMissing('proveedors', ['Nombre_empresa' => '88*76Unah']); // Verifica que el Nombre_empresa no se haya guardado en la base de datos
    }

    public function test_direccion_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $proveedorData = [
            'Nombre_empresa' => 'Caramelo', 
            'Direccion' => 'B',// direccion inválido
            'Correo' => 'celestelovo@gmail.com', 
            'Telefono_empresa' => '33677876',
            'Nombre_encargado' => 'Cesar Julio',
            'Apellido_encargado' => 'Ramirez',
            'Telefono_encargado' => '23767878',
        ];

        $response = $this->post('/registroproveedores', $proveedorData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Direccion']); // Verifica que haya errores de validación en el campo Direccion
        $this->assertDatabaseMissing('proveedors', ['Direccion' => 'B']); // Verifica que el Direccion no se haya guardado en la base de datos
    }

    public function test_correo_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $proveedorData = [
            'Nombre_empresa' => 'Empresa Nueva York',
            'Direccion' => 'Barrio guamilito',
            'Correo' => 'celestel', // Correo inválido
            'Telefono_empresa' => '33677876',
            'Nombre_encargado' => 'Cesar Julio',
            'Apellido_encargado' => 'Ramirez',
            'Telefono_encargado' => '23767878',
        ];

        $response = $this->post('/registroproveedores', $proveedorData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Correo']); // Verifica que haya errores de validación en el campo Correo
        $this->assertDatabaseMissing('proveedors', ['Correo' => 'celestel']); // Verifica que el correo no se haya guardado en la base de datos
    }

    public function test_telefono_empresa_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $proveedorData = [
            'Nombre_empresa' => 'Caramelo', 
            'Direccion' => 'Barrio guaymuras',
            'Correo' => 'celestelovo@gmail.com', 
            'Telefono_empresa' => 'Tu677876',
            'Nombre_encargado' => 'Cesar Julio',
            'Apellido_encargado' => 'Ramirez',
            'Telefono_encargado' => '23767878',
        ];

        $response = $this->post('/registroproveedores', $proveedorData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Telefono_empresa']); // Verifica que haya errores de validación en el campo Telefono_empresa
        $this->assertDatabaseMissing('proveedors', ['Telefono_empresa' => 'Tu677876']); // Verifica que el Telefono_empresa no se haya guardado en la base de datos
    }

    public function test_nombre_encargado_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $proveedorData = [
            'Nombre_empresa' => 'Caramelo', 
            'Direccion' => 'Barrio guaymuras',
            'Correo' => 'celestelovo@gmail.com', 
            'Telefono_empresa' => '87677876',
            'Nombre_encargado' => 'Cesar<3',
            'Apellido_encargado' => 'Ramirez',
            'Telefono_encargado' => '23767878',
        ];

        $response = $this->post('/registroproveedores', $proveedorData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Nombre_encargado']); // Verifica que haya errores de validación en el campo Nombre_encargado
        $this->assertDatabaseMissing('proveedors', ['Nombre_encargado' => 'Cesar<3']); // Verifica que el Nombre_encargado no se haya guardado en la base de datos
    }

    public function test_apellido_encargado_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $proveedorData = [
            'Nombre_empresa' => 'Caramelo', 
            'Direccion' => 'Barrio guaymuras',
            'Correo' => 'celestelovo@gmail.com', 
            'Telefono_empresa' => '87677876',
            'Nombre_encargado' => 'Cesar',
            'Apellido_encargado' => 'Ramos:*',
            'Telefono_encargado' => '23767878',
        ];

        $response = $this->post('/registroproveedores', $proveedorData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Apellido_encargado']); // Verifica que haya errores de validación en el campo Apellido_encargado
        $this->assertDatabaseMissing('proveedors', ['Apellido_encargado' => 'Cesar<3']); // Verifica que el Apellido_encargado no se haya guardado en la base de datos
    }

    public function test_telefono_encargado_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $proveedorData = [
            'Nombre_empresa' => 'Caramelo', 
            'Direccion' => 'Barrio guaymuras',
            'Correo' => 'celestelovo@gmail.com', 
            'Telefono_empresa' => '87677876',
            'Nombre_encargado' => 'Cesar',
            'Apellido_encargado' => 'Ramos:*',
            'Telefono_encargado' => '%-767878',
        ];

        $response = $this->post('/registroproveedores', $proveedorData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Telefono_encargado']); // Verifica que haya errores de validación en el campo Telefono_encargado
        $this->assertDatabaseMissing('proveedors', ['Telefono_encargado' => '%-767878']); // Verifica que el Telefono_encargado no se haya guardado en la base de datos
    }
    

    public function test_agregar_proveedor_sin_duplicar_telefono_empresa()
    {
        // Crea un usuario y autentícalo
        $user = User::factory()->create();
        $this->actingAs($user);
    
        // Crea un proveedor existente con un telefono
        Proveedor::factory()->create([
            'Telefono_empresa' => '33814235',
        ]);
    
        // Datos del proveedor a agregar
        $nuevoproveedor = [
            'Nombre_empresa' => 'Many',
            'Direccion' => 'La Conce',
            'Correo' => 'mlovo11@unah.com',
            'Telefono_empresa' => '33814235',
            'Nombre_encargado' => 'Cesar Julio',
            'Apellido_encargado' => 'ramirez',
            'Telefono_encargado' => '98865478',
        ];

        //Intenta agregar el proveedor con el mismo telefono
        $response = $this->post('/registroproveedores', $nuevoproveedor);

        // Verifica que el cliente no se agregó debido a la duplicación de telefono
        $response->assertSessionHasErrors('Telefono_empresa');
    }

    public function test_agregar_proveedor_sin_duplicar_telefono_encargado()
    {
        // Crea un usuario 
        $user = User::factory()->create();
        $this->actingAs($user);
    
        // Crea un proveedor existente con un telefono
        Proveedor::factory()->create([
            'Telefono_encargado' => '88418022',
        ]);
    
        // Datos del proveedor a agregar
        $nuevoproveedor = [
            'Nombre_empresa' => 'Many',
            'Direccion' => 'La Conce',
            'Correo' => 'mlovo11I@unah.com',
            'Telefono_empresa' => '33814236',
            'Nombre_encargado' => 'Cesar Julio',
            'Apellido_encargado' => 'ramirez',
            'Telefono_encargado' => '88418022',
        ];

        //Intenta agregar el proveedor con el mismo telefono
        $response = $this->post('/registroproveedores', $nuevoproveedor);

        // Verifica que el cliente no se agregó debido a la duplicación de telefono
        $response->assertSessionHasErrors('Telefono_encargado');
    }

    public function test_validacion_no_numeros_en_nombre_empresa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Nombre_empresa' => 'UNAH123', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Nombre_empresa'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El nombre de la empresa solo puede tener letras', session('errors')->get('Nombre_empresa')); //Verifica el mensaje de error
    }

    public function test_validacion_no_signos_en_nombre_empresa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Nombre_empresa' => '$*my', // Nombre_empresa con simbolos
        ]);

        $response->assertSessionHasErrors('Nombre_empresa'); // Verifica que se muestre un error de validación para el campo Nombre_empresa
        $this->assertContains('El nombre de la empresa solo puede tener letras', session('errors')->get('Nombre_empresa')); //Verifica el mensaje de error
    }

    public function test_validacion_min_en_nombre_empresa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Nombre_empresa' => 'An', // Nombre_empresa con min
        ]);

        $response->assertSessionHasErrors('Nombre_empresa'); // Verifica que se muestre un error de validación para el campo Nombre_empresa
        $this->assertContains('El nombre de la empresa debe tener minimo 3 letras', session('errors')->get('Nombre_empresa')); //Verifica el mensaje de error
    }

    public function test_validacion_max_en_nombre_empresa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Nombre_empresa' => 'Annnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn
            nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', // Nombre_empresa con simbolos
        ]);

        $response->assertSessionHasErrors('Nombre_empresa'); // Verifica que se muestre un error de validación para el campo Nombre_empresa
        $this->assertContains('El nombre de la empresa no debe de tener más de 25 letras', session('errors')->get('Nombre_empresa')); //Verifica el mensaje de error
    }

    public function test_validacion_min_direccion_proveedor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $proveedor = Proveedor::factory()->create();

        $response = $this->post('/registroproveedores', [
        'Direccion' => 'a', 
        ]);
    
        $response->assertSessionHasErrors('Direccion'); // Verifica que se muestre un error de validación para el campo Direccion
        $this->assertContains('La dirección debe tener minimo 10 caracteres', session('errors')->get('Direccion')); // Verifica el mensaje de error  
    }

    public function test_validacion_max_direccion_proveedor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $proveedor = Proveedor::factory()->create();

        $response = $this->post('/registroproveedores', [
        'Direccion' => 'iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
        iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii', 
        ]);
    
        $response->assertSessionHasErrors('Direccion'); // Verifica que se muestre un error de validación para el campo Direccion
        $this->assertContains('La dirección  no debe de tener más de 150 caracteres', session('errors')->get('Direccion')); // Verifica el mensaje de error
    }

    public function test_validacion_no_numeros_en_nombre_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Nombre_encargado' => 'UNAH123', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Nombre_encargado'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El nombre del encargado solo puede tener letras', session('errors')->get('Nombre_encargado')); //Verifica el mensaje de error
    }

    public function test_validacion_no_signos_en_nombre_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Nombre_encargado' => '$*Hanna', // Nombre_encargado con simbolos
        ]);

        $response->assertSessionHasErrors('Nombre_encargado'); // Verifica que se muestre un error de validación para el campo Nombre_encargado
        $this->assertContains('El nombre del encargado solo puede tener letras', session('errors')->get('Nombre_encargado')); //Verifica el mensaje de error
    }

    public function test_validacion_min_en_nombre_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Nombre_encargado' => 'Ha', // Nombre_encargado con simbolos
        ]);

        $response->assertSessionHasErrors('Nombre_encargado'); // Verifica que se muestre un error de validación para el campo Nombre_encargado
        $this->assertContains('El nombre del encargado  debe tener minimo 3 letras', session('errors')->get('Nombre_encargado')); //Verifica el mensaje de error
    }

    public function test_validacion_max_en_nombre_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Nombre_encargado' => 'Haaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', // Nombre_encargado con simbolos
        ]);

        $response->assertSessionHasErrors('Nombre_encargado'); // Verifica que se muestre un error de validación para el campo Nombre_encargado
        $this->assertContains('El nombre del encargado  no debe de tener más de 25 letras', session('errors')->get('Nombre_encargado')); //Verifica el mensaje de error
    }

    public function test_validacion_no_numeros_en_apellido_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Apellido_encargado' => 'Gom123', // Apellido con números
        ]);

        $response->assertSessionHasErrors('Apellido_encargado'); // Verifica que se muestre un error de validación para el campo Apellido
        $this->assertContains('El apellido del encargado solo puede tener letras', session('errors')->get('Apellido_encargado')); //Verifica el mensaje de error/ Error ortografico
    }

    public function test_validacion_no_signos_en_apellido_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Apellido_encargado' => '#$%#@$Lov', // Apellido_encargado con simbolos
        ]);

        $response->assertSessionHasErrors('Apellido_encargado'); // Verifica que se muestre un error de validación para el campo Apellido_encargado
        $this->assertContains('El apellido del encargado solo puede tener letras', session('errors')->get('Apellido_encargado')); //Verifica el mensaje de error/ Error ortografico
    }

    public function test_validacion_min_en_apellido_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Apellido_encargado' => 'L', // Apellido_encargado min
        ]);

        $response->assertSessionHasErrors('Apellido_encargado'); // Verifica que se muestre un error de validación para el campo Apellido_encargado
        $this->assertContains('El apellido debe tener minimo 4 letras', session('errors')->get('Apellido_encargado')); //Verifica el mensaje de error/ Error ortografico
    }

    public function test_validacion_max_en_apellido_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
            'Apellido_encargado' => 'Lmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
            mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 
        ]);

        $response->assertSessionHasErrors('Apellido_encargado'); // Verifica que se muestre un error de validación para el campo Apellido_encargado
        $this->assertContains('El apellido  no debe de tener más de 25 letras', session('errors')->get('Apellido_encargado')); //Verifica el mensaje de error/ Error ortografico
    }

    public function test_validacion_no_letras_en_telefono_empresa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
        'Telefono_empresa' => '8876ABCD', // Teléfono con letras
        ]);

        $response->assertSessionHasErrors('Telefono_empresa'); // Verifica que se muestre un error de validación para el campo Telefono_empresa
        $this->assertContains('El teléfono de la empresa solo debe contener números y empezar con 2, 3, 8 o 9', session('errors')->get('Telefono_empresa')); // Verifica el mensaje de error
    }

    public function test_validacion_no_simbolos_en_telefono_empresa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
        'Telefono_empresa' => '%$##9876', // Teléfono con simbolos
        ]);

        $response->assertSessionHasErrors('Telefono_empresa'); // Verifica que se muestre un error de validación para el campo Telefono_empresa
        $this->assertContains('El teléfono de la empresa solo debe contener números y empezar con 2, 3, 8 o 9', session('errors')->get('Telefono_empresa')); // Verifica el mensaje de error
    }

    public function test_validacion_en_telefono_empresa_con_numero_invalido()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
        'Telefono_empresa' => '08769876', // Teléfono con simbolos
        ]);

        $response->assertSessionHasErrors('Telefono_empresa'); // Verifica que se muestre un error de validación para el campo Telefono_empresa
        $this->assertContains('El teléfono de la empresa solo debe contener números y empezar con 2, 3, 8 o 9', session('errors')->get('Telefono_empresa')); // Verifica el mensaje de error
    }

    public function test_validacion_min_en_telefono_empresa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
        'Telefono_empresa' => '8', 
        ]);

        $response->assertSessionHasErrors('Telefono_empresa'); // Verifica que se muestre un error de validación para el campo Telefono_empresa
        $this->assertContains('El número de teléfono debe  tener minimo 8 números', session('errors')->get('Telefono_empresa')); // Verifica el mensaje de error
    }

    public function test_validacion_max_en_telefono_empresa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
        'Telefono_empresa' => '8888888888888888', 
        ]);

        $response->assertSessionHasErrors('Telefono_empresa'); // Verifica que se muestre un error de validación para el campo Telefono_empresa
        $this->assertContains('El número de teléfono debe  tener máximo  8 números', session('errors')->get('Telefono_empresa')); // Verifica el mensaje de error
    }

    public function test_validacion_no_letras_en_telefono_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
        'Telefono_encargado' => '8876ABCD', // Teléfono con letras
        ]);

        $response->assertSessionHasErrors('Telefono_encargado'); // Verifica que se muestre un error de validación para el campo Telefono_encargado
        $this->assertContains('El teléfono del encargado solo debe contener números y empezar con 2, 3, 8 o 9', session('errors')->get('Telefono_encargado')); // Verifica el mensaje de error
    }

    public function test_validacion_no_simbolos_en_telefono_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
        'Telefono_encargado' => '%$##9876', // Teléfono con simbolos
        ]);

        $response->assertSessionHasErrors('Telefono_encargado'); // Verifica que se muestre un error de validación para el campo Telefono_encargado
        $this->assertContains('El teléfono del encargado solo debe contener números y empezar con 2, 3, 8 o 9', session('errors')->get('Telefono_encargado')); // Verifica el mensaje de error
    }

    public function test_validacion_en_telefono_encargado_con_numero_invalido()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
        'Telefono_encargado' => '78769876', // Teléfono con simbolos
        ]);

        $response->assertSessionHasErrors('Telefono_encargado'); // Verifica que se muestre un error de validación para el campo Telefono_encargado
        $this->assertContains('El teléfono del encargado solo debe contener números y empezar con 2, 3, 8 o 9', session('errors')->get('Telefono_encargado')); // Verifica el mensaje de error
    }

    public function test_validacion_min_en_telefono_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
        'Telefono_encargado' => '8', 
        ]);

        $response->assertSessionHasErrors('Telefono_encargado'); // Verifica que se muestre un error de validación para el campo Telefono_encargado
        $this->assertContains('El número de teléfono debe  tener minimo 8 números', session('errors')->get('Telefono_encargado')); // Verifica el mensaje de error
    }

    public function test_validacion_max_en_telefono_encargado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroproveedores', [
        'Telefono_encargado' => '8888888888888888888888', 
        ]);

        $response->assertSessionHasErrors('Telefono_encargado'); // Verifica que se muestre un error de validación para el campo Telefono_encargado
        $this->assertContains('El número de teléfono debe  tener máximo  8 números', session('errors')->get('Telefono_encargado')); // Verifica el mensaje de error
    }

     //  Editar un proveedor
    public function test_editar_proveedor_y_guardar_cambios()
    {
         // Crea un proveedor en la base de datos
         $proveedor = Proveedor::factory()->create();
     
         // Realiza una solicitud PUT para editar el proveedor con nuevos datos
         $response = $this->put("/proveedor/1/editar", [
            'Nombre_empresa' => 'Unah',
            'Direccion' => 'Col La San Apaguiz',
            'Correo' => 'UNAH@gmail',
            'Telefono_empresa' => '33814113',
            'Nombre_encargado' => 'Maria',
            'Apellido_encargado' => 'Celeste',
            'Telefono_encargado' => '24565456',
         ]);
     
         // Verifica que la respuesta tenga el código de estado 302 (redirección)
         $response->assertStatus(302);
     
         // Verifica que el proveedor editado existe en la base de datos con los nuevos datos
         $this->assertDatabaseHas('proveedors', [
             'id' => 1,
             'Nombre_empresa' => 'Unah',
             'Direccion' => 'Col La San Apaguiz',
             'Correo' => 'UNAH@gmail',
             'Telefono_empresa' => '33814113',
             'Nombre_encargado' => 'Maria',
             'Apellido_encargado' => 'Celeste',
             'Telefono_encargado' => '24565456',
         ]);
    }
}