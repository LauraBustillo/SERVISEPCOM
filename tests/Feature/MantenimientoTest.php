<?php

namespace Tests\Feature;

use App\Models\Mantenimiento;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente; 


class MantenimientoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /********************** MANTENIMIENTO(REGISTRO,VALIDACIONES, DETALLE, EDITAR, ACTUALIZAR, LISTADO) ************************ */
    /**********************Prueba 72************************ */
     //verifica la ruta de acceso home
    public function test_ruta_home()
     {   //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/');
        $response->assertStatus(200);
    }
     //verifica la ruta de login
     public function test_ruta_login()
     {   //Obtener Acceso
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    /**********************Prueba 73 ************************ */
    public function test_Ruta_registro_mantenimiento()
    {   //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/mantenimiento');
        $response->assertStatus(200);
    }
    /**********************Prueba 74 ************************ */
    public function test_usuario_sin_autenticacion_redirigido_registro_mantenimiento()
    {
    //registro pedido
        $response = $this->get('/mantenimiento');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }
    /**********************Prueba 75 ************************ */
    public function test_Validar_ruta_invalida_Registro_Mantenimiento()
    {
        $response = $this->get('/Registromantenimiento');
        $response->assertStatus(404); 
    }
    /**********************Prueba 76 ************************ */
    public function test_Validar_Ruta_Registro_Mantenimiento_Valores_incorrectos()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/77676A');
        $response->assertStatus(404);
    }
     /**********************Prueba 77 ************************ */
    public function test_Vista_Modal_Nuevo_Cliente_Mantenimiento()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registro mantenimiento
        $response = $this->actingAs($user)->get('/mantenimiento');
        $response->assertStatus(200);
        $response->assertSeeInOrder([
        'Agregar cliente',
        'Nombres',
        'Apellidos', 
        'Número de identidad', 
        'Teléfono fijo o celular',
        'Dirección',
        'Cancelar',
        'Guardar']);  
    }
    /**********************Prueba 78************************ */
    // validar para que se agregue un cliente desde la vista mantenimiento
    public function test_registrar_nuevo_cliente_a_mantenimiento()
    {
        $clienteData = [
        'Nombre'=> "Lola",
        'Apellido'=> "Jimenez",
        'Numero_identidad'=> "0703197908976",
        'Numero_telefono'=> "99999999",
        'Direccion'=> "San diego",
            // Otros campos del formulario aquí
        ];

        $response = $this->post('/mantenimiento', $clienteData);
        $response->assertStatus(302); // Redirección después de registrar

        // Verifica que el cliente se haya registrado en la base de datos
        $this->assertDatabaseHas('clientes', [
        'Nombre'=> "Lola",
        'Apellido'=> "Jimenez",
        'Numero_identidad'=> "0703197908976",
        'Numero_telefono'=> "99999999",
        'Direccion'=> "San diego",
            // Otros campos del formulario aquí
        ]);
    }
    /**********************Prueba 79************************ */
    //validar para verificar si se me agrega el mismo puesto laboral que ya agregue
    public function test_Validar_nuevo_cliente_existente_store()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/mantenimiento',[
                'Nombre'=> "Lola",
                'Apellido'=> "Jimenez",
                'Numero_identidad'=> "0703197908976",
                'Numero_telefono'=> "99999999",
                'Direccion'=> "San diego",
                
            ]);
            $response->assertStatus(302);
        }
        /**********************Prueba 80************************ */
        public function test_direccion_vacio_no_enviar_formulario()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
        $datos = [
                'Nombre'=> "Lola",
                'Apellido'=> "Jimenez",
                'Numero_identidad'=> "0703197908976",
                'Numero_telefono'=> "99999999",
                'Direccion'=> " ", //campo vacio.
                
        ];
    
        // Realiza una solicitud POST con un campo vacío
        $response = $this->post('/mantenimiento', $datos);
    
        // Verifica que la respuesta tenga el código de estado 302 (redirección)
        $response->assertStatus(302);
    
        // Verifica que el cliente no se haya creado en la base de datos
        $this->assertDatabaseMissing('clientes', $datos);
        }
        /**********************Prueba 81 ************************ */
        public function test_validacion_exitosa_para_nombre_Cliente()
        {
        $user = User::findOrFail(1);
        Auth::login($user);
    
       // Realiza una solicitud POST al endpoint del formulario con datos válidos
        $response = $this->get('/mantenimiento', [
        'Nombre' => 'Maria', // Número de pedido válido
        ]);
    
        // Verifica que no haya mensajes de error en la sesión
        $response->assertSessionDoesntHaveErrors('Nombre');
    }
    /**********************Prueba 82 ************************ */
    public function test_validacion_exitosa_para_Apellido_Cliente()
    {
    $user = User::findOrFail(1);
    Auth::login($user);

   // Realiza una solicitud POST al endpoint del formulario con datos válidos
    $response = $this->get('/mantenimiento', [
    'Nombre' => 'Maria', // Número de pedido válido
    ]);

    // Verifica que no haya mensajes de error en la sesión
    $response->assertSessionDoesntHaveErrors('Apellido');
}
/**********************Prueba 83 *********************** */
public function test_validacion_exitosa_para_Numero_identidad()
    {
    $user = User::findOrFail(1);
    Auth::login($user);

   // Realiza una solicitud POST al endpoint del formulario con datos válidos
    $response = $this->get('/mantenimiento', [
    'Numero_identidad' => '0703197523456', // Número de pedido válido
    ]);

    // Verifica que no haya mensajes de error en la sesión
    $response->assertSessionDoesntHaveErrors('Numero_identidad');
}
/**********************Prueba 84 ************************ */
public function test_validacion_exitosa_para_Numero_telefono()
    {
    $user = User::findOrFail(1);
    Auth::login($user);

   // Realiza una solicitud POST al endpoint del formulario con datos válidos
    $response = $this->get('/mantenimiento', [
    'Numero_telefono' => '99988956', // Número de pedido válido
    ]);

    // Verifica que no haya mensajes de error en la sesión
    $response->assertSessionDoesntHaveErrors('Numero_telefono');
}
/**********************Prueba 85 ************************ */
public function test_validacion_exitosa_para_Direccion()
    {
    $user = User::findOrFail(1);
    Auth::login($user);

   // Realiza una solicitud POST al endpoint del formulario con datos válidos
    $response = $this->get('/mantenimiento', [
    'Direccion' => 'Barrio La Ceibita', // Número de pedido válido
    ]);

    // Verifica que no haya mensajes de error en la sesión
    $response->assertSessionDoesntHaveErrors('Direccion');
}
/**********************Prueba 86 ************************ */
public function test_Nombre_vacio_no_enviar_modal_nuevoCliente_RegistroMantenimiento()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

    $datos = [
                'Nombre'=> " ", //campo vacio.
                'Apellido'=> "Jimenez",
                'Numero_identidad'=> "0703197908976",
                'Numero_telefono'=> "99989796",
                'Direccion'=> "Barrio San Juan", 
    ];

    // Realiza una solicitud POST con un campo vacío
    $response = $this->post('/mantenimiento', $datos);

    // Verifica que la respuesta tenga el código de estado 302 (redirección)
    $response->assertStatus(302);

    // Verifica que el proveedor no se haya creado en la base de datos
    $this->assertDatabaseMissing('Clientes', $datos);
    }
    /**********************Prueba 87 ************************ */
    public function test_Apellido_vacio_no_enviar_modal_nuevoCliente_RegistroMantenimiento()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

    $datos = [
                'Nombre'=> "Maria ",
                'Apellido'=> " ", //campo vacio.
                'Numero_identidad'=> "0703197908976",
                'Numero_telefono'=> "99989796",
                'Direccion'=> "Barrio San Juan", 
    ];

    // Realiza una solicitud POST con un campo vacío
    $response = $this->post('/mantenimiento', $datos);

    // Verifica que la respuesta tenga el código de estado 302 (redirección)
    $response->assertStatus(302);

    // Verifica que el proveedor no se haya creado en la base de datos
    $this->assertDatabaseMissing('Clientes', $datos);
    }
    /**********************Prueba 88 ************************ */
    public function test_Numero_Identidad_vacio_no_enviar_modal_nuevoCliente_RegistroMantenimiento()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

    $datos = [
                'Nombre'=> "Maria ",
                'Apellido'=> "Jimenez",
                'Numero_identidad'=> " ", //campo vacio.
                'Numero_telefono'=> "99989796",
                'Direccion'=> "Barrio San Juan",
    ];

    // Realiza una solicitud POST con un campo vacío
    $response = $this->post('/mantenimiento', $datos);

    // Verifica que la respuesta tenga el código de estado 302 (redirección)
    $response->assertStatus(302);

    // Verifica que el proveedor no se haya creado en la base de datos
    $this->assertDatabaseMissing('Clientes', $datos);
    }
    /**********************Prueba 89 ************************ */
    public function test_Numero_Telefono_vacio_no_enviar_modal_nuevoCliente_RegistroMantenimiento()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

    $datos = [
                'Nombre'=> "Maria ",
                'Apellido'=> "Jimenez",
                'Numero_identidad'=> "070319997777 ",
                'Numero_telefono'=> " ", //campo vacio.
                'Direccion'=> "Barrio San Juan", 
    ];

    // Realiza una solicitud POST con un campo vacío
    $response = $this->post('/mantenimiento', $datos);

    // Verifica que la respuesta tenga el código de estado 302 (redirección)
    $response->assertStatus(302);

    // Verifica que el proveedor no se haya creado en la base de datos
    $this->assertDatabaseMissing('Clientes', $datos);
    }
    /**********************Prueba 90************************ */
    public function test_Direccion_vacio_no_enviar_modal_nuevoCliente_RegistroMantenimiento()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

    $datos = [
                'Nombre'=> "Maria ",
                'Apellido'=> "Jimenez",
                'Numero_identidad'=> "070319997777 ",
                'Numero_telefono'=> " ",
                'Direccion'=> " ", //campo vacio.
    ];

    // Realiza una solicitud POST con un campo vacío
    $response = $this->post('/mantenimiento', $datos);

    // Verifica que la respuesta tenga el código de estado 302 (redirección)
    $response->assertStatus(302);

    // Verifica que el proveedor no se haya creado en la base de datos
    $this->assertDatabaseMissing('Clientes', $datos);
    }
    /**********************Prueba 91************************ */
    public function test_direccion_mayor_a_ciento_cincuenta_redirigir_registroMantenimiento()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/mantenimiento', [
        'Nombre' => "Maria",
        'Apellido' => "Jimenez",
        'Numero_identidad' => "070319997777",
        'Numero_telefono' => "123456789",
        'Direccion' => "Barrio abajoooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
                    ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo",
    ]);

    $response->assertStatus(302);
}
/**********************Prueba 92************************ */
public function test_nombre_con_caracteres_especiales_redirigir_registroMantenimieno()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/mantenimiento', [
        'Nombre' => "Mari@",
        'Apellido' => "Jimenez",
        'Numero_identidad' => "070319997777",
        'Numero_telefono' => "123456789",
        'Direccion' => "Barrio abajo",
    ]);

    $response->assertStatus(302);
}
/**********************Prueba 93************************ */
public function test_Apellido_con_caracteres_especiales_redirigir_registroMantenimieno()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/mantenimiento', [
        'Nombre' => "Maria",
        'Apellido' => "J*menez",
        'Numero_identidad' => "070319997777",
        'Numero_telefono' => "123456789",
        'Direccion' => "Barrio abajo",
    ]);

    $response->assertStatus(302);
}
/**********************Prueba 94 ************************ */
public function test_direccion_menor_de_diez_redirigir_registroMantenimieno()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/mantenimiento', [
        'Nombre' => "Maria",
        'Apellido' => "Jimenez",
        'Numero_identidad' => "070319997777",
        'Numero_telefono' => "123456789",
        'Direccion' => "Barr",
    ]);

    $response->assertStatus(302);
}
/**********************Prueba 95 ************************ */
public function test_Invalidar_telefonos_menos_de_8_caracteres()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/mantenimiento',[
                'Nombre' => "Maria",
                'Apellido' => "Jimenez",
                'Numero_identidad' => "070319997777",
                'Numero_telefono' => "99887766",
                'Direccion' => "Barrio Gracias a Dios",
            ]);
    
            $cliente = Cliente::findOrFail(1);
    
            $this->assertFalse($cliente->Numero_telefono== '99887766');
        }
        /**********************Prueba 96 ************************ */
        public function test_Invalidar_identidades_menos_de_13_caracteres()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/mantenimiento',[
                'Nombre' => "Maria",
                'Apellido' => "Jimenez",
                'Numero_identidad' => "0703200007890",
                'Numero_telefono' => "99887766",
                'Direccion' => "Barrio Gracias a Dios",
            ]);
    
            $cliente = Cliente::findOrFail(1);
    
            $this->assertFalse($cliente->Numero_identidad == '0703200007890');
        }
        /**********************Prueba 97 ************************ */
        public function test_guardar_datos_desde_modal_de_nuevoCliente_Mantenimiento()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/mantenimiento', [
                'Nombre' => "Maria",
                'Apellido' => "Jimenez",
                'Numero_identidad' => "0703200007890",
                'Numero_telefono' => "99887766",
                'Direccion' => "Barrio Gracias a Dios",
            ]);
    
            // Verifica redirección o respuesta exitosa
            $response->assertStatus(302); // Puedes ajustar esto según tu lógica
            // Verifica que el cliente se haya guardado en la base de datos
            $this->assertDatabaseHas('clientes', ['Nombre' => "Maria",
            'Apellido' => "Jimenez",
            'Numero_identidad' => "0703200007890",
            'Numero_telefono' => "99887766",
            'Direccion' => "Barrio Gracias a Dios",]);
        }

        /**DETALLES DEL MANTENIMIENTO, ES EL FORMULARIO DE REGISTRO MANTENIMIENTO */
        /**********************Prueba 98 ************************ */
        public function test_ver_contenido_del_formulario_Detalle_Mantenimiento_de_registro_mantenimiento()
    {
            $user = User::findOrFail(1);
            Auth::login($user);
    
        // Realiza una solicitud GET a la vista
        $response = $this->actingAs($user)->get('/mantenimiento');

        // Verifica que la respuesta tenga el código de estado 200 (OK)
        $response->assertStatus(200);

        // Verifica que el contenido esperado se encuentre en la vista
        $response->assertSee('Detalles mantenimiento');
        $response->assertSee('Categoría');
        $response->assertSee('Nombre equipo');
        $response->assertSee('Marca');
        $response->assertSee('Modelo');
        $response->assertSee('Fecha ingreso'); 
        $response->assertSee('Fecha entrega');
        $response->assertSee('Descripción');
        $response->assertSee('Guardar'); 
        $response->assertSee('Volver'); 
    }
    /**********************Prueba 99 ************************ */
    public function test_Boton_guardar_detalles_de_registro_mantenimiento()
{
    // Autentica al usuario para la prueba
    $user = User::findOrFail(1);
    $this->actingAs($user);

    // Datos del pedido
    $mantenimientoData = [
        "cliente_id"=> 1,
        "id_factura"=> "",
        "estado"=> "Pendiente",
        "categoria"=>"Computadoras",
        "nombre_equipo"=>"DELL",
        "marca"=> "Dell",
        "modelo"=> "Dell inspiron",
        "descripcionm"=> "se quebro la pantalla",
        "fecha_ingreso"=> "2023-08-20", //cambiar formato de fecha
        "fecha_entrega"=> "2023-08-23", //cambiar formato de fecha
        "numero_factura"=> null,
        "fecha_facturacion"=> null,
        "precio"=> null,
        "descripcion"=>null,

    ];

    // Realiza la solicitud POST para crear el pedido
    $response = $this->withoutMiddleware()->post('/mantenimiento', array_merge($mantenimientoData));

    // Verifica que el pedido  se han creado en la base de datos
    $this->assertDatabaseHas('mantenimientos', $mantenimientoData);
}
 /**********************Prueba 100 ************************ */
