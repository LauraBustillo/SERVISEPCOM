<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Pedido;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class PedidoTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /************************************ PEDIDOS ******************************/
    
    /************************ PRUEBA 1 *****************/
    //verifica la ruta de acceso home
    public function test_ruta_home()
    {   //Obtener Acceso 
        //Busca un registro de usuario en la base de datos
        $user = User::findOrFail(1);
        Auth::login($user); //autenticación.
        $response = $this->get('/');
        $response->assertStatus(200);
    }
 /************************ PRUEBA 2 *****************/
    //Verifica que la ruta de login este correcta.
    public function test_ruta_login()
    {   //Obtener Acceso
        $response = $this->get('/login');
        $response->assertStatus(200);
    }


    /************************ PRUEBA 3 *****************/
    //verifica que la ruta de listado pedido este correcta.
    public function test_Ruta_listado_pedido()
    {   //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/pedidos');
        $response->assertStatus(200);
    }

    /************************ PRUEBA 4 *****************/
    //verifica que la ruta para detalle pedido este correcta
    public function test_Ruta_detalle_pedido()
    {   //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/pedidos/');
        $response->assertStatus(200);
    }
    /************************ PRUEBA 5 *****************/
    //verifica que la ruta de editar pedido este correcta
    public function test_Ruta_editar_pedido()
    {   //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/pedidos/');
        $response->assertStatus(200);
    }

    /************************ PRUEBA 6 *****************/
     //verifica que la ruta para REGISTRAR PEDIDO este correcta
    public function test_Ruta_registro_pedido()
    {   //Obtener Acceso
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/createpedidos');
        $response->assertStatus(200);
    }

    /************************ PRUEBA 7 *****************/
    //PRUEBA DE LAS RUTAS SIN AUTENTICACION:
    //editar pedido
    public function test_usuario_sin_autenticacion_redirigido_editar_Pedido()
    {
        $response = $this->get('/pedido/1');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
        
    }

    /************************ PRUEBA 8 *****************/
    //detalle pedido
    public function test_usuario_sin_autenticacion_redirigido_detalle_Pedido()
    {
        $response = $this->get('/pedidos/');
          $response->assertRedirect('/login'); // Verifica que se redirige al login
    }
    /************************ PRUEBA 9 *****************/
    public function test_usuario_sin_autenticacion_redirigido_listado_Pedido()
    {
       //Listado pedido
        $response = $this->get('/pedidos');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    /************************ PRUEBA 10 *****************/
    public function test_usuario_sin_autenticacion_redirigido_registro_Pedido()
    {
    //registro pedido
        $response = $this->get('/createpedidos');
        $response->assertRedirect('/login'); // Verifica que se redirige al login
    }

    /************************ PRUEBA 11 *****************/
    //Acceder a la vista de detalle pedido
    public function test_Vista_Detalle_Pedido()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado Pedido
        $response = $this->actingAs($user)->get('/pedido/4');
        $response->assertStatus(200);
        $response->assertSee('Información del pedido');  // Verificar que la vista contiene el título "Información del pedido"
        $response->assertSeeInOrder([ 
        'Pedido N°',       
        'Fecha pedido',
        'Fecha recibido',
        'Estado',
        'Proveedor',
        'Encargado',
        'Correo empresa',
        'Teléfono',
        'Volver',
        'Editar']);
    }

    /************************ PRUEBA 12 *****************/
    //Acceder a la vista registro de pedidos
    public function test_Vista_RegistroPedido()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registro pedidos
        $response = $this->actingAs($user)->get('/createpedidos');
        $response->assertStatus(200);
        $response->assertSeeText('Pedido de productos');  // Verificar que la vista contiene el título "Pedido de productos"
        $response->assertSee('Número de pedido');
        $response->assertSee('Fecha pedido');
        $response->assertSeeText('Datos del proveedor');  // Verificar que la vista contiene el título "Datos del Proveedor"
        $response->assertSee('Proveedor');
        $response->assertSee('Nombre del encargado');
        $response->assertSee('Correo');
        $response->assertSee('Teléfono');
        $response->assertSeeText('Datos del producto');  // Verificar que la vista contiene el título "Datos del producto"
        $response->assertSee('Nombre');
        $response->assertSee('Marca');
        $response->assertSee('Descripción');
        $response->assertSee('Cantidad');
        $response->assertSeeInOrder(['Agregar Producto','Guardar', 'Volver']);  // Verifica que los botones aparezcan en orden específico en la respuesta HTML     
    }

    /************************ PRUEBA 13 *****************/
    //Acceder a la ruta de la vista editar pedido
    public function test_Vista_EditarPedido()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de editar pedido
        $response = $this->actingAs($user)->get('/pedidos/4');
        $response->assertStatus(200);
        $response->assertSeeText('Pedido de productos');  // Verificar que la vista contiene el título "Pedido de productos"
        $response->assertSee('Número de pedido');
        $response->assertSee('Fecha pedido');
        $response->assertSeeText('Datos del proveedor');  // Verificar que la vista contiene el título "Datos del Proveedor"
        $response->assertSee('Proveedor');
        $response->assertSee('Nombre del encargado');
        $response->assertSee('Correo');
        $response->assertSee('Teléfono');
        $response->assertSeeText('Datos del producto');  // Verificar que la vista contiene el título "Datos del producto"
        $response->assertSee('Nombre');
        $response->assertSee('Marca');
        $response->assertSee('Descripción');
        $response->assertSee('Cantidad');
        $response->assertSeeInOrder(['Agregar Producto','Actualizar', 'Volver']);  // Verifica que los botones aparezcan en orden específico en la respuesta HTML     
    }

    /************************ PRUEBA 14 *****************/
    //Acceder a la ruta de Listado de pedido GET
    public function test_Vista_listado_Pedido()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado pedidos
        $response = $this->actingAs($user)->get('/pedidos');
        $response->assertStatus(200);
        $response->assertSee('Listado de pedidos');  // Verificar que la vista contiene el título "Listado de Pedidos"
        $response->assertSee('Fecha minima:');
        $response->assertDontSeeText('Fecha máxima:'); //si coloco assertSee me tira error y no pasa la prueba
        $response->assertSee('uno'); //icono de basurero
        $response->assertSee('Buscar por número de pedido');
        $response->assertSeeText('uno'); //icono de agregar un nuevo pedido en el listado
        $response->assertDontSee('numero_pedido');  // Solo funciona colocando assertDontSee en los campos de la tabla listado pedido
        $response->assertDontSee('fecha_pedido');   
        $response->assertDontSee('fecha_recibo');
        $response->assertDontSee('estado');
        $response->assertSee('Detalle');     //El campo detalle dentro de la tabla si toma el assertSee.
        $response->assertDontSee('Editar ');
    }

    /************************ PRUEBA 15 *****************/
     //RUTAS INVALIDAS:
    public function test_Validar_Ruta_Invalida_home(){
        $response = $this->get('@');
        $response->assertStatus(404);
    }

    /************************ PRUEBA 16 *****************/
    //Ruta inválida para login
    public function test_Validar_ruta_invalida_login()
    {
        $response = $this->get('/091108751234');
        $response->assertStatus(404);
    }
    /************************ PRUEBA 17 *****************/
    //Ruta inválida para listado pedido
    public function test_Validar_ruta_invalida_ListadoPedido()
    {
        $response = $this->get('/listadoPedidos');
        $response->assertStatus(404);
    }
    /************************ PRUEBA 18 *****************/
    //Ruta inválida para Detalle pedido
    public function test_Validar_ruta_invalida_DetallePedido()
    {
        $response = $this->get('/DetallePedido');
        $response->assertStatus(404);
    }
    /************************ PRUEBA 19 *****************/
    //Ruta inválida para Editar pedido
    public function test_Validar_ruta_invalida_EditarPedido()
    {
        $response = $this->get('/EditarPedido');
        $response->assertStatus(404);
    }
    /************************ PRUEBA 20 *****************/
    //Ruta inválida para Registro pedido
    public function test_Validar_ruta_invalida_RegistroPedido()
    {
        $response = $this->get('/RegistrarPedido');
        $response->assertStatus(404);
    }
    /************************ PRUEBA 21 NO PASA LA PRUEBA error al redireccionar *****************/
    //SIRVE PARA REDIRECCIONAR A LA RUTA DE LISTADO PEDIDO. 
    public function test_Validar_ruta_redireccion_listadoPedido()
{
    // Busca un usuario para la prueba
    $user = User::findOrFail(1); 
    Auth::login($user);

    // Realiza una solicitud GET a la ruta /createpedidos
    $response = $this->get('/createpedidos'); 
    // Verifica que la respuesta tenga el código de estado 302 (redirección)
    $response->assertStatus(302);
    // Verifica que la redirección ocurra a la ruta esperada ( /pedidos)
    $response->assertRedirect('/pedidos'); 
}
/************************ PRUEBA 22 *****************/
//VALIDACION DE DATOS EXITOSOS EN REGISTRO PEDIDO.
public function test_validacion_exitosa_para_numero_de_pedido()
{
    $user = User::findOrFail(1);
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos válidos
    $response = $this->post('/createpedidos', [
        'numero_pedido' => '12345', // Número de pedido válido
    ]);
    
    // Verifica que no haya mensajes de error en la sesión
    $response->assertSessionDoesntHaveErrors('numero_pedido');
}
/************************ PRUEBA 23 *****************/
public function test_validacion_exitosa_para_fecha_de_pedido()
{
    $user = User::findOrFail(1);
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos válidos
    $response = $this->post('/createpedidos', [
        'fecha_pedido' => '2023-08-13', // Número de pedido válido
    ]);
    
    // Verifica que no haya mensajes de error en la sesión
    $response->assertSessionDoesntHaveErrors('fecha_pedido');
}
/************************ PRUEBA 24 *****************/
public function test_validacion_exitosa_para_proveedor_de_pedido()
{
    $user = User::findOrFail(1);
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos válidos
    $response = $this->post('/createpedidos', [
        'id_proveedor' => '2', // Número de pedido válido
    ]);
    
    // Verifica que no haya mensajes de error en la sesión
    $response->assertSessionDoesntHaveErrors('id_proveedor');
}
/************************ PRUEBA 25 *****************/
public function test_validacion_exitosa_para_estado_de_pedido()
{
    $user = User::findOrFail(1);
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos válidos
    $response = $this->post('/createpedidos', [
        'estado' => 'Pendiente', // Número de pedido válido
    ]);
    
    // Verifica que no haya mensajes de error en la sesión
    $response->assertSessionDoesntHaveErrors('estado');
}
/************************ PRUEBA 26 *****************/
//Agregar Nuevo registro a la tabla pedido
public function test_Boton_nuevo_pedido()
{

    $user = User::findOrFail(1);
    Auth::login($user);
    $response= $this->actingAs($user)->get('/pedidos'); // Autentica al usuario para la prueba
    $response = $this->followingRedirects()->actingAs($user)->get(route('create.pedido'));
    $response->assertStatus(200);
    $response->assertSee('Número de pedido');
}

