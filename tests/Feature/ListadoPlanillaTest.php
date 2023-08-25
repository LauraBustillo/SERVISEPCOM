<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListadoPlanillaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    // H6 - Estefany López
    public function test_73_acceder_lista_planilla_antes_de_logueo()
    {
        $response = $this->get(route('index.planilla'));
        $response->assertRedirect(route('login'));
    }

    public function test_74_acceder_lista_planilla_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('index.planilla'));
        $response->assertStatus(200);
    }

    public function test_75_acceder_nueva_planilla_antes_de_logueo()
    {
        $response = $this->get(route('show.registroPlanilla'));
        $response->assertRedirect(route('login'));
    }

    public function test_76_acceder_nueva_planilla_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('show.registroPlanilla'));
        $response->assertStatus(200);
    }

    public function test_77_acceder_lista_planillas_correctamente_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('show.registroPlanilla'));
        $response->assertSeeText('Listado');
    }

    public function test_78_acceder_nueva_planillas_correctamente_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('show.registroPlanilla'));
        $response->assertSeeText('Registro');
    }

    //H9 Validaciones nueva Venta
    public function test_79_registro_nueva_venta_correctamente_con_datos_correctos_con_logueo()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $venta = Venta::where('numeroFactura', '=', "000-000-00-00001000")->get();


        $response->assertRedirect(route('venta.mostrar', ['id' => $venta[0]->id]));
    }

    public function test_80_registro_nueva_venta_con_numero_factura_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));


        $detalle2 = Venta::where('numeroFactura', '=', '')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_81_registro_nueva_venta_con_numero_factura_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'numeroFactura' => 'El número de factura es requerido',
        ]);
    }

    public function test_82_registro_nueva_venta_con_numero_factura_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "asdasdasdasd",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));


        $detalle2 = Venta::where('numeroFactura', '=', 'asdasdasdasd')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_83_registro_nueva_venta_con_numero_factura_formato_invalido_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "asdasdasdasd",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'numeroFactura' => 'El número de factura debe tener el formato 000-000-00-00000000.',
        ]);
    }

    public function test_84_registro_nueva_venta_con_numero_factura_valor_unico()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();
        $vent = Venta::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "' . $vent->numeroFactura . '",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));


        $detalle2 = Venta::where('numeroFactura', '=', $vent->numeroFactura)->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_85_registro_nueva_venta_con_numero_factura_valor_unico_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();
        $vent = Venta::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "' . $vent->numeroFactura . '",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'numeroFactura' => 'El número de factura ya está en uso.',
        ]);
    }

    public function test_86_registro_nueva_venta_con_empleadoVentas_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));


        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_87_registro_nueva_venta_con_empleadoVentas_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'empleadoVentas' => 'El empleado de ventas es requerido.',
        ]);
    }

    public function test_88_registro_nueva_venta_con_empleadoVentas_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "23qewqweq34q434we",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));


        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_89_registro_nueva_venta_con_empleadoVentas_formato_invalido_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "23qewqweq34q434we",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'empleadoVentas' => 'El formato del empleado de ventas no es válido.',
        ]);
    }

    public function test_90_registro_nueva_venta_con_fecha_factura_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_91_registro_nueva_venta_con_fecha_factura_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'fechaFactura' => 'La fecha de factura es requerida.',
        ]);
    }


    public function test_92_registro_nueva_venta_con_fecha_factura_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "fecha",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_93_registro_nueva_venta_con_fecha_factura_formato_invalido_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "fecha",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'fechaFactura' => 'La fecha de factura debe ser una fecha válida.',
        ]);
    }

    public function test_94_registro_nueva_venta_con_fecha_factura_solo_numeros()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": 90809809,
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_95_registro_nueva_venta_con_fecha_factura_solo_numeros_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": 90809809,
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'fechaFactura' => 'La fecha de factura debe ser una fecha válida.',
        ]);
    }

    public function test_96_registro_nueva_venta_con_cliente_factura_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_97_registro_nueva_venta_con_cliente_factura_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'clienteFactura' => 'El cliente de factura es requerido.',
        ]);
    }

    public function test_98_registro_nueva_venta_con_cliente_factura_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "1232ewqe123123qwe",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_99_registro_nueva_venta_con_cliente_factura_formato_invalido_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "1232ewqe123123qwe",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": 156
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'clienteFactura' => 'El formato del cliente de ventas no es válido.',
        ]);
    }

    public function test_100_registro_nueva_venta_con_total_factura_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": ""
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_101_registro_nueva_venta_con_total_factura_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": ""
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'Total_factura' => 'El total de factura es requerido.',
        ]);
    }

    public function test_102_registro_nueva_venta_con_total_factura_solo_formato_numerico()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": "fasdasda"
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_103_registro_nueva_venta_con_total_factura_solo_formato_numerico_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": ' . $rangos->id . ',
            "Total_factura": "fasdasda"
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'Total_factura' => 'El total de factura debe ser un número.',
        ]);
    }

    public function test_104_registro_nueva_venta_con_id_rango_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": "",
            "Total_factura": "150"
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_105_registro_nueva_venta_con_id_rango_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": "",
            "Total_factura": "150"
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'id_rango' => 'El ID de rango de factura es requerido.',
        ]);
    }

    public function test_106_registro_nueva_venta_con_id_rango_solo_valor_numerico()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": "dasdasda",
            "Total_factura": "150"
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_107_registro_nueva_venta_con_id_rango_solo_valor_numerico_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": "dasdasda",
            "Total_factura": "150"
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'id_rango' => 'El ID de rango de factura debe ser numérico.',
        ]);
    }

    public function test_108_registro_nueva_venta_con_id_rango_inexistente()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": "-1",
            "Total_factura": "150"
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $detalle2 = Venta::where('numeroFactura', '=', '000-000-00-00001000')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_109_registro_nueva_venta_con_id_rango_inexistente_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $rangos = RangoFactura::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from detalle_ventas where id_detalle = ?', ['d78a9d47-ac60-4691-af8c-784655a7e4a4']);
        DB::delete('delete from ventas where numeroFactura = ?', ['000-000-00-00001000']);

        $arrayFac = '{
            "numeroFactura": "000-000-00-00001000",
            "fechaFactura": "2023-08-22",
            "empleadoVentas": "Administrador",
            "clienteFactura": "Daniela Bustillo Erwrwer",
            "garantia": "no",
            "id_rango": "-1",
            "Total_factura": "150"
          }';
        $arrayDet = '[
            {
              "id_detalle": "d78a9d47-ac60-4691-af8c-784655a7e4a4",
              "id_product": ' . $product->id . ',
              "id_prov": "1",
              "id_cat": "4",
              "Numero_facturaform": "",
              "nombre_producto": "Samsungs8",
              "Marca": "Lcd",
              "Descripcion": "Para Cambio De Pantallas",
              "Cantidad": "1",
              "Costo": "0",
              "Precio_venta": "100",
              "Impuesto": "15",
              "existencia": 198
            }
          ]';

        $response = $this->get(route('store.registroventa', ['arrayFac' => $arrayFac, 'arrayDet' => $arrayDet]));

        $response->assertInvalid([
            'id_rango' => 'El ID de rango de factura no existe.',
        ]);
    }
}
