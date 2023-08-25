<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;


class ClienteTest extends TestCase
{ 

    //Acceder a as rutas con usuario valido
    public function test_Validar_ruta_home()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/');
        $response->assertStatus(200);
    }

     //Acceder a la ruta de registro de cliente GET
    public function test_ruta_registro_clientes()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registro cliente
        $response = $this->actingAs($user)->get('/registroclientes');   
        $response->assertStatus(200);
    }

    //Acceder a la ruta de Listado de cliente GET
    public function test_ruta_listado_Clientes()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado cliente
        $response = $this->actingAs($user)->get('/Cliente');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de Detalle del cliente GET
    public function test_ruta_detalle_Clientes()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado cliente
        $response = $this->actingAs($user)->get('/Clientes/1');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de editar del cliente GET
    public function test_ruta_editar_Clientes()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado cliente
        $response = $this->actingAs($user)->get('/cliente/1/editar');
        $response->assertStatus(200);
    }


      //Verificar el contenido de las vistas
    public function test_registro_clientes()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registro cliente
        $response = $this->actingAs($user)->get('/registroclientes');
        $response->assertStatus(200);
        $response->assertSee('Registrar cliente');  // Verificar que la vista contiene el título "Registrar cliente"
        $response->assertSee('Nombres');
        $response->assertSee('Apellidos');
        $response->assertSee('Número de identidad');
        $response->assertSee('Teléfono fijo o celular');
        $response->assertSee('Dirección');
        $response->assertSeeInOrder(['Guardar', 'Limpiar', 'Cerrar']);  // Verifica que los botones aparezcan en orden específico en la respuesta HTML     
    }

    //Acceder a la ruta de Listado de cliente GET
    public function test_listado_Clientes()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado cliente
        $response = $this->actingAs($user)->get('/Cliente');
        $response->assertStatus(200);
        $response->assertSee('Listado de clientes');  // Verificar que la vista contiene el título "Listado de clientes"
        $response->assertSee('Buscar por nombre, apellidos o identidad');
        $response->assertSeeText('uno'); //icono de agregar un nuevo cliente en el listado
    }

     //Acceder a la ruta de editar del cliente GET
    public function test_editar_Clientes()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado cliente
        $response = $this->actingAs($user)->get('/cliente/1/editar');
        $response->assertStatus(200);
        $response->assertSee('Editar cliente');  // Verificar que la vista contiene el título "Editar cliente"
        $response->assertSee('Nombres');
        $response->assertSee('Apellidos');
        $response->assertSee('Número de identidad');
        $response->assertSee('Teléfono fijo o celular');
        $response->assertSee('Dirección');
        $response->assertSeeInOrder(['Actualizar', 'Restaurar', 'Cancelar']);  // Verifica que los botones aparezcan en orden específico en la respuesta HTML  
    }

    //Acceder a la ruta de Detalle del cliente GET
    public function test_detalle_Clientes()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado cliente
        $response = $this->actingAs($user)->get('/Clientes/1');
        $response->assertStatus(200);
        $response->assertSee('Información del cliente');  // Verificar que la vista contiene el título "Información del cliente"
        $response->assertSeeInOrder(['Nombres', 
        'Apellidos', 
        'Número de identidad',
        'Teléfono fijo o celular',
        'Dirección',
        'Editar',
        'Volver' ]);
    }


    //Acceder a los botones de agregar en listado y editar en detalles
    public function test_boton_agregar_en_listado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/Cliente');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get(route('show.registroCliente'));

        // Verifica que se redirige correctamente a la ruta 
        $response->assertStatus(200);
        $response->assertSee('Registrar cliente'); //Muestra titulo de la ventana de registro cliente.
    }

    public function test_boton_editar_en_detalles_cliente()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado cliente
        $response = $this->actingAs($user)->get('/Clientes/1');
        $response->assertStatus(200);
    
        // Hacer clic en el botón de editar y seguir la redirección
        $response = $this->followingRedirects()->get("/cliente/1/editar");
    
        // Verifica que se redirige correctamente a la ruta de edición del cliente
        $response->assertStatus(200);

        $response->assertSee('Editar cliente');

        // Obtiene el contenido HTML de la respuesta
        $content = $response->getContent();

        // Verifica que el valor "Maria Celeste" esté presente en el campo Nombres
        $this->assertStringContainsString('Maria Celeste', $content); 
    }

    public function test_boton_volver_en_detalle_cliente()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado cliente
        $response = $this->actingAs($user)->get('/Clientes/1');
        $response->assertStatus(200);
    
        // Hacer clic en el botón de editar y seguir la redirección
        $response = $this->followingRedirects()->get("/Cliente");
    
        // Verifica que se redirige correctamente a la ruta de listado del cliente
        $response->assertStatus(200);

        $response->assertSee('Listado de clientes');

        // Obtiene el contenido HTML de la respuesta
        $content = $response->getContent();

        // Verifica que el valor "Maria Celeste" esté presente en el campo Nombres
        $this->assertStringContainsString('Maria Celeste', $content);
    }

    public function test_boton_cancelar_en_editar_cliente()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de editar cliente
        $response = $this->actingAs($user)->get('/cliente/1/editar');
        $response->assertStatus(200);
    
        // Hacer clic en el botón de editar y seguir la redirección
        $response = $this->followingRedirects()->get("/Cliente");
    
        // Verifica que se redirige correctamente a la ruta de listado del cliente
        $response->assertStatus(200);

        $response->assertSee('Listado de clientes');

        // Obtiene el contenido HTML de la respuesta
        $content = $response->getContent();

        // Verifica que el valor "Maria Celeste" esté presente en el campo Nombres
        $this->assertStringContainsString('Maria Celeste', $content);
    }
    
     //Rutas inválidas
     public function test_Validar_ruta_invalida_home()
     {
        $response = $this->get('/455646546');
        $response->assertStatus(404);
     }
     
     //Acceso restringido
     public function test_usuario_sin_autenticacion_redirigido_home()
     {
        $response = $this->get('/');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
     }

     public function test_usuario_sin_autenticacion_redirigido_listado_Cliente()
     {
        $response = $this->get('/Cliente');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
     }

     public function test_usuario_sin_autenticacion_redirigido_registro()
     {
        $response = $this->get('/registroclientes');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
     }

     public function test_usuario_sin_autenticacion_redirigido_detalle()
     {
        $response = $this->get('/Clientes/1');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
     }

     public function test_usuario_sin_autenticacion_redirigido_editar()
     {
        $response = $this->get('/cliente/1/editar');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
     }


    //Agregar Nuevo registro a la tabla clientes
    public function test_agregar_nuevo_cliente()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user); // Autentica al usuario para la prueba

        $clienteData = [
            'Nombre' => 'Juana Marcela',
            'Apellido' => 'Mendoza',
            'Numero_identidad' => '0704199600577',
            'Numero_telefono' => '98722335',
            'Direccion' => 'Barrio san juan',
        ];

        $response = $this->withoutMiddleware()->post('/registroclientes', $clienteData);
        $this->assertDatabaseHas('clientes', $clienteData); // Verifica que el cliente se ha creado en la base de datos
    }

    
    public function test_redireccion_despues_de_agregar_cliente()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user); // Autentica al usuario para la prueba 
        
        $response = $this->post('/registroclientes', [
            'Nombre' => 'Marcela',
            'Apellido' => 'Mendoza',
            'Numero_identidad' => '0704198200467',
            'Numero_telefono' => '38729265',
            'Direccion' => 'Barrio las lomitas',]);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertRedirect('/Cliente'); // Verifica redirección a la ruta /Cliente
    }


    //Validaciones campos
    public function test_validacion_formulario_cliente_vacio()
   {
       // Crea un usuario
       $user = User::factory()->create();
       $this->actingAs($user);

       $response = $this->post('/registroclientes', [
           'Nombre' => '', // Campo requerido
           'Apellido' => '', // Campo requerido
           'Numero_identidad' => '', // Campo requerido
           'Numero_telefono' => '', // Campo requerido
           'Direccion' => '', // Campo requerido
       ]);

       $response->assertSessionHasErrors('Nombre'); // Verifica que se muestre un error de validación para el campo Nombre
       $response->assertSessionHasErrors('Apellido');
       $response->assertSessionHasErrors('Numero_identidad');
       $response->assertSessionHasErrors('Numero_telefono');
       $response->assertSessionHasErrors('Direccion');
   }

    public function test_nombre_vacio_no_enviar_formulario_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre' => '', // Campo vacio
            'Apellido' => 'Merlo', 
            'Numero_identidad' => '0708199700515', 
            'Numero_telefono' => '97656788', 
            'Direccion' => 'Res zarzales', 
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroclientes', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('clientes', $datos);
    }

    public function test_apellido_vacio_no_enviar_formulario_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre' => 'Jose', 
            'Apellido' => '', // Campo vacio
            'Numero_identidad' => '0708199700515',
            'Numero_telefono' => '97656788', 
            'Direccion' => 'Res zarzales', 
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroclientes', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('clientes', $datos);
    }

    public function test_numero_identidad_vacio_no_enviar_formulario_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre' => 'Jose', 
            'Apellido' => 'Lopez', 
            'Numero_identidad' => '', // Campo vacio
            'Numero_telefono' => '97656788', 
            'Direccion' => 'Res zarzales', 
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroclientes', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('clientes', $datos);
    }

    public function test_numero_telefono_vacio_no_enviar_formulario_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre' => 'Jose', 
            'Apellido' => 'Lopez', 
            'Numero_identidad' => '0702200000544', 
            'Numero_telefono' => '', // Campo vacio
            'Direccion' => 'Res zarzales', 
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroclientes', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('clientes', $datos);
    }

    public function test_direccion_vacio_no_enviar_formulario_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba

        $datos = [
            'Nombre' => 'Jose', 
            'Apellido' => 'Lopez', 
            'Numero_identidad' => '0702200000544', 
            'Numero_telefono' => '33446655', 
            'Direccion' => '', // Campo vacio
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroclientes', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('clientes', $datos);
    }

     public function test_agregar_cliente_sin_duplicar_identidad()
     {
        // Crea un usuario y autentícalo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crea un cliente existente con un número de identidad
        Cliente::factory()->create([
            'Numero_identidad' => '0704200000523',
        ]);

        // Datos del cliente a agregar
        $nuevoCliente = [
            'Nombre' => 'Juan',
            'Apellido' => 'Pérez',
            'Numero_identidad' => '0704200000523', // Mismo número de identidad
            'Numero_telefono' => '98765432',
            'Direccion' => 'Barrio San Juan',
        ];

        // Intenta agregar el cliente con el mismo número de identidad
        $response = $this->post('/registroclientes', $nuevoCliente);

        // Verifica que el cliente no se agregó debido a la duplicación de número de identidad
        $response->assertSessionHasErrors('Numero_identidad');
    }

    public function test_agregar_cliente_sin_duplicar_telefono()
    {
       // Crea un usuario y lo autentíca
       $user = User::factory()->create();
       $this->actingAs($user);

       // Crea un cliente existente con un número de telefono
       Cliente::factory()->create([
           'Numero_telefono' => '88418030',
       ]);

       // Datos del cliente a agregar
       $nuevoCliente = [
           'Nombre' => 'Juan',
           'Apellido' => 'Pérez',
           'Numero_identidad' => '0408200087634', // Mismo número de telefono
           'Numero_telefono' => '88418030',
           'Direccion' => 'Barrio San Juan',
       ];

       // Intenta agregar el cliente con el mismo telefono
       $response = $this->post('/registroclientes', $nuevoCliente);

       // Verifica que el cliente no se agregó debido a la duplicación de telefono
       $response->assertSessionHasErrors('Numero_telefono');
   }

   public function test_nombre_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $clienteData = [
            'Nombre' => 'Hadasa^_^',// campo inválido
            'Apellido' => 'Garcia',
            'Numero_identidad' => '0408200087634', 
            'Numero_telefono' => '88418030',
            'Direccion' => 'Barrio San Juan',
        ];

        $response = $this->post('/registroclientes', $clienteData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Nombre']); // Verifica que haya errores de validación en el campo Nombre
        $this->assertDatabaseMissing('clientes', ['Nombre' => 'Hadasa^_^']); // Verifica que el Nombre no se haya guardado en la base de datos
    }

    public function test_apellido_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $clienteData = [
            'Nombre' => 'Hadasa',
            'Apellido' => 'Garcia:|', // campo inválido
            'Numero_identidad' => '0408200087634', 
            'Numero_telefono' => '88418030',
            'Direccion' => 'Barrio San Juan',
        ];

        $response = $this->post('/registroclientes', $clienteData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Apellido']); // Verifica que haya errores de validación en el campo Apellido
        $this->assertDatabaseMissing('clientes', ['Apellido' => 'Garcia:|']); // Verifica que el Apellido no se haya guardado en la base de datos
    }

    public function test_numero_identidad_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $clienteData = [
            'Nombre' => 'Hadasa',
            'Apellido' => 'Garcia',
            'Numero_identidad' => '0408&%$#00509', // campo inválido
            'Numero_telefono' => '88418030',
            'Direccion' => 'Barrio San Juan',
        ];

        $response = $this->post('/registroclientes', $clienteData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Numero_identidad']); // Verifica que haya errores de validación en el campo Numero_identidad
        $this->assertDatabaseMissing('clientes', ['Numero_identidad' => '0408&%$#00509']); // Verifica que el Numero_identidad no se haya guardado en la base de datos
    }

    public function test_numero_telefono_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $clienteData = [
            'Nombre' => 'Hadasa',
            'Apellido' => 'Garcia',
            'Numero_identidad' => '0704199700546', 
            'Numero_telefono' => '@%&18030',// campo inválido
            'Direccion' => 'Barrio San Juan',
        ];

        $response = $this->post('/registroclientes', $clienteData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Numero_telefono']); // Verifica que haya errores de validación en el campo Numero_telefono
        $this->assertDatabaseMissing('clientes', ['Numero_telefono' => '@%&18030']); // Verifica que el Numero_telefono no se haya guardado en la base de datos
    }

    public function test_direccion_cliente_no_valido()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Autentica al usuario para la prueba 

        $clienteData = [
            'Nombre' => 'Hadasa',
            'Apellido' => 'Garcia',
            'Numero_identidad' => '0704199700546', 
            'Numero_telefono' => '87618030',
            'Direccion' => 'C',// campo inválido
        ];

        $response = $this->post('/registroclientes', $clienteData);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertSessionHasErrors(['Direccion']); // Verifica que haya errores de validación en el campo Direccion
        $this->assertDatabaseMissing('clientes', ['Direccion' => 'C']); // Verifica que el Direccion no se haya guardado en la base de datos
    }


    public function test_validacion_no_numeros_en_nombre()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Nombre' => 'Marcela123', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Nombre'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El nombre del cliente solo puede tener letras', session('errors')->get('Nombre')); //Verifica el mensaje de error
    }

    public function test_validacion_no_signos_en_nombre()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Nombre' => '$amy', // Nombre con simbolos
        ]);

        $response->assertSessionHasErrors('Nombre'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El nombre del cliente solo puede tener letras', session('errors')->get('Nombre')); //Verifica el mensaje de error
    }

    public function test_validacion_min_en_nombre_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Nombre' => 'a',
        ]);

        $response->assertSessionHasErrors('Nombre'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El nombre debe tener minimo 3 letras', session('errors')->get('Nombre')); //Verifica el mensaje de error
    }

    public function test_validacion_max_en_nombre_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
        ]);

        $response->assertSessionHasErrors('Nombre'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El nombre no debe de tener más de 25 letras', session('errors')->get('Nombre')); //Verifica el mensaje de error
    }

    public function test_validacion_no_numeros_en_apellido()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Apellido' => 'Lovo10', // Apellido con números
        ]);

        $response->assertSessionHasErrors('Apellido'); // Verifica que se muestre un error de validación para el campo Apellido
        $this->assertContains('El apellido del cliente solo puede tener letras', session('errors')->get('Apellido')); //Verifica el mensaje de error
    }

    public function test_validacion_no_signos_en_apellido()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Apellido' => 'Lovo##*', // Apellido con signos
        ]);

        $response->assertSessionHasErrors('Apellido'); // Verifica que se muestre un error de validación para el campo Apellido
        $this->assertContains('El apellido del cliente solo puede tener letras', session('errors')->get('Apellido')); //Verifica el mensaje de error
    }

    public function test_validacion_min_en_apellido_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Apellido' => 'Lo', 
        ]);

        $response->assertSessionHasErrors('Apellido'); // Verifica que se muestre un error de validación para el campo Apellido
        $this->assertContains('El apellido debe tener minimo 4 letras', session('errors')->get('Apellido')); //Verifica el mensaje de error
    }

    public function test_validacion_max_en_apellido_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Apellido' => 'Loooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
            oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo', 
        ]);

        $response->assertSessionHasErrors('Apellido'); // Verifica que se muestre un error de validación para el campo Apellido
        $this->assertContains('El apellido  no debe de tener más de 25 letras', session('errors')->get('Apellido')); //Verifica el mensaje de error
    }

    public function test_validacion_no_letras_en_identidad()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Numero_identidad' => '0704ABCD12355', // Identidad con letras
        ]);

        $response->assertSessionHasErrors('Numero_identidad'); // Verifica que se muestre un error de validación para el campo Numero_identidad
        $this->assertContains('El número de identidad debe empezar con 0 o 1 ', session('errors')->get('Numero_identidad')); //Verifica el mensaje de error
    }

    public function test_validacion_no_simbolos_en_identidad()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Numero_identidad' => '0803%#@^12355', // Identidad con letras
        ]);

        $response->assertSessionHasErrors('Numero_identidad'); // Verifica que se muestre un error de validación para el campo Numero_identidad
        $this->assertContains('El número de identidad debe empezar con 0 o 1 ', session('errors')->get('Numero_identidad')); //Verifica el mensaje de error
    }

    public function test_validacion_min_en_identidad_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Numero_identidad' => '0', // Identidad con letras
        ]);

        $response->assertSessionHasErrors('Numero_identidad'); // Verifica que se muestre un error de validación para el campo Numero_identidad
        $this->assertContains('El número de identidad debe minimo tener 13 números', session('errors')->get('Numero_identidad')); //Verifica el mensaje de error
    }

    public function test_validacion_max_en_identidad_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/registroclientes', [
            'Numero_identidad' => '0918272876762152146425', // Identidad con letras
        ]);

        $response->assertSessionHasErrors('Numero_identidad'); // Verifica que se muestre un error de validación para el campo Numero_identidad
        $this->assertContains('El número de identidad debe  tener 13 números', session('errors')->get('Numero_identidad')); //Verifica el mensaje de error
    }

    public function test_validacion_no_letras_en_telefono()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        
        $cliente = Cliente::factory()->create();

        $response = $this->post('/registroclientes', [
            'Numero_telefono' => '8876ABCD', // Teléfono con letras
        ]);

        $response->assertSessionHasErrors('Numero_telefono'); // Verifica que se muestre un error de validación para el campo Numero_telefono
        $this->assertContains('El número de teléfono debe empezar con 2,3,8 o 9 ', session('errors')->get('Numero_telefono')); // Verifica el mensaje de error
    }

    public function test_validacion_no_simbolo_en_telefono()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        
        $cliente = Cliente::factory()->create();

        $response = $this->post('/registroclientes', [
            'Numero_telefono' => '########', // Teléfono con simbolos
        ]);

       $response->assertSessionHasErrors('Numero_telefono'); // Verifica que se muestre un error de validación para el campo Numero_telefono
       $this->assertContains('El número de teléfono debe empezar con 2,3,8 o 9 ', session('errors')->get('Numero_telefono')); // Verifica el mensaje de error
    }

    public function test_validacion_min_en_telefono_cliente()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        
        $cliente = Cliente::factory()->create();

        $response = $this->post('/registroclientes', [
            'Numero_telefono' => '8876ABCD', // Teléfono con letras
        ]);

        $response->assertSessionHasErrors('Numero_telefono'); // Verifica que se muestre un error de validación para el campo Numero_telefono
        $this->assertContains('El número de teléfono debe minimo tener 8 números', session('errors')->get('Numero_telefono')); // Verifica el mensaje de error
    }

    public function test_validacion_max_en_telefono_cliente()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        
        $cliente = Cliente::factory()->create();

        $response = $this->post('/registroclientes', [
            'Numero_telefono' => '888888888', // Teléfono con letras
        ]);

        $response->assertSessionHasErrors('Numero_telefono'); // Verifica que se muestre un error de validación para el campo Numero_telefono
        $this->assertContains('El número de teléfono debe  tener 8 números', session('errors')->get('Numero_telefono')); // Verifica el mensaje de error
    }

    public function test_validacion_min_direccion_cliente()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        
        $cliente = Cliente::factory()->create();

        $response = $this->post('/registroclientes', [
            'Direccion' => 'a', // Direccion minima
        ]);
    
        $response->assertSessionHasErrors('Direccion'); // Verifica que se muestre un error de validación para el campo Direccion
        $this->assertContains('La dirección debe tener minimo 3 letras', session('errors')->get('Direccion')); // Verifica el mensaje de error
    }

    public function test_validacion_max_direccion_cliente()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        
        $cliente = Cliente::factory()->create();

        $response = $this->post('/registroclientes', [
            'Direccion' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', //Direccion maxima
        ]);
    
        $response->assertSessionHasErrors('Direccion'); // Verifica que se muestre un error de validación para el campo Direccion
        $this->assertContains('La dirección no debe de tener más de 150 letras', session('errors')->get('Direccion')); // Verifica el mensaje de error
    }

    //  Editar un cliente
    public function test_editar_cliente_y_guardar_cambios()
    {
        // Crea un cliente en la base de datos
        $cliente = Cliente::factory()->create();

        // Realiza una solicitud PUT para editar el cliente con nuevos datos
        $response = $this->put("/cliente/526/editar", [
            'Nombre' => 'Marcela',
            'Apellido' => 'Gomez',
            'Numero_identidad' => '0704199900509',
            'Numero_telefono' => '98456557',
            'Direccion' => 'Nueva Jerusalem',
        ]);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el cliente editado existe en la base de datos con los nuevos datos
        $this->assertDatabaseHas('clientes', [
            'id' => 526,
            'Nombre' => 'Marcela',
            'Apellido' => 'Gomez',
            'Numero_identidad' => '0704199900509',
            'Numero_telefono' => '98456557',
            'Direccion' => 'Nueva Jerusalem',
        ]);
    }

}