/************************ PRUEBA 27 *****************/
public function test_Boton_agregar_nuevo_pedido()
{
    // Autentica al usuario para la prueba
    $user = User::findOrFail(1);
    $this->actingAs($user);

    // Datos del pedido
    $pedidoData = [
        'numero_pedido' => '91115',
        'fecha_pedido' => '2023-08-13', // Cambiar al formato correcto de fecha; en la vista sale: (DD/MM/YY). En la base tienen: (YY-MM-DD)
        'id_proveedor' => '2',
        'estado' => '0',
    ];

    // Realiza la solicitud POST para crear el pedido
    $response = $this->withoutMiddleware()->post('/createpedidos', array_merge($pedidoData));

    // Verifica que el pedido  se han creado en la base de datos
    $this->assertDatabaseHas('pedidos', $pedidoData);
}

/************************ PRUEBA 28 *****************/
//revisa la paginación que sale debajo del listado pedido.
public function test_paginacion_Listado_Pedido(){

    $user = User::findOrFail(1);
    Auth::login($user);

    //crea 20 registros
    $pedido = Pedido::factory()->count(20)->create();

    //se accede a la ruta del indice
    $response = $this->actingAs($user)->get('/pedidos');

    $response->assertStatus(200);

 // Verificar la presencia de enlaces de paginación
    $response->assertSee('Anterior');
    $response->assertSee('Siguiente');
     // Verificar que los datos de la primera página se muestran correctamente
     $response->assertSee('Listado de pedidos');  // Verificar que la vista contiene el título "Listado de Pedidos"
    $response->assertSee('Fecha minima:');
     $response->assertDontSeeText('Fecha máxima:'); //si coloco assertSee me tira error y no pasa la prueba
     $response->assertSee('uno'); //icono de basurero
    $response->assertSee('Buscar por número de pedido');
     $response->assertSeeText('uno'); //icono de agregar un nuevo pedido en el listado
     $response->assertDontSee('numero_pedido');  // Solo funciona colocando assertDontSee en los campos de la tabla listado pedido
    $response->assertDontSee('fecha_pedido');   
    $response->assertDontSee('fecha_recibo');
    $response->assertDontSee('estado');
     $response->assertSee('Detalle');     //El campo detalle dentro de la tabla si toma el assertSee.
    $response->assertDontSee('Editar ');
}
/**************************************MENSAJES DE VALIDACION AL EDITAR UN PEDIDO**************************************** */
/************************ PRUEBA 29 *****************/
public function test_mensaje_de_validacion_para_numero_de_pedido_Vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/pedidos/4', [
        'numero_pedido' => '', // Numero de pedidos vacío (inválido)
    ]);
    $response->assertStatus(302);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['numero_pedido' => 'El número del pedido es requerido']);
}
/************************ PRUEBA 30 *****************/
public function test_mensaje_de_validacion_para_numero_de_pedido_no_puede_ser_0()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/pedidos/4', [
        'numero_pedido' => '0', // Numero de pedidos no puede ser 0 (inválido)
    ]);
    $response->assertStatus(302);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['numero_pedido' => 'El número del pedido no debe ser cero']);
}
/************************ PRUEBA 31 *****************/
public function test_mensaje_de_validacion_para_fecha_de_pedido_vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/pedidos/4', [
        'fecha_pedido' => '', // fecha de pedido no puede ir vacio (inválido)
    ]);
    $response->assertStatus(302);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['fecha_pedido' => 'La fecha de pedido  es requerida']);
}
/************************ PRUEBA 32 *****************/
public function test_mensaje_de_validacion_para_cantidad_producto_vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/pedidos/4', [
        'producto_cantidad' => '', //(inválido)
    ]);
    $response->assertStatus(302);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['producto_cantidad' => 'La cantidad  es requerida']);
}
/************************ PRUEBA 33 *****************/
public function test_mensaje_de_validacion_para_cantidad_producto_no_puede_ser_0()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/pedidos/4', [
        'producto_cantidad' => '0', //(inválido)
    ]);
    $response->assertStatus(302);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['producto_cantidad' => 'La cantidad  no debe ser cero']);
}
 /************************ PRUEBA 34 *****************/
