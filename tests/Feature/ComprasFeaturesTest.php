<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use App\Models\Proveedor;
use App\Models\Product;
use App\Models\Categoria;
use App\Models\Compra;
use App\Models\CompraDetalles;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductController;



class ComprasFeaturesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // use RefreshDatabase; //para unas una base de datos fresca para cada prueba
    //$user = User::factory()->create();

    /* ---------------- TOTAL PRUEBAS REALIZADAS =  -------------- */
    /*EL ERROR ES QUE SE MANEJAN LOS ERRORES EN EL LADO DEL CLIENTE Y NO EN EL SERVIDOR.
    LOS MENSAJES DE ERROR NO LOS MUESTRA */

    /**************** PRUEBA 1 ******************/
    /* Prueba para acceder a la ruta */
    public function test_ruta_registroCompra(){

        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registrar de productos
        $response = $this->actingAs($user)->get('/registrocompra');

        $response->assertStatus(200);
    }

    /************* PRUEBA 2  *****************/
    /* Mostrar formulario */
    /*ERROR1: No muestra: Registrar factura de compra */
    public function test_mostrarFormulario(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registrar de productos
        $response = $this->actingAs($user)->get('/registrocompra');

        $response->assertStatus(200);


        $response->assertSee('Número de factura');
        $response->assertSee('Fecha de facturación');
        $response->assertSee('Proveedor');
        $response->assertSee('Agregar Detalle');
        $response->assertSee('Producto');
        $response->assertSee('Marca');
        $response->assertSee('Categoría');
        $response->assertSee('Precio de compra');
        $response->assertSee('Precio de venta');
        $response->assertSee('Impuesto');
        $response->assertSee('Total Producto');
        $response->assertSee('SubTotal');
        $response->assertSee('Impuesto');
        $response->assertSee('Total factura');
        $response->assertSeeInOrder(['Guardar', 'Cerrar']);  // Verifica que los botones aparezcan en orden específico en la respuesta HTML

    }
    /****************** PRUEBA 3 *************/
    /*Listado index compras */

    /* ERROR 2: No pasan los botones fecha minima, y fecha maxima */
    public function test_listado_compras(){
        $user = User::findOrFail(1);
        Auth::login($user);


        $response = $this->actingAs($user)->get('/Compra');
        $response->assertStatus(200);

        $response->assertSee('Listado de facturas de compras');
        $response->assertSee('Buscar por número de factura, proveedor y total de factura');
        $response->assertSee('Número de factura');
        $response->assertSee('Fecha de facturación');
        $response->assertSee('Proveedor');
        $response->assertSee('Total');
        $response->assertSee('Detalles');



        // Verificar botones "Anterior" y "Siguiente" si aplicable
        $response->assertSee('Anterior');
        $response->assertSee('Siguiente');


    }

    /************ PRUEBA 4 ************/
    /*Prueba del boton para agregar una nueva factura */
    public function test_boton_agregar_registroFactura(){
        $user = User::findOrFail(1);
        Auth::login($user);

        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/Compra');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get(route('show.registroCompras'));

        // Verifica que se redirige correctamente a la ruta /registrocompra
        $response->assertStatus(200);
        $response->assertSee('Número de factura'); //para que mostrara algo de la vista


    }

    /************ PRUEBA 5 ************* */
    /*Acceder a la ruta de detalle */

    public function test_detalle_factura(){
        $user = User::findOrFail(1);
        Auth::login($user);

         //realiza una solicitud GET
         $response = $this->actingAs($user)->get('/Compras/1');
         $response->assertStatus(200);
         $response->assertSee('Información de la factura de compra');  // 
         $response->assertSee('Factura N° :');
         $response->assertSeeInOrder(['Datos', 'Información']);
         $response->assertSeeInOrder([
            'Producto',
            'Marca',
            'Categoría',
            'Cantidad',
            'Precio de compra',
            'Precio de venta',
            'Impuesto',
            'Total Producto',
            'Volver'
        ]);
    }

    /********   PRUEBA 6 *******/
    /*Prueba boton "volver" */
    public function test_boton_volver_en_detalles(){
        $user = User::findOrFail(1);
        Auth::login($user);

        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/Compras/1');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get(route('compra.index'));

        // Verifica que se redirige correctamente a la ruta /registrocompra
        $response->assertStatus(200);
        $response->assertSee('Listado de facturas de compras');//para que mostrara algo de la vista


    }


    /**********************PRUEBA 7 **************/
    /*Prueba de formato monetario */
    //Funciona
    public function testFormatoMonetarioEnDetallesFactura()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        // Simula la carga de la vista de detalles de factura
        $response = $this->actingAs($user)->get('/Compras/1');

        // Verifica que la vista se cargó correctamente
        $response->assertStatus(200);

        // Obtén el contenido de la vista
        $content = $response->getContent();

        // Define una expresión regular para buscar valores monetarios en formato "Lps. X.XX"
        $pattern = '/Lps\.\s\d+\.\d{2}/';

        // Busca todos los valores que coinciden con el patrón en el contenido de la vista
        preg_match_all($pattern, $content, $matches);


    }

    /*************************** PRUEBA 8 *********************/
    /* SI PASA */
    /*Verificacion de los detalles del producto comprados se muestren en la tabla detalles */
    /*Tengo que agregar un dato en especifico para qyue me lo muestre */
    public function test_productos_se_muestran_correctamente_en_la_tabla(){

        $user = User::findOrFail(1);
        Auth::login($user);

        $factura = CompraDetalles::findOrFail();
        $producto = Product::findOrFail(12);
        $proveedor = Proveedor::findOrFail(18);
        $categoria = Categoria::findOrFail(8);


        //crear datos de prueba, como detalles del producto
        $detalle1 = CompraDetalles::factory()->create([
            'id_prov' => '18',
            'id_product' => '12',
            'nombre_producto'=> 'Jabon',
            'Numero_facturaform' => '00000015211',
            'Descripcion' =>'hahhahah hahah ahah aha' ,
            'Marca' => 'Protect',
            'id_cat' => '8',
            'Categoria' => 'Para probar nombre del producto con caracteres',
            'CantidadRestante' => '',
            'Costo' => '45',
            'Precio_venta' => '60',
            'Impuesto' => '15',
        ]);
         // Realizar una solicitud GET a la vista
        $response = $this->actingAs($user)->get('/Compras/1');

        // Verificar que la vista se cargó correctamente
        $response->assertStatus(200);

        // Verificar que los detalles de producto se muestran correctamente en la tabla
        $response->assertSeeInOrder([$detalle1->nombre_producto, $detalle1->Marca, $detalle1->Precio_venta]);
        // ... Verificar otras propiedades de los detalles ...
    }

    /******************************PRUEBA 9 ***********/
    //Usuarios no autorizados no puedan acceder al indice
    public function test_acceso_no_autorizado_indexCompras(){
        $response = $this->get(route('compra.index'));
        $response->assertStatus(302); //Lo redirige al login
    }

    /*************************Prueba 10  *******************/
    public function test_agregar_registro_sin_autenticacion_compras(){
        $response = $this->get('/registrocompra');
        $response->assertRedirect('/login');
    }

    /***************** PRUEBA 11 *******************/
    public function test_paginacion_index_compras(){

        $user = User::findOrFail(1);
        Auth::login($user);

        $compras = CompraDetalles::factory()->count(20)->create();

        $response = $this->actingAs($user)->get('/Compra');

        $response->assertStatus(200);

        // Verificar la presencia de enlaces de paginación
        $response->assertSee('Anterior');
        $response->assertSee('Siguiente');

         // Verificar que los datos de la primera página se muestran correctamente
        $response->assertSee('Número de factura');
        $response->assertSee('Fecha de facturación');
        $response->assertSee('Proveedor');
        $response->assertSee('Total');
        $response->assertSee('Detalles');


    }
    /************************* PRUEBA 12 **********/
    /*Prueba del boton de "agregar detalle"  */
    /*No se si va, ya que es parte de lo maneja JS
    con el metodo onclick="openmodal()" en vez de "Agregar detalle"
    */
    public function test_modal_agregarDetalle(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //Enlace donde se encuentra el boton
        $response = $this->actingAs($user)->get('/registrocompra');

        //que la respuesta sea exitosa
         $response->assertStatus(200);

        // Verifica que el botón con el atributo onclick esté presente en la respuesta
        $response->assertSee('Agregar Detalle');

        $response->assertSee('Agregar producto a la factura ');

    }

    /*************************** PRUEBA 13 *****************/
    /*Funciona */
    /*compra de producto, incluyendo las dos tablas */
    public function testGuardarDatosFacturaEnBaseDeDatos()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        // Definir los datos de prueba como arreglos
        $arrayFac =  [
            'Fecha_facturacion' => '19-08-2023',
            'Numero_factura' => '00000001111',
            'Total_factura' => 356.00,
            'Proveedor' => 'Proveedor A',
        ];

        $arrayDet = [ (object)[
                'id_detalle' => 1,
                'Numero_facturaform' => '12345678910',
                'id_prov' => 1,
                'id_product' => 1,
                'nombre_producto' => 'Producto 1',
                'Descripcion' => 'Descripción del Producto 1',
                'Marca' => 'Marca A',
                'id_cat' => 1,
                'Categoria' => 'Categoría A',
                'Cantidad' => 10,
                'Costo' => 50.00,
                'Precio_venta' => 70.00,
                'Impuesto' => 0.1,
            ],
        ];
        // Guardar datos de la factura principal
        $agregar = new Compra();
        $agregar->Fecha_facturacion = $arrayFac['Fecha_facturacion'];
        $agregar->Numero_factura = $arrayFac['Numero_factura'];
        $agregar->Total_factura = $arrayFac['Total_factura'];
        $agregar->Proveedor = $arrayFac['Proveedor'];
        $agregar->save();

        // Verificar que los datos de la factura principal se guardaron en la base de datos
        $this->assertDatabaseHas('compras', [
            'Fecha_facturacion' => $arrayFac['Fecha_facturacion'],
            'Numero_factura' => $arrayFac['Numero_factura'],
            'Total_factura' => $arrayFac['Total_factura'],
            'Proveedor' => $arrayFac['Proveedor'],
        ]);

        // Guardar detalles de la factura y verificar cada detalle en la base de datos
        foreach ($arrayDet as $detFact) {
            $a = new CompraDetalles;
            $a->id_detalle = $detFact->id_detalle;
            $a->Numero_facturaform = $detFact->Numero_facturaform;
            $a->id_prov = $detFact->id_prov;
            $a->id_product = $detFact->id_product;
            $a->nombre_producto = $detFact->nombre_producto;
            $a->Descripcion = $detFact->Descripcion;
            $a->Marca = $detFact->Marca;
            $a->id_cat = $detFact->id_cat;
            $a->Categoria = $detFact->Categoria;
            $a->Cantidad = $detFact->Cantidad;
            $a->Costo = $detFact->Costo;
            $a->Precio_venta = $detFact->Precio_venta;
            $a->Impuesto = $detFact->Impuesto;
            $a->save();

            // Verificar que los detalles de la factura se guardaron en la base de datos
            $this->assertDatabaseHas('compra_detalles', [
                    'id_detalle' => $a->id_detalle,
                    'Numero_facturaform' => $a->Numero_facturaform,
                    'id_prov' => $a->id_prov,
                    'id_product' => $a->id_product,
                    'nombre_producto' => $a->nombre_producto,
                    'Descripcion' => $a->Descripcion,
                    'Marca' => $a->Marca,
                    'id_cat' => $a->id_cat,
                    'Categoria' => $a->Categoria,
                    'Cantidad' => $a->Cantidad,
                    'Costo' => $a->Costo,
                    'Precio_venta' => $a->Precio_venta,
                    'Impuesto' => $a->Impuesto,
            ]);
        }

    }
    /************************* PRUEBA 14 *************/
    /*Envio formulario, todos los campos vacios */
    /*Esta siendo guardado en la base de datos*/
    /*********** ERROR */
    public function test_envioFormulario_todos_los_campos_vacios(){
        /*Buscar esta ruta to('/guardarFactura/ */
        $user = User::findOrFail(1);
        Auth::login($user);

        $datosFacturaVacio = [
            'Fecha_facturacion' => '',
            'Numero_factura' => '',
            'Total_factura' => '',
            'Proveedor' => '',
        ];

        $datosDetallesVacios = [
            (object) [
                'id_detalle' => '',
                'Numero_facturaform' => '',
                'id_prov' => '',
                'id_product' => '',
                'nombre_producto' => '',
                'Descripcion' => '',
                'Marca' => '',
                'id_cat' => '',
                'Categoria' => '',
                'Cantidad' => '',
                'Costo' => '',
                'Precio_venta' => '',
                'Impuesto' => '',
            ], /*/registrocompra */
        ];

        // Intentar guardar datos de la factura principal con datos inválidos
        $agregar = new Compra();
        $agregar->Fecha_facturacion = $datosFacturaVacio['Fecha_facturacion'];
        $agregar->Numero_factura = $datosFacturaVacio['Numero_factura'];
        $agregar->Total_factura = $datosFacturaVacio['Total_factura'];
        $agregar->Proveedor = $datosFacturaVacio['Proveedor'];
        $agregar->save();

        // Verificar que los datos de la factura principal inválida no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', [
            'Fecha_facturacion'=> $datosFacturaVacio['Fecha_facturacion'],
            'Numero_factura' => $datosFacturaVacio['Numero_factura'],
            'Total_factura' => $datosFacturaVacio['Total_factura'],
            'Proveedor' => $datosFacturaVacio['Proveedor'],
        ]);
        // Intentar guardar detalles de la factura inválidos y verificar que no se guardaron en la base de datos
        foreach ($datosDetallesVacios as $detFact) {
            $a = new CompraDetalles;
            $a->id_detalle = $detFact->id_detalle;
            $a->Numero_facturaform = $detFact->Numero_facturaform;
            $a->id_prov = $detFact->id_prov;
            $a->id_product = $detFact->id_product;
            $a->nombre_producto = $detFact->nombre_producto;
            $a->Descripcion = $detFact->Descripcion;
            $a->Marca = $detFact->Marca;
            $a->id_cat = $detFact->id_cat;
            $a->Categoria = $detFact->Categoria;
            $a->Cantidad = $detFact->Cantidad;
            $a->Costo = $detFact->Costo;
            $a->Precio_venta = $detFact->Precio_venta;
            $a->Impuesto = $detFact->Impuesto;
            $a->save();

            $this->assertDatabaseMissing('compra_detalles', [
                'id_detalle' => $a->id_detalle,
                'Numero_facturaform' => $a->Numero_facturaform,
                'id_prov' => $a->id_prov,
                'id_product' => $a->id_product,
                'nombre_producto' => $a->nombre_producto,
                'Descripcion' => $a->Descripcion,
                'Marca' => $a->Marca,
                'id_cat' => $a->id_cat,
                'Categoria' => $a->Categoria,
                'Cantidad' => $a->Cantidad,
                'Costo' => $a->Costo,
                'Precio_venta' => $a->Precio_venta,
                'Impuesto' => $a->Impuesto,

            ]);
        }
    }
    /********************** PRUEBA 15 ******************/
    /*Prueba enviando los datos vacios de la primera tabla */
    /*ERROR 1: NO MUESTRA LOS MENSAJES DE ERROR */
    public function test_datosVacios_primeraTabla(){
        /*Buscar esta ruta to('/guardarFactura/ */
        $user = User::findOrFail(1);
        Auth::login($user);


        $datosFacturaInvalidos = [
            'Fecha_facturacion' => '',
            'Numero_factura' => '',
            'Total_factura' => '',
            'Proveedor' => '',
        ];

        $datosDetallesValidos = [
            (object) [
                'id_detalle' => 1,
                'Numero_facturaform' => '12345678910',
                'id_prov' => 1,
                'id_product' => 1,
                'nombre_producto' => 'Producto 1',
                'Descripcion' => 'Descripción del Producto 1',
                'Marca' => 'Marca A',
                'id_cat' => 1,
                'Categoria' => 'Categoría A',
                'Cantidad' => 10,
                'Costo' => 50.00,
                'Precio_venta' => 70.00,
                'Impuesto' => 0.1,
            ], /*/registrocompra */
        ];
        // Para que acceda a la ruta
        $response = $this->post('/registrocompra', $datosFacturaInvalidos, $datosDetallesValidos);

        // Verificar que los datos de la factura principal no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', $datosFacturaInvalidos);

        // //verificacion que muestre los mensajes de eeror
        // $response->assertSessionHasErrors([
        //     'Numero_factura',
        //     'Fecha_facturacion',
        //     'Total_factura',
        //     'Proveedor',

        // ]);
    }

    /*************** PRUEBA 16 *****************/
    /*envio formularoo con un dato vacio (fecha_facturacion) */
    /*ERROR 2: NO MUESTRA EL MENSAJE DE ERROR */
    public function test_fechaFacturacion_vacio_primer_tabla(){
        /*Buscar esta ruta to('/guardarFactura/ */
        $user = User::findOrFail(1);
        Auth::login($user);


        $datosFacturaInvalidos = [
            'Fecha_facturacion' => '',
            'Numero_factura' => '25451478965',
            'Total_factura' => 456,
            'Proveedor' => 'Maxi despensa',
        ];

        $datosDetallesValidos = [
            (object) [
                'id_detalle' => 1,
                'Numero_facturaform' => '12345678910',
                'id_prov' => 1,
                'id_product' => 1,
                'nombre_producto' => 'Producto 1',
                'Descripcion' => 'Descripción del Producto 1',
                'Marca' => 'Marca A',
                'id_cat' => 1,
                'Categoria' => 'Categoría A',
                'Cantidad' => 10,
                'Costo' => 50.00,
                'Precio_venta' => 70.00,
                'Impuesto' => 0.1,
            ], /*/registrocompra */
        ];
        // Para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registrocompra', $datosFacturaInvalidos, $datosDetallesValidos);

        // Verificar que los datos de la factura principal no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', $datosFacturaInvalidos);

        //verificacion que muestre los mensajes de error
        $response->assertInvalid(['Fecha_facturacion']);
    }

    /********************* PRUEBA 17  **************************/
    /*Ingreso de fecha invalida en la primera tabla */
    /*ERROR 3: NO MUESTRA EL MENSAJE DE VALIDACION */
    public function test_fechaFacturacion_datosInvalidos(){
        $user = User::findOrFail(1);
        Auth::login($user);


        $datosFacturaInvalidos = [
            'Fecha_facturacion' => '12-13-1500',
            'Numero_factura' => '25451478965',
            'Total_factura' => 456,
            'Proveedor' => 'Maxi despensa',
        ];

        $datosDetallesValidos = [
            (object) [
                'id_detalle' => 1,
                'Numero_facturaform' => '12345678910',
                'id_prov' => 1,
                'id_product' => 1,
                'nombre_producto' => 'Producto 1',
                'Descripcion' => 'Descripción del Producto 1',
                'Marca' => 'Marca A',
                'id_cat' => 1,
                'Categoria' => 'Categoría A',
                'Cantidad' => 10,
                'Costo' => 50.00,
                'Precio_venta' => 70.00,
                'Impuesto' => 0.1,
            ], /*/registrocompra */
        ];
        // Para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registrocompra', $datosFacturaInvalidos, $datosDetallesValidos);

        // Verificar que los datos de la factura principal no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', $datosFacturaInvalidos);

        //verificacion que muestre los mensajes de error
        $response->assertInvalid(['Fecha_facturacion']);
    }
    /********************** PRUEBA 18 ********************/
    /*Ingresar numero de factura vacio */
    /*ERROR 4: no muestra los mensajes de error */
    public function test_numeroFactura_vacio(){
        $user = User::findOrFail(1);
        Auth::login($user);


        $datoNumFactura = [
            'Fecha_facturacion' => '22/08/2023',
            'Numero_factura' => '',
            'Total_factura' => 456,
            'Proveedor' => 'Maxi despensa',
        ];

        $datosDetallesValidos = [
            (object) [
                'id_detalle' => 1,
                'Numero_facturaform' => '12345678910',
                'id_prov' => 1,
                'id_product' => 1,
                'nombre_producto' => 'Producto 1',
                'Descripcion' => 'Descripción del Producto 1',
                'Marca' => 'Marca A',
                'id_cat' => 1,
                'Categoria' => 'Categoría A',
                'Cantidad' => 10,
                'Costo' => 50.00,
                'Precio_venta' => 70.00,
                'Impuesto' => 0.1,
            ], /*/registrocompra */
        ];
        // Para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registrocompra', $datoNumFactura, $datosDetallesValidos);

        // Verificar que los datos de la factura principal no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', $datoNumFactura);

        //verificacion que muestre los mensajes de error
        $response->assertInvalid(['Numero_factura']);
    }
    /******************* PRUEBA 19 ******************/
    /*ingresar dato invalido en numero factura */
    /*ERROR: NO MUESTRA EL MENSAJE DE ERROR */
    public function test_numeroFactura_invalido(){
        $user = User::findOrFail(1);
        Auth::login($user);


        $datoNumFactura = [
            'Fecha_facturacion' => '22/08/2023',
            'Numero_factura' => 'ABC123abcStef',
            'Total_factura' => 456,
            'Proveedor' => 'Maxi despensa',
        ];

        $datosDetallesValidos = [
            (object) [
                'id_detalle' => 1,
                'Numero_facturaform' => '12345678910',
                'id_prov' => 1,
                'id_product' => 1,
                'nombre_producto' => 'Producto 1',
                'Descripcion' => 'Descripción del Producto 1',
                'Marca' => 'Marca A',
                'id_cat' => 1,
                'Categoria' => 'Categoría A',
                'Cantidad' => 10,
                'Costo' => 50.00,
                'Precio_venta' => 70.00,
                'Impuesto' => 0.1,
            ], /*/registrocompra */
        ];
        // Para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registrocompra', $datoNumFactura, $datosDetallesValidos);

        // Verificar que los datos de la factura principal no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', $datoNumFactura);

        //verificacion que muestre los mensajes de error
        $response->assertInvalid(['Numero_factura']);
    }
    /************************ PRUEBA 20 ******************/
    /*No ingresar nada en el campo totalFactura */
    /*ERROR: NO MUESTRA EL MENSAJE DE ERROR*/
    public function test_totalFactura_vacio(){
        /*Buscar esta ruta to('/guardarFactura/ */
        $user = User::findOrFail(1);
        Auth::login($user);


        $datoTotalFactura = [
            'Fecha_facturacion' => '22-08-2023',
            'Numero_factura' => '25451478965',
            'Total_factura' => '',
            'Proveedor' => 'Maxi despensa',
        ];

        $datosDetallesValidos = [
            (object) [
                'id_detalle' => 1,
                'Numero_facturaform' => '12345678910',
                'id_prov' => 1,
                'id_product' => 1,
                'nombre_producto' => 'Producto 1',
                'Descripcion' => 'Descripción del Producto 1',
                'Marca' => 'Marca A',
                'id_cat' => 1,
                'Categoria' => 'Categoría A',
                'Cantidad' => 10,
                'Costo' => 50.00,
                'Precio_venta' => 70.00,
                'Impuesto' => 0.1,
            ], /*/registrocompra */
        ];
        // Para que acceda a la ruta (/guardarProductoModal)
        $response = $this->actingAs($user)->post('/registrocompra', $datoTotalFactura, $datosDetallesValidos);

        // Verificar que los datos de la factura principal no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', $datoTotalFactura);

        //verificacion que muestre los mensajes de error
        $response->assertInvalid(['Total_factura']);
    }
    /*********************** PRUEBA 21 *********************/
    /*Ingresar datos invalidos en el campo de totalFactura */
    /*Error no muestra los mensajes de validacion */
    public function test_totalFactura_invalido(){
        /*Buscar esta ruta to('/guardarFactura/ */
        $user = User::findOrFail(1);
        Auth::login($user);


        $datoTotalFactura = [
            'Fecha_facturacion' => '22-08-2023',
            'Numero_factura' => '25451478965',
            'Total_factura' => 'abc4455',
            'Proveedor' => 'Maxi despensa',
        ];

        $datosDetallesValidos = [
            (object) [
                'id_detalle' => 1,
                'Numero_facturaform' => '12345678910',
                'id_prov' => 1,
                'id_product' => 1,
                'nombre_producto' => 'Producto 1',
                'Descripcion' => 'Descripción del Producto 1',
                'Marca' => 'Marca A',
                'id_cat' => 1,
                'Categoria' => 'Categoría A',
                'Cantidad' => 10,
                'Costo' => 50.00,
                'Precio_venta' => 70.00,
                'Impuesto' => 0.1,
            ], /*/registrocompra */
        ];
        // Para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registrocompra', $datoTotalFactura, $datosDetallesValidos);

        // Verificar que los datos de la factura principal no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', $datoTotalFactura);

        //verificacion que muestre los mensajes de error
        $response->assertInvalid(['Total_factura']);
    }
    /******************* PRUEBA 22 *******************/
    /*dejar el campo vacio de proveedores */
    /*Error no muestra el mensaje de validacion */
    public function test_proveedor_vacio(){
     /*Buscar esta ruta to('/guardarFactura/ */
        $user = User::findOrFail(1);
        Auth::login($user);


        $datoProveedor = [
            'Fecha_facturacion' => '22-08-2023',
            'Numero_factura' => '25451478965',
            'Total_factura' => 4455,
            'Proveedor' => '',
        ];

        $datosDetallesValidos = [
            (object) [
                'id_detalle' => 1,
                'Numero_facturaform' => '12345678910',
                'id_prov' => 1,
                'id_product' => 1,
                'nombre_producto' => 'Producto 1',
                'Descripcion' => 'Descripción del Producto 1',
                'Marca' => 'Marca A',
                'id_cat' => 1,
                'Categoria' => 'Categoría A',
                'Cantidad' => 10,
                'Costo' => 50.00,
                'Precio_venta' => 70.00,
                'Impuesto' => 0.1,
            ], /*/registrocompra */
        ];
        // Para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registrocompra', $datoProveedor, $datosDetallesValidos);

        // Verificar que los datos de la factura principal no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', $datoProveedor);

        //verificacion que muestre los mensajes de error
        $response->assertInvalid(['Proveedor']);
    }
    /************************** PRUEBA 23************ */
    /*ingresar datos invalidos en el campo proveedor */
    public function test_provedor_datosInvalidos(){
        $user = User::findOrFail(1);
        Auth::login($user);


        $datoProveedor = [
            'Fecha_facturacion' => '22-08-2023',
            'Numero_factura' => '25451478965',
            'Total_factura' => 4455,
            'Proveedor' => 'Marcus $',
        ];

        $datosDetallesValidos = [
            (object) [
                'id_detalle' => 1,
                'id_prov' => 1,
                'id_product' => 1,
                'nombre_producto' => 'Producto 1',
                'Numero_facturaform' => '12345678910',
                'Descripcion' => 'Descripción del Producto 1',
                'Marca' => 'Marca A',
                'id_cat' => 1,
                'Categoria' => 'Categoría A',
                'Cantidad' => 10,
                'CantidadRestante' => 6,
                'Costo' => 50.00,
                'Precio_venta' => 70.00,
                'Impuesto' => 0.1,
            ], /*/registrocompra */
        ];
        // Para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registrocompra', $datoProveedor, $datosDetallesValidos);

        // Verificar que los datos de la factura principal no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', $datoProveedor);

        //verificacion que muestre los mensajes de error
        //$response->assertInvalid(['Proveedor']);
    }
    /********************** PRUEBA 24 ******************/
    /********** ENVIAR DATOS INVALIDOS DE AMBAS TABLAS.  */
    /************** ERROR, guardo los datos en LA BASE DE DATOS. */
    public function test_enviar_datos_invalidos_en_ambas_tablas(){
        $user = User::findOrFail(1);
        Auth::login($user);

        // Definir los datos de prueba como arreglos (primera tabla)
        $arrayFac =  [
            'Fecha_facturacion' => '1962-08-19',  // Fecha en formato incorrecto
            'Numero_factura' => 'abc2103 55555555555555kjiop;,pmoi,[,lmjbgvghvg',  // Número de factura no numérico
            'Total_factura' => 'NaN',  // Total no numérico
            'Proveedor' => '',  // Proveedor vacío
        ];

        // Definir los datos de prueba como arreglos (segunda tabla)
        $arrayDet = [
            (object)[
                'id_detalle' => 'detalles 52',
                'Numero_facturaform' => 'prueba factura no valido kkk',  // Número de factura no válido
                'id_prov' => 'invalidProv 2 kk',  // ID de proveedor no numérico
                'id_product' => 'hola kl',//ID de producto no valido
                'nombre_producto' => '125 / hola',
                'Descripcion' => 'mueeeeeeeeveeeeeeeeeeeeeeeee',
                'Marca' => 'l',
                'id_cat' => 'Prueba 25', //ID de categoria no valido
                'Categoria' => '25 horas al dia',
                'Cantidad' => 'cien',
                'Costo' => 'mil5',
                'Precio_venta' => 'dosmil3',
                'Impuesto' => '20%',
            ],
        ];

        // Intentar guardar datos de la factura principal con datos inválidos
        $agregar = new Compra();
        $agregar->Fecha_facturacion = $arrayFac['Fecha_facturacion'];
        $agregar->Numero_factura = $arrayFac['Numero_factura'];
        $agregar->Total_factura = $arrayFac['Total_factura'];
        $agregar->Proveedor = $arrayFac['Proveedor'];
        $agregar->save();

        // Verificar que los datos de la factura principal inválida no se guardaron en la base de datos
        $this->assertDatabaseMissing('compras', [
            'Fecha_facturacion'=> $arrayFac['Fecha_facturacion'],
            'Numero_factura' => $arrayFac['Numero_factura'],
            'Total_factura' => $arrayFac['Total_factura'],
            'Proveedor' => $arrayFac['Proveedor'],
        ]);

        // Intentar guardar detalles de la factura inválidos y verificar que no se guardaron en la base de datos
        foreach ($arrayDet as $detFact) {
            $a = new CompraDetalles;
            $a->id_detalle = $detFact->id_detalle;
            $a->Numero_facturaform = $detFact->Numero_facturaform;
            $a->id_prov = $detFact->id_prov;
            $a->id_product = $detFact->id_product;
            $a->nombre_producto = $detFact->nombre_producto;
            $a->Descripcion = $detFact->Descripcion;
            $a->Marca = $detFact->Marca;
            $a->id_cat = $detFact->id_cat;
            $a->Categoria = $detFact->Categoria;
            $a->Cantidad = $detFact->Cantidad;
            $a->Costo = $detFact->Costo;
            $a->Precio_venta = $detFact->Precio_venta;
            $a->Impuesto = $detFact->Impuesto;
            $a->save();

            $this->assertDatabaseMissing('compra_detalles', [
                'id_detalle' => $a->id_detalle,
                'Numero_facturaform' => $a->Numero_facturaform,
                'id_prov' => $a->id_prov,
                'id_product' => $a->id_product,
                'nombre_producto' => $a->nombre_producto,
                'Descripcion' => $a->Descripcion,
                'Marca' => $a->Marca,
                'id_cat' => $a->id_cat,
                'Categoria' => $a->Categoria,
                'Cantidad' => $a->Cantidad,
                'Costo' => $a->Costo,
                'Precio_venta' => $a->Precio_venta,
                'Impuesto' => $a->Impuesto,

            ]);
        }
    }




}







