<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;

class EmpleadoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
     //Acceder a la ruta de registro de empleado GET
    public function test_ruta_registro_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registro empleado
        $response = $this->actingAs($user)->get('/registroempleados');
        $response->assertStatus(200);   
    }

    //Acceder a la ruta de Listado de empleado GET
    public function test_ruta_listado_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado empleado
        $response = $this->actingAs($user)->get('/Empleado');
        $response->assertStatus(200);
    }

    //Acceder a la ruta de Detalle del empleado GET
    public function test_ruta_detalle_empleados()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado empleado
        $response = $this->actingAs($user)->get('/Empleados/1');
        $response->assertStatus(200);
     }

    //Acceder a la ruta de editar del cliente GET
    public function test_ruta_editar_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de editar empleado
        $response = $this->actingAs($user)->get('/empleado/1/editar');
        $response->assertStatus(200);
    }


    //Verificar el contenido de las vistas
    public function test_registro_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registro empleado
        $response = $this->actingAs($user)->get('/registroempleados');
        $response->assertStatus(200);
        $response->assertSee('Registrar empleado');  // Verificar que la vista contiene el título "Registrar empleado"
        $response->assertSee('Nombres');
        $response->assertSee('Apellidos');
        $response->assertSee('Número de identidad');
        $response->assertSee('Fecha de nacimiento');
        $response->assertSee('Número de teléfono');
        $response->assertSee('Fecha de contrato');
        $response->assertSee('Salario');
        $response->assertSee('Dirección');
        $response->assertSeeInOrder(['Guardar', 'Limpiar', 'Cerrar']);  // Verifica que los botones aparezcan en orden específico en la respuesta HTML     
    }

    //Acceder a la ruta de Listado de empleado GET
    public function test_listado_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado empleado
        $response = $this->actingAs($user)->get('/Empleado');
        $response->assertStatus(200);
        $response->assertSee('Listado de empleados');  // Verificar que la vista contiene el título "Listado de empleados"
        $response->assertSee('Busqueda general');
        $response->assertSeeText('uno'); //icono de agregar un nuevo empleado en el listado
    }

    //Acceder a la ruta de Detalle del empleado GET
    public function test_detalle_empleados()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado empleado
        $response = $this->actingAs($user)->get('/Empleados/1');
        $response->assertStatus(200);
        $response->assertSee('Información del empleado');  // Verificar que la vista contiene el título "Infromación del empleado"
        $response->assertSeeInOrder(['Nombres', 
        'Apellidos', 
        'Número de identidad',
        'Fecha de nacimiento',
        'Teléfono fijo o celular',
        'Salario',
        'Fecha de contrato',
        'Dirección',
        'Editar',
        'Volver' ]);
    }

     //Acceder a la ruta de editar del cliente GET
    public function test_editar_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de editar empleado
        $response = $this->actingAs($user)->get('/empleado/1/editar');
        $response->assertStatus(200);
        $response->assertSee('Editar empleado');  // Verificar que la vista contiene el título "Editar empleado"
        $response->assertSee('Nombres');
        $response->assertSee('Apellidos');
        $response->assertSee('Número de identidad');
        $response->assertSee('Fecha de nacimiento');
        $response->assertSee('Número de teléfono');
        $response->assertSee('Fecha de contrato');
        $response->assertSee('Salario Lps');
        $response->assertSee('Dirección');
        $response->assertSeeInOrder(['Actualizar', 'Restaurar', 'Cancelar']);  // Verifica que los botones aparezcan en orden específico en la respuesta HTML  
    }


    /*BOTONES EDITAR Y AGREGAR  */
    /*Prueba del boton para agregar una nuevo registro */
    public function test_boton_agregar_en_listado_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/Empleado');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get(route('show.registroEmpleado'));

        // Verifica que se redirige correctamente a la ruta 
        $response->assertStatus(200);
        $response->assertSee('Registrar empleado'); //Muestra titulo de la ventana de registro empleado.
    }
    
    public function test_boton_editar_en_detalles_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
    
        //realiza una solicitud GET a la ruta de detalle empleado
        $response = $this->actingAs($user)->get('/Empleados/1');
        $response->assertStatus(200);;
        
         // Hacer clic en el botón de editar y seguir la redirección
        $response = $this->followingRedirects()->get("/empleado/1/editar");
        
        // Verifica que se redirige correctamente a la ruta de edición del cliente
        $response->assertStatus(200);
    
        $response->assertSee('Editar empleado');
    
        // Obtiene el contenido HTML de la respuesta
        $content = $response->getContent();
    
        // Verifica que el valor "Unah" esté presente en el campo Nombre_empresa
        $this->assertStringContainsString('Ruth', $content);
        $this->assertStringContainsString('Gibson', $content);
    }

    public function test_boton_volver_en_detalle_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado cliente
        $response = $this->actingAs($user)->get('/Empleados/1');
        $response->assertStatus(200);
    
            // Hacer clic en el botón de editar y seguir la redirección
        $response = $this->followingRedirects()->get("/Empleado");
    
        // Verifica que se redirige correctamente a la ruta listado del empleado
        $response->assertStatus(200);

        $response->assertSee('Listado de empleados');

        // Obtiene el contenido HTML de la respuesta
        $content = $response->getContent();

        // Verifica que el valor "Ruth" esté presente en el campo Nombres
        $this->assertStringContainsString('Ruth', $content);
    }

    public function test_boton_cancelar_en_editar_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de editar empleado
        $response = $this->actingAs($user)->get('/empleado/1/editar');
        $response->assertStatus(200);
    
        // Hacer clic en el botón de editar y seguir la redirección
        $response = $this->followingRedirects()->get("/Empleado");
    
        // Verifica que se redirige correctamente a la ruta de listado del empleado
        $response->assertStatus(200);

        $response->assertSee('Listado de empleados');

        // Obtiene el contenido HTML de la respuesta
        $content = $response->getContent();

        // Verifica que el valor "Ruth" esté presente en el campo Nombres
        $this->assertStringContainsString('Ruth', $content);
    }

     //Acceso restringido
    public function test_usuario_sin_autenticacion_redirigido_registro_empleado()
    {
        $response = $this->get('/registroempleados');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_usuario_sin_autenticacion_redirigido_listado_empleado()
    {
        $response = $this->get('/Empleado');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_usuario_sin_autenticacion_redirigido_detalle_empleado()
    {
        $response = $this->get('/Empleados/1');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    public function test_usuario_sin_autenticacion_redirigido_editar_empleado()
    {
        $response = $this->get('/empleado/1/editar');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }


    //Agregar Nuevo registro a la tabla empleados
    public function test_agregar_nuevo_empleado()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user); // Autentica al usuario para la prueba

        $empleadoData = [
            'Nombres' => 'Mariana',
            'Apellidos' => 'Sevilla',
            'Numero_identidad' => '0704199908767',
            'Fecha_nacimiento' => '1992-04-02',
            'Numero_telefono' => '38799432',
            'Salrio' => '10000',
            'Fecha_contrato' => '2023-04-02',
            'Direccion' => 'Barrio los bajos',
        ];

        $response = $this->withoutMiddleware()->post('/registroempleados', $empleadoData);
        $this->assertDatabaseHas('empleados', $empleadoData); // Verifica que el cliente se ha creado en la base de datos
    }

    public function test_redireccion_despues_de_agregar_empleado()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user); // Autentica al usuario para la prueba 
        
        $response = $this->post('/registroempleados', 
        [   'Nombres' => 'Juana',
            'Apellidos' => 'Mendoza',
            'Numero_identidad' => '0704198100887',
            'Fecha_nacimiento' => '1992-04-02',
            'Numero_telefono' => '98799265',
            'Salrio' => '10000',
            'Fecha_contrato' => '2023-04-02',
            'Direccion' => 'Res La Nina',
        ]);

        $response->assertStatus(302); // Verifica redirección después de agregar
        $response->assertRedirect('/Empleado'); // Verifica redirección a la ruta /Empleado
    }


    //Validaciones en los campos
    public function test_agregar_empleado_con_numero_identidad_duplicado()
    {
        // Crea un usuario 
        $user = User::findOrFail(1);
        Auth::login($user);

        // Crea un cliente existente con un número de identidad
        Empleado::factory()->create([
            'Numero_identidad' => '0704200000523',
        ]);

        // Datos del cliente a agregar
        $nuevoEmpleado = [
            'Nombres' => 'Juana',
            'Apellidos' => 'Mendoza',
            'Numero_identidad' => '0704200000523',
            'Fecha_nacimiento' => '1997-04-02',
            'Numero_telefono' => '97548659',
            'Salrio' => '10000',
            'Fecha_contrato' => '2021-04-02',
            'Direccion' => 'Res La Nina',
        ];

        // Intenta agregar el cliente con el mismo número de identidad
        $response = $this->post('/registroempleados', $nuevoEmpleado);

        // Verifica que el cliente no se agregó debido a la duplicación de número de identidad
        $response->assertSessionHasErrors('Numero_identidad');
    }

    public function test_agregar_empleado_con_numero_telefono_duplicado()
    {
        // Crea un usuario 
        $user = User::findOrFail(1);
        Auth::login($user);

        // Crea un cliente existente con un número de identidad
        Empleado::factory()->create([
            'Numero_telefono' => '97548659',
        ]);

        // Datos del cliente a agregar
        $nuevoEmpleado = [
            'Nombres' => 'Juana',
            'Apellidos' => 'Mendoza',
            'Numero_identidad' => '0704200000523',
            'Fecha_nacimiento' => '1997-04-02',
            'Numero_telefono' => '97548659',
            'Salrio' => '10000',
            'Fecha_contrato' => '2021-04-02',
            'Direccion' => 'Res La Nina',
        ];

        // Intenta agregar el cliente con el mismo número de identidad
        $response = $this->post('/registroempleados', $nuevoEmpleado);

        // Verifica que el cliente no se agregó debido a la duplicación de número de identidad
        $response->assertSessionHasErrors('Numero_identidad');
    }

    public function test_validacion_formulario_empleados_vacio()
    {
       // Crea un usuario 
       $user = User::factory()->create();
       $this->actingAs($user);

       $response = $this->post('/registroempleados', [
            'Nombres' => '',
            'Apellidos' => '',
            'Numero_identidad' => '',
            'Fecha_nacimiento' => '',
            'Numero_telefono' => '',
            'Salrio' => '',
            'Fecha_contrato' => '',
            'Direccion' => '',
       ]);

       $response->assertSessionHasErrors('Nombres'); 
       $response->assertSessionHasErrors('Apellidos');
       $response->assertSessionHasErrors('Numero_identidad');
       $response->assertSessionHasErrors('Fecha_nacimiento');
       $response->assertSessionHasErrors('Numero_telefono');
       $response->assertSessionHasErrors('Salrio');
       $response->assertSessionHasErrors('Fecha_contrato');
       $response->assertSessionHasErrors('Direccion');

    }

    public function test_empleado_campos_vacios()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $datosE = [
            'Nombres' => '',
            'Apellidos' => '',
            'Numero_identidad' => '',
            'Fecha_nacimiento' => '',
            'Numero_telefono' => '',
            'Salrio' => '',
            'Fecha_contrato' => '',
            'Direccion' => '',
            'activo' => '',
        ];

        // Para que acceda a la ruta
        $response = $this->post('/registroempleados', $datosE);

        // Verificar que los datos de la factura principal no se guardaron en la base de datos
        $this->assertDatabaseMissing('empleados', $datosE);

        //verifica que se muestren el mensaje de validacion
        $response->assertSessionHasErrors([
            'Nombres',
            'Apellidos',
            'Numero_identidad',
            'Fecha_nacimiento',
            'Numero_telefono',
            'Salrio',
            'Fecha_contrato',
            'Direccion',
        ]);

    }

    public function test_nombres_vacio_no_enviar_formulario_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $datos = [
            'Nombres' => '',//campo vacio
            'Apellidos' => 'Irias',
            'Numero_identidad' => '0704200000765',
            'Fecha_nacimiento' => '2000-10-04',
            'Numero_telefono' => '34567654',
            'Salrio' => '50000',
            'Fecha_contrato' => '2023-04-10',
            'Direccion' => 'Res lomas verdes',
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroempleados', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('empleados', $datos);
    }

    public function test_apellidos_vacio_no_enviar_formulario_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $datos = [
            'Nombres' => 'Hadasa',
            'Apellidos' => 'lovo',//campo vacio
            'Numero_identidad' => '0704200000765',
            'Fecha_nacimiento' => '2000-10-04',
            'Numero_telefono' => '24567654',
            'Salrio' => '50000',
            'Fecha_contrato' => '2023-04-10',
            'Direccion' => 'Res lomas verdes',
            'activo' => '1',
        ];

        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/registroempleados', $datos);

        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);

        // Verifica que el proveedor no se haya creado en la base de datos
        $this->assertDatabaseMissing('empleados', $datos);
    }

    public function test_validacion_min_en_nombre_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Nombres' => 'Ma', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Nombres'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El nombre del empleado debe tener minimo 3 letras', session('errors')->get('Nombres')); //Verifica el mensaje de error
    }

    public function test_validacion_max_en_nombre_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Nombres' => 'Martinezasdfghjklopiqwertyu', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Nombres'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El nombre del empleado no debe de tener más de 25 letras', session('errors')->get('Nombres')); //Verifica el mensaje de error
    }

    public function test_validacion_no_numeros_en_nombre_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Nombres' => 'Marcela123', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Nombres'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El nombre del empleado solo puede tener letras', session('errors')->get('Nombres')); //Verifica el mensaje de error
    }

    public function test_validacion_no_signos_en_nombre_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Nombres' => '$#my', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Nombres'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El nombre del empleado solo puede tener letras', session('errors')->get('Nombres')); //Verifica el mensaje de error
    }

    public function test_validacion_no_numeros_en_apellidos_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Apellidos' => 'Moncada23', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Apellidos'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El apellido del empleado solo puede tener letras', session('errors')->get('Apellidos')); //Verifica el mensaje de error
    }

    public function test_validacion_no_simbolos_en_apellidos_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Apellidos' => 'Moncada=?"#@3', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Apellidos'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El apellido del empleado solo puede tener letras', session('errors')->get('Apellidos')); //Verifica el mensaje de error
    }

    public function test_validacion_min_en_apellido_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Apellidos' => 'Ma', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Apellidos'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El apellido del empleado debe tener minimo 4 letras', session('errors')->get('Apellidos')); //Verifica el mensaje de error
    }

    public function test_validacion_max_en_apellido_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Apellidos' => 'Materyuytrewqasdfghjkloplqwerty', // Nombre con números
        ]);

        $response->assertSessionHasErrors('Apellidos'); // Verifica que se muestre un error de validación para el campo Nombre
        $this->assertContains('El apellido del empleado no debe de tener más de 25 letras', session('errors')->get('Apellidos')); //Verifica el mensaje de error
    }

    public function test_validacion_no_letras_en_identidad()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Numero_identidad' => '0704ABCD12355', // Identidad con letras
        ]);

        $response->assertSessionHasErrors('Numero_identidad'); // Verifica que se muestre un error de validación para el campo Numero_identidad
        $this->assertContains('El número de identidad solo debe contener números y empezar con 0 o 1', session('errors')->get('Numero_identidad')); //Verifica el mensaje de error
    }

    public function test_validacion_no_simbolos_en_identidad()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Numero_identidad' => '0803%#@^12355', // Identidad con letras
        ]);

        $response->assertSessionHasErrors('Numero_identidad'); // Verifica que se muestre un error de validación para el campo Numero_identidad
        $this->assertContains('El número de identidad solo debe contener números y empezar con 0 o 1', session('errors')->get('Numero_identidad')); //Verifica el mensaje de error
    }

    public function test_validacion_anio_invalido_en_fecha_nacimiento()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Fecha_nacimiento' => '1958-04-02', // Identidad con letras
        ]);

        $response->assertSessionHasErrors('Fecha_nacimiento'); // Verifica que se muestre un error de validación para el campo Fecha_nacimiento
        $this->assertContains('La fecha de nacimiento debe ser mayor a 1958', session('errors')->get('Fecha_nacimiento')); //Verifica el mensaje de error
    }

    public function test_validacion_no_letras_en_telefono_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        
        $cliente = Cliente::factory()->create();

        $response = $this->post('/registroempleados', [
            'Numero_telefono' => '8876ABCD', // Teléfono con letras
        ]);

        $response->assertSessionHasErrors('Numero_telefono'); // Verifica que se muestre un error de validación para el campo Numero_telefono
        $this->assertContains('El teléfono solo debe contener números y empezar con 2, 3, 8 o 9', session('errors')->get('Numero_telefono')); // Verifica el mensaje de error
    }

    public function test_validacion_no_simbolo_en_telefono_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        
        $cliente = Cliente::factory()->create();

        $response = $this->post('/registroempleados', [
            'Numero_telefono' => '########', // Teléfono con simbolos
        ]);

       $response->assertSessionHasErrors('Numero_telefono'); // Verifica que se muestre un error de validación para el campo Numero_telefono
       $this->assertContains('El teléfono solo debe contener números y empezar con 2, 3, 8 o 9', session('errors')->get('Numero_telefono')); // Verifica el mensaje de error
    }

    public function test_validacion_min_en_telefono_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        
        $cliente = Cliente::factory()->create();

        $response = $this->post('/registroempleados', [
            'Numero_telefono' => '87', // Teléfono con simbolos
        ]);

       $response->assertSessionHasErrors('Numero_telefono'); // Verifica que se muestre un error de validación para el campo Numero_telefono
       $this->assertContains('El número de teléfono debe  tener minimo 8 números', session('errors')->get('Numero_telefono')); // Verifica el mensaje de error
    }

    public function test_validacion_max_en_telefono_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        
        $cliente = Cliente::factory()->create();

        $response = $this->post('/registroempleados', [
            'Numero_telefono' => '876565458', // Teléfono con simbolos
        ]);

       $response->assertSessionHasErrors('Numero_telefono'); // Verifica que se muestre un error de validación para el campo Numero_telefono
       $this->assertContains('El número de teléfono debe  tener máximo  8 números', session('errors')->get('Numero_telefono')); // Verifica el mensaje de error
    }

    public function test_validacion_anio_invalido_en_fecha_contrato()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Fecha_contrato' => '1888-04-02', // fecha contrato invalido
        ]);

        $response->assertSessionHasErrors('Fecha_contrato'); // Verifica que se muestre un error de validación para el campo Fecha_contrato
        $this->assertContains('La fecha de contrato debe ser después de la fecha actual', session('errors')->get('Fecha_contrato')); //Verifica el mensaje de error
    }

    public function test_validacion_texto_en_salario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Salrio' => '2text', // salario con letras
        ]);

        $response->assertSessionHasErrors('Salrio'); // Verifica que se muestre un error de validación para el campo Salrio
        $this->assertContains('El salario solo debe contener números', session('errors')->get('Salrio')); //Verifica el mensaje de error
    }

    public function test_validacion_simbolo_en_salario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Salrio' => '*&^%$@', // salario con simbolo
        ]);

        $response->assertSessionHasErrors('Salrio'); // Verifica que se muestre un error de validación para el campo Salrio
        $this->assertContains('El salario solo debe contener números', session('errors')->get('Salrio')); //Verifica el mensaje de error
    }

    public function test_validacion_min_en_salario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Salrio' => '0.00001', // salario con letras
        ]);

        $response->assertSessionHasErrors('Salrio'); // Verifica que se muestre un error de validación para el campo Salrio
        $this->assertContains('El salario  debe ser mayor a 5,000 Lps.', session('errors')->get('Salrio')); //Verifica el mensaje de error
    }

    public function test_validacion_max_en_salario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Salrio' => '500000000000000000000', // salario con letras
        ]);

        $response->assertSessionHasErrors('Salrio'); // Verifica que se muestre un error de validación para el campo Salrio
        $this->assertContains('El salario no debe ser mayor a 25,000 Lps.', session('errors')->get('Salrio')); //Verifica el mensaje de error
    }

    public function test_validacion_negativo_en_salario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Salrio' => '-1000', // salario con letras
        ]);

        $response->assertSessionHasErrors('Salrio'); // Verifica que se muestre un error de validación para el campo Salrio
        $this->assertContains('El salario debe ser un valor positivo.', session('errors')->get('Salrio')); //Verifica el mensaje de error
    }

    public function test_validacion_min_en_direccion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Direccion' => 'B', // salario con letras
        ]);

        $response->assertSessionHasErrors('Direccion'); // Verifica que se muestre un error de validación para el campo Direccion
        $this->assertContains('La dirección debe tener minimo 10 caracteres', session('errors')->get('Direccion')); //Verifica el mensaje de error
    }

    public function test_validacion_max_en_direccion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/registroempleados', [
            'Direccion' => 'bqwertyuioplkjhgfdsazcxvbnmjuygtftradtrdtardtrdatrdtradtrdtrdtrdtrdtrdtrdtrdtrdtrd
            ytfyfytfaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', // salario con letras
        ]);

        $response->assertSessionHasErrors('Direccion'); // Verifica que se muestre un error de validación para el campo Direccion
        $this->assertContains('La dirección debe  tener 150 caracteres', session('errors')->get('Direccion')); //Verifica el mensaje de error
    }
}