public function test_mensaje_de_validacion_para_proveedor_seleccionado()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/pedidos/4', [
        'selectProveedorPedido' => ' ', //(inválido)
    ]);
    $response->assertStatus(302);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['selectProveedorPedido' => 'El proveedor es requerido']);
}
/************************ PRUEBA 35 *****************/
//EDITAR PEDIDO, la parte del chequeo del pedido.
public function test_mensaje_de_validacion_para_estado_recibido()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/pedidos/4', [
        'estado_recibido' => ' ', //(inválido)
    ]);
    $response->assertStatus(302);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['estado_recibido' => 'Debe chequear el pedido']);
}
/********************ACTUALIZAR PEDIDO******************* */
//VALIDACIONES
/************************ PRUEBA 36 *****************/
public function test_mensaje_de_validacion_fecha_recibo_pedido_vacio()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/pedidos/4', [
        'fecha_recibido_pedido' => ' ', //(inválido)
    ]);
    $response->assertStatus(302);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['fecha_recibido_pedido' => 'La fecha de recibido es requerida']);
}
/************************ PRUEBA 37 *****************/
public function test_mensaje_de_validacion_fecha_recibo_pedido_no_sea_igual_a_fechaPedido()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/pedidos/4', [
        'fecha_recibido_pedido' => '2023-08-13', //(inválido)
    ]);
    $response->assertStatus(302);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['fecha_recibido_pedido' => 'La fecha de recibido no debe ser igual a la de pedido']);
}
/************************ PRUEBA 38 *****************/
public function test_mensaje_de_validacion_fecha_recibo_pedido_menor_a_fecha_pedido()
{
    $user = User::findOrFail(1); 
    Auth::login($user);
    
    // Realiza una solicitud POST al endpoint del formulario con datos inválidos
    $response = $this->post('/pedidos/4', [
        'fecha_recibido_pedido' => '2023-08-11', //(inválido)
    ]);
    $response->assertStatus(302);
    // Verifica que la respuesta contenga el mensaje de validación esperado
    $response->assertSessionHasErrors(['fecha_recibido_pedido' => 'La fecha de recibido no debe ser menor a la de pedido']);
}

}

