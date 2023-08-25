<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Proveedor;
use App\Models\Categoria;
use Illuminate\Testing\TestResponse;




class ProductosFeaturesTest extends TestCase
{

    //use RefreshDatabase; //para unas una base de datos fresca para cada prueba
    //(hasta que las migraciones no sean iguales en la base de datos no puede funcionar)

    // $user = User::factory()->create();
    // $this->actingAs($user);

    /* ---------------- TOTAL PRUEBAS REALIZADAS =  -------------- */
    /* ************************* PRUEBA 1   ************************* */
    /* Agregar un nuevo producto sin autenticar al  usuario  */
    public function test_agregar_un_registro_sin_autenticar(){
        $response = $this->get('/registroproductos');
        $response->assertRedirect('/login');
    }

    /********************* PRUEBA #2  ( Acceder a la ruta de registro de producto)**********************/
    public function test_acceder_ruta_registro_producto(){

        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registrar de productos
        $response = $this->actingAs($user)->get('/registroproductos');

        $response->assertStatus(200);
    }

    /****************** PRUEBA #3 (Prueba para mostrar el formulario)*****************/
    public function test_formulario_RegistroProducto(){
        $user = User::findOrFail(1);
        Auth::login($user);


        //hace una peticion a la ruta registro de producto
        $response = $this->actingAs($user)->get('/registroproductos');
        //se espera una respuesta exitoss
        $response->assertStatus(200);
        //se verifica que salgan los siguientes campos
        $response->assertSee('Registrar producto');
        $response->assertSee('Nombre del producto');
        $response->assertSee('Marca del producto');
        $response->assertSee('Categorías');
        $response->assertSeeText('Proveedor');
        $response->assertSeeText('Descripción del producto');
        $response->assertSeeInOrder(['Guardar', 'Limpiar']);  // Verifica que los botones aparezcan en orden específico en la respuesta HTML

    }