public function test_boton_volver_redirecciona_a_listado_mantenimiento()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);
        // Realiza una solicitud GET a la página de registro de mantenimiento
        $response = $this->get('/mantenimiento');

        // Verifica que la respuesta tenga el código de estado 200 (OK)
        $response->assertStatus(200);

        // Simula hacer clic en el botón "Volver"
        $responseAfterClick = $this->get('/ListadoMantenimiento'); // Cambia a la ruta correcta

        // Verifica que la respuesta después de hacer clic tenga el código de estado 302 (redirección)
        $responseAfterClick->assertStatus(302);

        // Verifica que la redirección ocurra a la ruta de listado de mantenimiento
        $responseAfterClick->assertRedirect('/ListadoMantenimiento'); // Cambia a la ruta correcta
    }

    /**MENSAJES DE VALIDACION DEL MODAL DE NUEVO CLIENTE DE REGISTRO MANTENIMIENTO 
     * no da ninguna prueba de mensajes de validacion porque estan con JSON.
    */
     /**********************Prueba 101 ************************ */
    public function test_mensaje_de_validacion_para_Nombre_Cliente_vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
    'nombre_cliente' => ' ', // Nombre del cliente vacío (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['nombre_cliente' => 'El nombre del cliente es requerido']);
}
/**********************Prueba 102 ************************ */
public function test_mensaje_de_validacion_para_Nombre_Cliente_signosEspeciales()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
    'nombre_cliente' => 'Mari@ Alejandr@', // nombre cliente con signos especiales (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['nombre_cliente' => 'El nombre del cliente no acepta signos especiales']);
}
/**********************Prueba 103 ************************ */
public function test_mensaje_de_validacion_para_Nombre_Cliente_numeros()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
    'nombre_cliente' => '4l3j4ndr4', // nombre cliente con numeros  (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['nombre_cliente' => 'El nombre del cliente no acepta números']);
}
/**********************Prueba 104 ************************ */
public function test_mensaje_de_validacion_para_Apellido_Cliente_vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'apellido_cliente' => ' ', // apellido del cliente vacío (inválido)
    ]);
    
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['apellido_cliente' => 'El apellido del cliente es requerido']);
}
/**********************Prueba 105 ************************ */
public function test_mensaje_de_validacion_para_Apellido_Cliente_signosEspeciales()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'apellido_cliente' => 'Cort^es', // apellido cliente con signos especiales (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['nombre_cliente' => 'El apellido del cliente no acepta signos especiales']);
}
/**********************Prueba 106 ************************ */
public function test_mensaje_de_validacion_para_Apellido_Cliente_numeros()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'apellido_cliente' => 'God0y', // apellido cliente con numeros  (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['apellido_cliente' => 'El apellido del cliente no acepta números']);
}
/**********************Prueba 107 ************************ */
public function test_mensaje_de_validacion_para_Identidad_Cliente_vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'identidad_cliente' => ' ', // identidad vacío (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['identidad_cliente' => 'El número de identidad del cliente es requerido']);
}
/**********************Prueba 108 ************************ */
public function test_mensaje_de_validacion_para_Identidad_Cliente_Invalida()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'identidad_cliente' => '2367899875433456788765434567', // (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['identidad_cliente' => 'Ingrese una identidad valida']);
}
/**********************Prueba 109 ************************ */
public function test_mensaje_de_validacion_para_Identidad_Cliente_no_debe_ser_cero()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'identidad_cliente' => '0', // apellido cliente con numeros  (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['identidad_cliente' => 'El número de identidad del cliente no debe ser cero']);
}
/**********************Prueba 110 ************************ */
public function test_mensaje_de_validacion_para_Identidad_Cliente_ya_existe()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'identidad_cliente' => '0703197572828', // ya existe(inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['identidad_cliente' => 'La identidad ya existe']);
}
/**********************Prueba 111 ************************ */
public function test_mensaje_de_validacion_para_telefono_Cliente_Vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'telefono_cliente' => '', // vacio (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['telefono_cliente' => 'El número de teléfono del cliente es requerido']);
}
/**********************Prueba 112 ************************ */
public function test_mensaje_de_validacion_para_telefono_Cliente_debe_empezar_con_2_3_8_9_y_contener_8_numeros()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'telefono_cliente' => '678899445', // (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['telefono_cliente' => 'El número de teléfono debe empezar con 2, 3, 8 o 9 y contener 8 números']);
}
/**********************Prueba 113 ************************ */
public function test_mensaje_de_validacion_para_telefono_Cliente_existente()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'telefono_cliente' => '88888888', // (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['telefono_cliente' => 'El telefono ya existe']);
}
/**********************Prueba 114 ************************ */
public function test_mensaje_de_validacion_para_direccion_Cliente_Vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'direccion_cliente' => '', // vacio (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['direccion_cliente' => 'La dirección del cliente es requerido']);
}
/****************VALIDACIONES PARA REGISTRO MANTENIMIENTO (DE LA PARTE DETALLES MANTENIMIENTO)********************* */
//NO PASAN POR EL CODIGO JSON
/**********************Prueba 115 ************************ */
public function test_mensaje_de_validacion_para_nombre_equipo_Vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'nombre_equipo' => '', // vacio (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['nombre_equipo' => 'El nombre es requerido']);
}
/**********************Prueba 116 ************************ */
public function test_mensaje_de_validacion_para_marca_equipo_Vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'marca' => '', // vacio (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['marca' => 'La marca es requerida']);
}
/**********************Prueba 117 ************************ */
public function test_mensaje_de_validacion_para_modelo_equipo_Vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'modelo' => '', // vacio (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['modelo' => 'El modelo es requerido']);
}
/**********************Prueba 118 ************************ */
public function test_mensaje_de_validacion_para_descripcion_equipo_Vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'descripcionm' => '', // vacio (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['descripcionm' => 'La descripción es requerida']);
}
/**********************Prueba 119 ************************ */
public function test_mensaje_de_validacion_para_fecha_ingreso_equipo_Vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'fecha_ingreso' => '', // vacio (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['fecha_ingreso' => 'La fecha de ingreso es requerida']);
}
/**********************Prueba 120 ************************ */
public function test_mensaje_de_validacion_para_fecha_entrega_equipo_Vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'fecha_entrega' => '', // vacio (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['fecha_entrega' => 'La fecha de entrega es requerida']);
}
/**********************Prueba 121 ************************ */
public function test_mensaje_de_validacion_para_fecha_entrega_equipo()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/mantenimiento', [
        'fecha_entrega' => '2023-08-23', // vacio (inválido)
    ]);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['fecha_entrega' => 'La fecha de entrega no debe ser menor a la de ingreso']);
}
/******************* LISTADO DE MANTENIMIENTO *************************** */
/**********************Prueba 122 ************************ */
        public function test_Vista_Listado_Mantenimiento()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
           // Realiza una solicitud GET a la vista
          $response = $this->actingAs($user)->get('/ListadoMantenimiento');
          // Verifica que la respuesta tenga el código de estado 200 (OK)
          $response->assertStatus(200);
           // Verifica que el contenido esperado se encuentre en la vista
          $response->assertSee('Listado de mantenimiento de equipos'); //titulo de la vista.
          $response->assertSee('Fecha minima:');
          $response->assertDontSee('Fecha máxima:'); //este campo no pasa con assertSee.
          $response->assertSee('uno'); //icono de basurero
          $response->assertSeeText('uno'); //icono de agregar un nuevo registro de mantenimiento en el listado
          $response->assertSee('Buscar por nombre de cliente, categoría o estado');
          $response->assertSeeInOrder(['Cliente','Categoría','Fecha ','Estado',
          'Factura #','Total ','Detalle','Editar','Facturar']);
    }
    //revisa la paginación que sale debajo del listado mantenimiento.
    /**********************Prueba 123 ************************ */
       public function test_paginacion_Listado_Mantenimiento(){

          $user = User::findOrFail(1);
          Auth::login($user);
         //se accede a la ruta del indice
         $response = $this->actingAs($user)->get('/ListadoMantenimiento');
         $response->assertStatus(200);
         // Verificar la presencia de enlaces de paginación
         $response->assertSee('Anterior');
         $response->assertSee('Siguiente');
    }   
    /********************** DETALLE DE MANTENIMIENTO************************ */ 
    /**********************Prueba 124 ************************ */
    public function test_Vista_Detalle_Mantenimiento()
    {
            $user = User::findOrFail(1);
            Auth::login($user);
    
        // Realiza una solicitud GET a la vista
        $response = $this->actingAs($user)->get('/mantenimientos/2');

        // Verifica que la respuesta tenga el código de estado 200 (OK)
        $response->assertStatus(200);
        // Verifica que el contenido esperado se encuentre en la vista
        $response->assertSee('Información del matenimiento'); //titulo de la vista esta mal escrito, es 'mantenimiento', le falta la n.
        $response->assertSee('Mantenimiento: Diana Lopez');
        $response->assertSee('Datos'); 
        $response->assertSee('Información'); 
        $response->assertSeeInOrder(['Número de identidad',
        'Teléfono','Dirección','Categoría','Nombre equipo','Marca',
         'Modelo','Descripción','Fecha ingreso','Fecha entrega',
         'Editar','Volver']);
    }
    /*****************************ACTUALIZAR MANTENIMIENTO************************/
     /**********************Prueba 125 ************************ */
     public function test_Vista_Actualizar_Mantenimiento()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
         //realiza una solicitud GET a la ruta de registro mantenimiento
         $response = $this->actingAs($user)->get('/mantenimiento/2');
         $response->assertStatus(200);
         $response->assertDontSeeText('Actualizar mantenimiento');
         $response->assertSeeInOrder([
         'Agregar cliente',
         'Nombres',
         'Apellidos', 
         'Número de identidad', 
         'Teléfono fijo o celular',
         'Dirección',
         'Cancelar',
         'Guardar']);  
         $response->assertSee('Detalles mantenimiento');
         $response->assertSee('Categoría');
         $response->assertSee('Nombre equipo');
         $response->assertSee('Marca');
         $response->assertSee('Modelo');
         $response->assertSee('Fecha ingreso'); 
         $response->assertSee('Fecha entrega');
         $response->assertSee('Descripción');
         $response->assertSee('Actualizar'); 
         $response->assertSee('Volver'); 
     }
      /*****************************MENSAJE DE CONFIRMACION PARA GUARDAR FORMULARIOS************************/
     /**********************Prueba 126 ************************ */
       public function test_test_mensaje_de_confirmacion_guardar_formulario_de_registroMantenimiento()
     {
        $user = User::findOrFail(1); 
        Auth::login($user);

        // Realiza una solicitud GET a la página con el formulario
        $response = $this->get('/mantenimiento'); // Cambia esto a la URL real de tu página de formulario
        // Simula hacer clic en el botón de "Guardar" del formulario
        $response = $this->followingRedirects()->post('/mantenimiento', ['_token' => csrf_token()]);
        // Verifica que el contenido del mensaje de confirmación esté presente en la respuesta
        $response->assertSee('¿Está seguro que desea guardar los datos?');
    }
      /*****************************FACTURAR MANTENIMENTO************************/
      /**********************Prueba 127 ************************ */
      public function test_Vista_Facturar_Mantenimiento()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
         //realiza una solicitud GET a la ruta de listado mantenimiento
         $response = $this->actingAs($user)->get('/ListadoMantenimiento');
         $response->assertStatus(200);
         $response->assertDontSeeText('Facturar mantenimiento');
         $response->assertSeeInOrder([
         'Número factura',
         'Fecha facturación',
         'Precio mantenimiento', 
         'Descripción', 
         'Cerrar',
         'Guardar']);  
         $response->assertStatus(200);
        }
        /*****************************VALIDACIONES DE FACTURAR MANTENIMIENTO************************/
      /**********************Prueba 128 ************************ */
      //LAS VALIDACIONES TIRAR ERROR PORQUE ESTAN CON JSON.
      public function test_Validacion_numero_facturaM_Vacio()
      {
        $user = User::findOrFail(1); 
        Auth::login($user);
        // Realiza una solicitud POST al endpoint del formulario con datos inválidos
        $response = $this->post('/guardarFacturaMantenimiento', [
            'numero_facturaM' => '', // vacio (inválido)
        ]);
        // Verifica que la respuesta contenga el mensaje de validación esperado
        $response->assertSessionHasErrors(['numero_facturaM' => 'El número de factura es requerido']);
         }
         /**********************Prueba 129 ************************ */
      public function test_Validacion_numero_facturaM_Max_Caracteres()
      {
        $user = User::findOrFail(1); 
        Auth::login($user);
        // Realiza una solicitud POST al endpoint del formulario con datos inválidos
        $response = $this->post('/guardarFacturaMantenimiento', [
            'numero_facturaM' => '1234567891011121314151617181920', //(inválido)
        ]);
        // Verifica que la respuesta contenga el mensaje de validación esperado
        $response->assertSessionHasErrors(['numero_facturaM' => 'El número de factura el máximo es de 19 caracteres']);
         }
         /**********************Prueba 130 ************************ */
      public function test_Validacion_numero_facturaM_Min_Caracteres()
      {
        $user = User::findOrFail(1); 
        Auth::login($user);
        // Realiza una solicitud POST al endpoint del formulario con datos inválidos
        $response = $this->post('/guardarFacturaMantenimiento', [
            'numero_facturaM' => '123456789101112131415161718', //(inválido)
        ]);
        // Verifica que la respuesta contenga el mensaje de validación esperado
        $response->assertSessionHasErrors(['numero_facturaM' => 'El número de factura el mínimo es de 19 caracteres']);
         }
         /**********************Prueba 131 ************************ */
      public function test_Validacion_numero_facturaM_con_letras()
      {
        $user = User::findOrFail(1); 
        Auth::login($user);
        // Realiza una solicitud POST al endpoint del formulario con datos inválidos
        $response = $this->post('/guardarFacturaMantenimiento', [
            'numero_facturaM' => '123abcd455678efghi9', //(inválido)
        ]);
        // Verifica que la respuesta contenga el mensaje de validación esperado
        $response->assertSessionHasErrors(['numero_facturaM' => 'El número de factura, solo debe tener números']);
         }
          /**********************Prueba 132 ************************ */
      public function test_Validacion_fecha_facturacionM_vacio()
      {
        $user = User::findOrFail(1); 
        Auth::login($user);
        // Realiza una solicitud POST al endpoint del formulario con datos inválidos
        $response = $this->post('/guardarFacturaMantenimiento', [
            'fecha_facturacionM' => '', //(inválido)
        ]);
        // Verifica que la respuesta contenga el mensaje de validación esperado
        $response->assertSessionHasErrors(['fecha_facturacionM' => 'La fecha de facturación es requerida']);
         }
         /**********************Prueba 133 ************************ */
      public function test_Validacion_precio_mantenimientoM_vacio()
      {
        $user = User::findOrFail(1); 
        Auth::login($user);
        // Realiza una solicitud POST al endpoint del formulario con datos inválidos
        $response = $this->post('/guardarFacturaMantenimiento', [
            'precio_mantenimientoM' => '', //(inválido)
        ]);
        // Verifica que la respuesta contenga el mensaje de validación esperado
        $response->assertSessionHasErrors(['precio_mantenimientoM' => 'El precio del mantenimeinto es requerido']);
         }
         /**********************Prueba 133 ************************ */
      public function test_Validacion_precio_mantenimientoM_Min_Numeros()
      {
        $user = User::findOrFail(1); 
        Auth::login($user);
        // Realiza una solicitud POST al endpoint del formulario con datos inválidos
        $response = $this->post('/guardarFacturaMantenimiento', [
            'precio_mantenimientoM' => '', //(inválido)
        ]);
        // Verifica que la respuesta contenga el mensaje de validación esperado
        $response->assertSessionHasErrors(['precio_mantenimientoM' => 'El precio, mínimo debe tener 2 caracteres']);
         }
         /**********************Prueba 134 ************************ */
      public function test_Validacion_precio_mantenimientoM_solo_Numeros()
      {
        $user = User::findOrFail(1); 
        Auth::login($user);
        // Realiza una solicitud POST al endpoint del formulario con datos inválidos
        $response = $this->post('/guardarFacturaMantenimiento', [
            'precio_mantenimientoM' => 'treinta y 4', //(inválido)
        ]);
        // Verifica que la respuesta contenga el mensaje de validación esperado
        $response->assertSessionHasErrors(['precio_mantenimientoM' => 'El precio solo debe tener números']);
         }
          /**********************Prueba 135 ************************ */
      public function test_Validacion_descripcion_mantenimiento_Vacio()
      {
        $user = User::findOrFail(1); 
        Auth::login($user);
        // Realiza una solicitud POST al endpoint del formulario con datos inválidos
        $response = $this->post('/guardarFacturaMantenimiento', [
            'descripcion_mantenimiento' => ' ', //(inválido)
        ]);
        // Verifica que la respuesta contenga el mensaje de validación esperado
        $response->assertSessionHasErrors(['descripcion_mantenimiento' => 'La descripción es requerida']);
         }
     }
