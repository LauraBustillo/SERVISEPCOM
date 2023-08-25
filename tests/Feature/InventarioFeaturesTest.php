<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Inventario;
use App\Models\Product;
use App\Models\CompraDetalles;
use Illuminate\Support\Facades\Auth;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Compra;

class InventarioFeaturesTest extends TestCase
{

    /******************** PRUEBA 1 ************* */
    /*Prueba para acceder a la ruta autenticado */
    public function test_prueba_ruta_inventario(){

        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de registrar de productos
        $response = $this->actingAs($user)->get('/Inventario');

        $response->assertStatus(200);
    }

    /******************** PRUEBA 2  ***************/
    /*prueba para acceder a la ruta sin autenticar */
    public function test_prueba_ingreso_ruta_sin_autenticar(){
        $response = $this->get('/Inventario');
        $response->assertStatus(302); //Lo redirige al login
    }

      /***************** PRUEBA 3 *******************/
      /*ERROR 1: La prueba no pasa porque tienen PROVEDOR y no PROVEEDOR */
      public function test_paginacion_index_inventario(){

        $user = User::findOrFail(1);
        Auth::login($user);

        //crea 20 registros
        $compras = CompraDetalles::factory()->count(20)->create();

        //se accede a la ruta del indice
        $response = $this->actingAs($user)->get('/Inventario');

        $response->assertStatus(200);

        // Verificar la presencia de enlaces de paginación
        $response->assertSee('Anterior');
        $response->assertSee('Siguiente');

        // Verificar que los datos de la primera página se muestran correctamente

        $response->assertSeeText('Listado de inventario');
        $response->assertSee('Nombre del producto');
        $response->assertSee('Marca');
        $response->assertSee('Proveedor'); /*Mal escrito es PROVEEDOR */
        $response->assertSee('Cantidad');
        $response->assertSee('Categoría');
        $response->assertSee('Detalles');


    }
    /***************** PRUEBA 4 ***************/
    /*Prueba funcionalidad del boton detalles */
    public function test_funcionalidad_boton_detalles(){
        $user = User::findOrFail(1);
        Auth::login($user);

        $compras = CompraDetalles::factory()->count(20)->create();

        $response = $this->actingAs($user)->get('/Inventario');

        $responseAfterClick = $this->actingAs($user)->get('/Inventario/12');
        $responseAfterClick->assertStatus(200);
    }

    /************************* PRUEBA 5 **************/
    /*Acceder a la ruta de detalle */
    public function test_detalle_factura(){
        $user = User::findOrFail(1);
        Auth::login($user);

         //realiza una solicitud GET a la ruta de listado cliente
         $response = $this->actingAs($user)->get('/Inventario/12');
         $response->assertStatus(200);
         $response->assertSeeInOrder(['Datos', 'Información']);
         $response->assertSeeInOrder([
            'Nombre producto',
            'Descripción',
            'Cantidad',
            'Proveedor',
            'Categoría',
            'Marca',
        ]);
    }

    /************************ PRUEBA 6 **************/
    /*Prueba boton "volver" */
    public function test_boton_volver_en_detalles(){
         $user = User::findOrFail(1);
        Auth::login($user);

        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/Inventario/12');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get('/Inventario');

        // Verifica que se redirige correctamente a la ruta /registrocompra
        $response->assertStatus(200);
        $response->assertSee('Listado de inventario');//para que mostrara algo de la vista


    }

    /******************* PRUEBA 7 *************/
    /***mostrar detalles del inventario */
    public function test_mostrar_detalles_inventario(){
        $user = User::findOrFail(1);
        Auth::login($user);

         //realiza una solicitud GET a la ruta de listado cliente
         $response = $this->actingAs($user)->get('/Inventario/1');
         $response->assertStatus(200);
         $response->assertSee('Información del Producto');
         $response->assertSeeInOrder(['Datos', 'Información']);
         $response->assertSeeInOrder([
            'Nombre producto',
            'Descripción',
            'Cantidad',
            'Proveedor',
            'Categoría',
            'Marca',

        ]);
    }


}