    /** PRUEBA DE RUTA PARA CREAR UN REGISTRO DE PRODUCTO  #4 */
    public function test_crear_producto_correcto(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        //se ingresan los campos
        $datosProductos = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Cargador',
            'Descripcion' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus.',
            'Marca' => 'Kasa',
            'categoria_id' => $categoria->id,
            'Cantidad' => '5',
            'Precio_compra' => 120,
            'Precio_venta' =>170,
            'Impuesto' => 0.10,
        ];
        //para que acceda a la ruta y reciba los datos
        $response = $this->withoutMiddleware()->post('/registroproductos', $datosProductos);
        //verifica que el producto se haya creado en la base de datos
        $this->assertDatabaseHas('products', $datosProductos);
        //verificar que la respuest sea exitosa
        $response->assertStatus(302);
        //redireccione a la pagina despues del registro
        $response->assertRedirect('/registroproductos');

    }

    /******************** PRUEBA 5 *************************/
    /* Prueba con datos vacios en el regsitro de formulario  */
    public function test_products_campos_vacios(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(1);

        $response = $this->post('/registroproductos', [
            'proveedor_id' => '',
            'Nombre_producto' => '',
            'Descripcion' => '',
            'Marca' => '',
            'categoria_id' => '',
            'Cantidad' => '',
            'Precio_compra' => '',
            'Precio_venta' => '',
            'Impuesto' => '',
        ]);

     //verifica que se muestren el mensaje de validacion
     $response->assertSessionHasErrors('proveedor_id');
     $response->assertSessionHasErrors('Nombre_producto');
     $response->assertSessionHasErrors('Descripcion');
     $response->assertSessionHasErrors('Marca');
     $response->assertSessionHasErrors('categoria_id');
    // $response->assertSeessionHasErrors('Cantidad');

    }

    /******** PRUEBA  6 ************/
    /*Probar el minimo de carcateres de nombre del producto */
    /*ERROR7: no pasa la validacion */
    public function test_nombre_producto_corto(){

        $user = User::findOrFail(1);
        Auth::login($user);
        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(3);
        $this->withoutExceptionHandling();
        //cantidad minima de carcateres es 3
        $data = [
            'Nombre_producto' => 's',
        ];
        //para que acceda a la ruta y reciba los datos
        $response = $this->actingAs($user)->post('/registroproductos', $data);
        $this->assertDatabaseMissing('products', $data);
        //para que muestre el mensaje de validacion
        $response->assertSee('Nombre_producto');

        /*assertSessionHasErrors, assertSee, assertDontSee, assertSeeInOrder, assertViewHasErrors, assertSessionDoesntHaveErrors */
    }

    /********** PRUEBA 7  ******************/
    /*Probar el maximo del campo Marca */
    /*ERROR8: no pasa la validacion */
    public function test_product_nombre_max_length_exceeded_validation(){

        $user = User::findOrFail(1);
        Auth::login($user);
        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(1);

        $this->withoutExceptionHandling();
        //crea una nombre de mas de 20 caracteres
        $nombreMax = str_repeat('a', 26);

        $data = [
            'Nombre_producto' =>   $nombreMax,
        ];
        //para que acceda a la ruta y reciba los datos
        $response = $this->actingAs($user)->post('/registroproductos', $data);
        //verifica que el dato no se haya guardado en la tabla products
        $this->assertDatabaseMissing('products', $data);
        //para que muestre el mensaje de validacion
        $response->assertInvalid('Nombre_producto', 'El nombre del producto no debe de tener más de 25 letras');
    }


    /***************** PRUEBA 8 ******************/
    /* Prueba con caracteres en el nombre del producto */
    /*ERROR1: No pasa la validacion del nombre del producto */
    public function test_nombreProducto_caracteres_especiales(){

        $user = User::findOrFail(1);
        Auth::login($user);
        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $this->withoutExceptionHandling();

        //se ingresa el campo con datos invalidos
        $data = [
            'Nombre_producto' => 'Papelillo @',
        ];

        //para que acceda a la ruta y reciba los datos
        $response = $this->actingAs($user)->post('/registroproductos', $data);
        //que muestre el mensaje de error de
        $response->assertSessionHasErrors('Nombre_producto');

        /*No funciona
         1.  $response->assertInvalid('Nombre_producto');
         2.  $response->assertSee('El formato del campo nombre producto es inválido');
          // $response->assertJsonValidationErrors(['Nombre_producto']);*/
    }



    /****************** PRUEBA 9 *****************/
    /* Probar descripcion que no pase de 150 caracteres  */
    /*ERROR 2: No pasa el mensaje de validacion */
    public function test_descripcion_product_max_150(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);

        $this->withoutExceptionHandling();

        //crea una descripcion de mas de 150 caracteres que el maximo es 150
        $descMax = str_repeat('a', 151);

        $data = [
            'Descripcion' =>   $descMax,
        ];

        //acceda a la ruta y recibe los datos
        $response = $this->actingAs($user)->post('/registroproductos', $data);
        //para que muestren el mensaje de error
        // $response->assertInvalid('Descripcion');
        $response->assertSessionHasErrors('Descripcion');


    }


    /***************** PRUEBA 10 ******************/
    /* Probar el minimo de la descripcion del producto */
    /*ERROR3: no pasa la validacion */

    public function test_descripcion_producto_corta(){

        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $this->withoutExceptionHandling();

        //creacion de descripcion de producto con 2 caracteres (deben ser minimo 3)
        $data = [
            'Descripcion' =>   'ab',
        ];
        //se crea una descripcion corta
        // $descShort = 'ab';
        $response = $this->actingAs($user)->post('/registroproductos',  $data);
        //muestra el mensaje de error
        $response->assertSessionHasErrors('Descripcion');
    }

    /******************* PRUEBA 11 ********************/
    /*Probar el minimo de carcateres de marca del producto */
    /*ERROR4: no pasa la validacion */
    public function test_marca_producto_corta(){
        $user = User::findOrFail(1);
        Auth::login($user);
        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);

        $this->withoutExceptionHandling();

       //se crea el nombre de la marca con dos Caracteres (deben ser minimo 2)
       $data = [
            'Marca' => 's',
        ];
        //se accede a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $data);
        //que muestre el mensaje de error
        $response->assertSessionHasErrors('Marca');
        /**************solo con esta validacion si las pasa */
        //$this->expectException(\Illuminate\Validation\ValidationException::class);

    }

    /********** PRUEBA 12  ******************/
    /*Probar el maximo del campo Marca */
    /*ERROR5: no pasa la validacion */
    public function test_marca_producto_max(){
        $user = User::findOrFail(1);
        Auth::login($user);
        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);

        $this->withoutExceptionHandling();
        //el maximo de caracteres que admite son 25
        $marcaMax = str_repeat('a', 26);
        //para que acceda a la variable
        $data = [
            'Marca' =>   $marcaMax,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $data);

        //para que muestre los mensajes de error
        $response->assertSessionHasErrors('Marca');
    }

    /***************** PRUEBA 13 ******************/
    /* Prueba con caracteres especiales en la marca del producto */
    /*ERROR6: no pasa la validacion */
    public function test_marcaProducto_caracteres_especiales(){
        $user = User::findOrFail(1);
        Auth::login($user);
        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);

        $this->withoutExceptionHandling();
        //crea el dato
        $data = [
            'Marca' => 'Papelillo @.',
        ];
        //se accede a la ruta y se envia el dato
        $response = $this->actingAs($user)->post('/registroproductos', $data);
        //muestra los mensajes de error
        $response->assertSessionHasErrors('Marca');

    }
    /************************************PRUEBA 14**************** */
    /*Funcionalidad del formulario que no envie si esta vacio proveedor */
    public function test_registroProducto_ProveedorVacio(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::factory()->findOrFail(2);

        $datosProductos = [
            'proveedor_id' => '',// vacio
            'Nombre_producto' => 'Cargador',
            'Descripcion' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus.',
            'Marca' => 'Kasa',
            'categoria_id' => $categoria->id,
            'Cantidad' => '5',
            'Precio_compra' => 120,
            'Precio_venta' =>170,
            'Impuesto' => 0.10,
        ];
        //para que acceda a la ruta y reciba los datos
        $response = $this->actingAs($user)->post('/registroproductos', $datosProductos);
        //verificar que la respuest sea exitosa
        $response->assertStatus(302);
        //verifica que no se haya guardado en la base de dato
        $this->assertDatabaseMissing('products', $datosProductos);
        //muestra el mensaje de error
        $response->assertSessionHasErrors('proveedor_id');

    }

    /************** PRUEBA 15 ******************* */
    /**Enviar formulario con nombre vacio */
    public function test_registroProducto_NombreVacio(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);

        //se crea el registro
        $datosProductos = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => '',//vacio
            'Descripcion' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus.',
            'Marca' => 'Kasa',
            'categoria_id' => $categoria->id,
            'Cantidad' => '5',
            'Precio_compra' => 120,
            'Precio_venta' =>170,
            'Impuesto' => 0.10,
        ];
        //para que acceda a la ruta y reciba los datos
        $response = $this->post('/registroproductos', $datosProductos);
        //verificar que la respuest sea exitosa
        $response->assertStatus(302);
        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $datosProductos);
        //para que muestre el mensaje de validacion del campo
        $response->assertSessionHasErrors('Nombre_producto');

    }


    /************** PRUEBA 16 ******************* */
    /**Enviar formulario con descripcion vacio */
    public function test_registroProducto_DescripcionVacio(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        //se ingresan el regirstro del producto
        $datosProductos = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Malteada',//vacio
            'Descripcion' => '',
            'Marca' => 'Kasa',
            'categoria_id' => $categoria->id,
            'Cantidad' => '5',
            'Precio_compra' => 120,
            'Precio_venta' =>170,
            'Impuesto' => 0.10,
        ];
        //para que acceda a la ruta y reciba los datos
        $response = $this->post('/registroproductos', $datosProductos);
        //verificar que la respuest sea exitosa
        $response->assertStatus(302);
        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $datosProductos);
        //que muestre el mensaje de error
        $response->assertSessionHasErrors('Descripcion');

    }

    /************** PRUEBA 17 ******************* */
    /**Enviar formulario con marca vacio */
    public function test_registroProducto_MarcaVacio(){
        $user = User::findOrFail(1);
        Auth::login($user);
        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        //se ingresan los datos
        $datosProductos = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Malteada gjj',//vacio
            'Descripcion' => 'Lalallalal lalal lalal lalal',
            'Marca' => '',
            'categoria_id' => $categoria->id,
            'Cantidad' => '5',
            'Precio_compra' => 120,
            'Precio_venta' =>170,
            'Impuesto' => 0.10,
        ];
        //para que acceda a la ruta y reciba los datos
        $response = $this->post('/registroproductos', $datosProductos);
        //verificar que la respuest sea exitosa
        $response->assertStatus(302);
        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $datosProductos);
        //para que muestre el mensaje de error
        $response->assertSessionHasErrors('Marca');

    }


    /************** PRUEBA 18 ******************* */
    /**Enviar formulario con categoria vacio */
    public function test_registroProducto_CategoriaVacio(){
        $user = User::findOrFail(1);
        Auth::login($user);
        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);

        $datosProductos = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Malteada',//vacio
            'Descripcion' => 'Lalallalal lalal lalal lalal',
            'Marca' => 'Kola',
            'categoria_id' => '',
            'Cantidad' => '5',
            'Precio_compra' => 120,
            'Precio_venta' =>170,
            'Impuesto' => 0.10,
        ];
        //para que acceda a la ruta y recibe los datos
        $response = $this->post('/registroproductos', $datosProductos);
        //verificar que la respuest sea exitosa
        $response->assertStatus(302);
        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $datosProductos);
        //para que verifique que se muestra el mensaje de error
        $response->assertSessionHasErrors('categoria_id');

    }


    /********************** PRUEBA 19 *******************/
    /*Crear un registro con un dato malo y los demas buenos */
    /*Envio de formulario con un dato mal (Nombre producto con 2 caracteres) MIN:3 */
    public function test_envioFormulario_dato_nombreProducto_mal_min(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);

        $pruebadatosMal = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'mo',
            'Descripcion' => 'Hola pruebas',
            'Marca' => 'Pacasa',
            'categoria_id' => $categoria->id,
            'Cantidad' => '3',
            'Precio_compra' => 125,
            'Precio_venta' =>180,
            'Impuesto' => 0.15,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebadatosMal);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebadatosMal);

        $response->assertSessionHasErrors('Nombre_producto');

    }

    /************************* PRUEBA 20 *********************/
    /*Envio de formulario con un dato mal (Nombre producto de mas de 25 caracteres) MAX:25*/
    public function test_envioFormulario_nombreProducto_mal_max(){

        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(1);

        $pruebadatosMal = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Hola stefany prueba esto con mas de 25 caracteres',
            'Descripcion' => 'Hola pruebas',
            'Marca' => 'Pacasa',
            'categoria_id' => $categoria->id,
            'Cantidad' => '3',
            'Precio_compra' => 125,
            'Precio_venta' =>180,
            'Impuesto' => 0.15,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebadatosMal);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);
        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebadatosMal);
        //para que muestre el mensaje de validacion
        $response->assertSessionHasErrors('Nombre_producto');

    }
    /******************* PRUEBA 21 **********************/
    /*Envio de formulario con un dato mal (Nombre producto caracteres especiales)*/
    public function test_envioFormulario_mal_nombreProducto_caracteres_especiales(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(3);

        $pruebadatosMal = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Hola %',
            'Descripcion' => 'Hola pruebas',
            'Marca' => 'Pacasa',
            'categoria_id' => $categoria->id,
            'Cantidad' => '3',
            'Precio_compra' => 125,
            'Precio_venta' =>180,
            'Impuesto' => 0.15,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebadatosMal);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);
        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebadatosMal);
        //para que muestre el mensaje de validacion
        $response->assertSessionHasErrors('Nombre_producto');
    }


    /************************* PRUEBA 22 *********************/
    /*Envio de formulario con un dato mal (Marca 1 caracter) MIN:2 */
    public function test_envioFormulario_marcaM_mal(){

        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(4);
        $pruebaMarcaMal = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Carbohidratosolio Aaa',
            'Descripcion' => 'Axelila afuera stop',
            'Marca' => 'P',
            'categoria_id' => $categoria->id,
            'Cantidad' => '85',
            'Precio_compra' => 500,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaMarcaMal);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaMarcaMal);

        $response->assertSessionHasErrors('Marca');

    }
    /************************* PRUEBA 23 *********************/
    /*Envio de formulario con un dato mal (Marca 1 caracter) MAX:25 */
    public function test_envioFormulario_marcaMax_mal(){
        $user = User::findOrFail(1);
        Auth::login($user);
        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(3);
        $pruebaMarcaMal = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Pollo',
            'Descripcion' => 'Axelila afuera stop',
            'Marca' => 'Paaaaaaaaaaaaaaaaaaaaaaaa kkkkkkkkkkkkkkkkkkkkk aaaaaaaaaaaaaaaaaaaa hahah h      aahhaha',
            'categoria_id' => $categoria->id,
            'Cantidad' => '85',
            'Precio_compra' => 500,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaMarcaMal);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaMarcaMal);

        $response->assertSessionHasErrors('Marca');

    }
    /******************* PRUEBA 24 **********************/
    /*Envio de formulario con un dato mal (Marca caracteres especiales)*/
    public function test_envioFormulario_marca_caracteres_especiales(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $pruebaMarcaMal = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Carbohidratosolio Aaa',
            'Descripcion' => 'Axelila afuera stop',
            'Marca' => 'P !',
            'categoria_id' => $categoria->id,
            'Cantidad' => '85',
            'Precio_compra' => 500,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaMarcaMal);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaMarcaMal);

        $response->assertSessionHasErrors('Marca');
    }
    /****************** en el formulario no estan, pero en la tabla si CANTIDAD, PRECIO COMPRA, PRECIO VENTA, IMPUESTO*/
    /************************ PRUEBA 25 **************/
    /**Prueba con los campos de precio de cantidad vacio */
    /*NO TIENE VALIDACION */
    public function test_envio_cantidadVacio(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(1);
        $pruebaCantidad = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Marcador Aaa',
            'Descripcion' => 'Axelila afuera stop',
            'Marca' => 'Papers',
            'categoria_id' => $categoria->id,
            'Cantidad' => '',
            'Precio_compra' => 500,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaCantidad);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaCantidad);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Cantidad');
    }
    /*********************  PRUEBA 26 *************/
    /*Campo "Cantidad" con letras */
    /*No hay validacion */
    public function test_cantidad_con_letras(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $pruebaCantidad = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Marcador Aaa',
            'Descripcion' => 'Axelila afuera stop',
            'Marca' => 'Papers',
            'categoria_id' => $categoria->id,
            'Cantidad' => 'holaaaaaaaaaaaaaa',
            'Precio_compra' => 500,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaCantidad);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaCantidad);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Cantidad');

    }
    /************* PRUEBA 27 *****************/
    /*cantidad negativo */
    //no hay validacion
    public function test_cantidad_negativo(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $pruebaCantidadMal = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Marcador Aaa',
            'Descripcion' => 'Axelila afuera stop',
            'Marca' => 'Papers',
            'categoria_id' => $categoria->id,
            'Cantidad' => '-500',
            'Precio_compra' => 500,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaCantidadMal);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaCantidadMal);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Cantidad');
    }

    /******************* PRUEBA 28 ******************/
    /*Cantidad con caracter especial */
    /*No hay validacion */
    public function test_cantidad_caracter_especial(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $pruebaCantidadM = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Marcador Aaa',
            'Descripcion' => 'Axelila afuera stop',
            'Marca' => 'Papers',
            'categoria_id' => $categoria->id,
            'Cantidad' => '5%',
            'Precio_compra' => 500,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaCantidadM);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaCantidadM);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Cantidad');
    }
    /******************** PRUEBA 29 ********************/
    /*No enviar cantidad como tipo string */
    /*No hay validacion, y la base de datos no acepta el dato */
    public function test_cantidad_no_string(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $pruebaCantidadMal = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada',
            'Descripcion' => 'Stop tall',
            'Marca' => 'Papeles',
            'categoria_id' => $categoria->id,
            'Cantidad' => 40,
            'Precio_compra' => 500,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaCantidadMal);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaCantidadMal);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Cantidad');
    }
    /*************************** PRUEBA 32 **************************/
    /*Prueba de cantidad maxima de digitos ingresados */
    public function test_cantidad_max(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $pruebaCantidadM = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada',
            'Descripcion' => 'Stop tall',
            'Marca' => 'Papeles',
            'categoria_id' => $categoria->id,
            'Cantidad' => '400000000000005666666666666666666666666668558666666666666666888888888888777777777777666666666660',
            'Precio_compra' => 500,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaCantidadM);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaCantidadM);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Cantidad');
    }
    /*********************** PRUEBA 31 **************************/
    /*precio compra vacio */
    //no hay validacion
    public function test_precioCompra_vacio(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $pruebaPrecioCom = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada',
            'Descripcion' => 'Stop tall',
            'Marca' => 'Papeles',
            'categoria_id' => $categoria->id,
            'Cantidad' => 40,
            'Precio_compra' => '',
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaPrecioCom);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        //$response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaPrecioCom);

        //no hay mensaje de validacion
        //$response->assertSessionHasErrors('Precio_compra');
    }
    /**************** PRUEBA 32 ******************/
    /*precio compra negativo */
    //no hay validacion
    public function test_precioCompra_negativo(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $pruebaPreciCom = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada jajaja',
            'Descripcion' => 'Stop tall',
            'Marca' => 'Papeles',
            'categoria_id' => $categoria->id,
            'Cantidad' => '40',
            'Precio_compra' => -500,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaPreciCom);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaPreciCom);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Precio_compra');
    }
    /********************** PRUEBA 33 *****************/
    /*precio compra string */
    //no hay validacion
    public function test_precioCompra_string(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(2);
        $precioCom = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada jajaja jajjaja',
            'Descripcion' => 'Stop tall apple',
            'Marca' => 'Papeles store',
            'categoria_id' => $categoria->id,
            'Cantidad' => '40',
            'Precio_compra' => '35',
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $precioCom);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $precioCom);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Precio_compra');

    }
    /****************  PRUEBA 34 **************/
    /*Max de precio compra */
    //no hay validacion
    public function test_precioCompra_max(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(1);
        $precioCom = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada jajaja',
            'Descripcion' => 'Stop tall',
            'Marca' => 'Papeles',
            'categoria_id' => $categoria->id,
            'Cantidad' => '40',
            'Precio_compra' => 500555555555555555555555555555555555555555555555555555555555555555555555555555555555555555577777777777777777766666666666,
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $precioCom);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $precioCom);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Precio_compra');
    }
    /********************************* PRUEBA  35******************/
    /*Precio compra caracter especial */
    //no hay validacion
    public function test_precioCompra_caracterEspecial(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(1);
        $pruebaPre = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada jajaja',
            'Descripcion' => 'Stop tall',
            'Marca' => 'Papeles',
            'categoria_id' => $categoria->id,
            'Cantidad' => '40',
            'Precio_compra' => '585*',
            'Precio_venta' =>785,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaPre);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaPre);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Precio_compra');
    }
    /****************** PRUEBA 36 **********************/
    /*PRECIO VENTA VACIO */
    //no hay validacion
    public function test_precioVenta_vacio(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(1);
        $pruebaPrecioVenta = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada jajaja',
            'Descripcion' => 'Stop tall',
            'Marca' => 'Papeles',
            'categoria_id' => $categoria->id,
            'Cantidad' => '40',
            'Precio_compra' => 500,
            'Precio_venta' =>'',
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaPrecioVenta);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        //$response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaPrecioVenta);

        //no hay mensaje de validacion
       // $response->assertSessionHasErrors('Precio_venta');
    }
    /************* PRUEBA 37 *****************/
    /**Precio venta caracter especial*/
    //no hay validacion
    public function test_precioVenta_negativo(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(3);
        $pruebaPrecioVenta = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada jajaja',
            'Descripcion' => 'Stop tall',
            'Marca' => 'Papeles',
            'categoria_id' => $categoria->id,
            'Cantidad' => '40',
            'Precio_compra' => 500,
            'Precio_venta' => -600,
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaPrecioVenta);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaPrecioVenta);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Precio_venta');
    }
    /*************** PRUEBA 40 ***********/
    /*con valor string */
    //no hay validacion
    public function test_PrecioVenta_string(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(3);
        $pruebaPrecioVenta = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada jajaja',
            'Descripcion' => 'Stop tall',
            'Marca' => 'Papeles',
            'categoria_id' => $categoria->id,
            'Cantidad' => '40',
            'Precio_compra' => 500,
            'Precio_venta' =>'452',
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaPrecioVenta);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaPrecioVenta);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Precio_venta');
    }
    /********************** PRUEBA 41 *************/
    //precio venta caracteres especiales
    //no hay validacion
    public function test_precioVenta_caracteresEspeciales(){
        $user = User::findOrFail(1);
        Auth::login($user);

        //crea proveedor y categoria para usar en la prueba
        $proveedor = Proveedor::factory()->create();
        $categoria = Categoria::findOrFail(1);
        $pruebaPrecioVenta = [
            'proveedor_id' => $proveedor->id,
            'Nombre_producto' => 'Mareada jajaja',
            'Descripcion' => 'Stop tall',
            'Marca' => 'Papeles',
            'categoria_id' => $categoria->id,
            'Cantidad' => '40',
            'Precio_compra' => 500,
            'Precio_venta' =>'55&',
            'Impuesto' => 0.25,
        ];
        //para que acceda a la ruta
        $response = $this->actingAs($user)->post('/registroproductos', $pruebaPrecioVenta);

        dump($response->getContent()); // Imprime el contenido de la respuesta

        // Verifica que la respuesta sea una redirección (HTTP 302)
        $response->assertStatus(302);

        //verifica que no se haya guardado en la base de datos
        $this->assertDatabaseMissing('products', $pruebaPrecioVenta);

        //no hay mensaje de validacion
        $response->assertSessionHasErrors('Precio_venta');
    }





}
