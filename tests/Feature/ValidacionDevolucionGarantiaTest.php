<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidacionDevolucionGarantiaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    // H9 - Estefany López
    public function test_58_acceder_ver_garantias_dev_antes_de_logueo()
    {
        $response = $this->get(route('devolucion.mostrar', ['id' => 1]));
        $response->assertRedirect(route('login'));
    }

    public function test_59_acceder_ver_garantias_dev_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $devolucion = DevolucionVenta::all()->first();


        $response = $this->get(route('devolucion.mostrar', ['id' =>  $devolucion->id]));

        $response->assertStatus(200);
    }

    public function test_60_acceder_ver_garantias_dev_antes_de_logueo_id_negativo()
    {
        $response = $this->get(route('devolucion.mostrar', ['id' => -1]));
        $response->assertRedirect(route('login'));
    }

    public function test_61_acceder_ver_garantias_dev_despues_de_logueo_id_negativo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('devolucion.mostrar', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_62_acceder_ver_garantias_dev_antes_de_logueo_id_text()
    {
        $response = $this->get(route('devolucion.mostrar', ['id' => 'id']));
        $response->assertRedirect(route('login'));
    }


    public function test_63_acceder_ver_garantias_dev_despues_de_logueo_id_texto()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('devolucion.mostrar', ['id' => 'id']));
        $response->assertStatus(404);
    }


    public function test_64_acceder_ver_garantias_dev_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $devolucion = DevolucionVenta::all()->first();

        $response = $this->get(route('devolucion.mostrar', ['id' =>  $devolucion->id]));
        $response->assertSeeText('Información');
    }

    public function test_65_acceder_ver_garantias_dev_con_etiquetas_adecuadas_dato_numero_factura()
    {
        $user = User::find(1);

        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $datos = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();
        $dev = DevolucionVenta::findOrFail($datos[0]->id);

        $dev->producto = Product::findOrFail($dev->id_productos);
        $dev->Categoria = Categoria::findOrFail($dev->producto->categoria_id);
        $dev->Proveedor = Proveedor::findOrFail($dev->producto->proveedor_id);
        $detalle = DetalleVenta::where('id_detalle', '=', $dev->id_detalle_venta)->get();
        $dev->detalle_venta = DetalleVenta::findOrFail($detalle[0]->id);
        $venta = Venta::where('numeroFactura', '=', $detalle[0]->Numero_facturaform)->get();
        $dev->venta = Venta::findOrFail($venta[0]->id);

        $response = $this->get(route('devolucion.mostrar', ['id' =>  $dev->id]));
        $response->assertSeeText($dev->venta->numeroFactura);
    }

    public function test_66_acceder_ver_garantias_dev_con_etiquetas_adecuadas_dato_nombre_producto()
    {
        $user = User::find(1);

        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $datos = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();
        $dev = DevolucionVenta::findOrFail($datos[0]->id);

        $dev->producto = Product::findOrFail($dev->id_productos);
        $dev->Categoria = Categoria::findOrFail($dev->producto->categoria_id);
        $dev->Proveedor = Proveedor::findOrFail($dev->producto->proveedor_id);
        $detalle = DetalleVenta::where('id_detalle', '=', $dev->id_detalle_venta)->get();
        $dev->detalle_venta = DetalleVenta::findOrFail($detalle[0]->id);
        $venta = Venta::where('numeroFactura', '=', $detalle[0]->Numero_facturaform)->get();
        $dev->venta = Venta::findOrFail($venta[0]->id);

        $response = $this->get(route('devolucion.mostrar', ['id' =>  $dev->id]));
        $response->assertSeeText($dev->producto->Nombre_producto);
    }

    public function test_67_acceder_ver_garantias_dev_con_etiquetas_adecuadas_dato_marca()
    {
        $user = User::find(1);

        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $datos = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();
        $dev = DevolucionVenta::findOrFail($datos[0]->id);

        $dev->producto = Product::findOrFail($dev->id_productos);
        $dev->Categoria = Categoria::findOrFail($dev->producto->categoria_id);
        $dev->Proveedor = Proveedor::findOrFail($dev->producto->proveedor_id);
        $detalle = DetalleVenta::where('id_detalle', '=', $dev->id_detalle_venta)->get();
        $dev->detalle_venta = DetalleVenta::findOrFail($detalle[0]->id);
        $venta = Venta::where('numeroFactura', '=', $detalle[0]->Numero_facturaform)->get();
        $dev->venta = Venta::findOrFail($venta[0]->id);

        $response = $this->get(route('devolucion.mostrar', ['id' =>  $dev->id]));
        $response->assertSeeText($dev->producto->Marca);
    }

    public function test_68_acceder_ver_garantias_dev_con_etiquetas_adecuadas_dato_categoria_descripcion()
    {
        $user = User::find(1);

        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $datos = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();
        $dev = DevolucionVenta::findOrFail($datos[0]->id);

        $dev->producto = Product::findOrFail($dev->id_productos);
        $dev->Categoria = Categoria::findOrFail($dev->producto->categoria_id);
        $dev->Proveedor = Proveedor::findOrFail($dev->producto->proveedor_id);
        $detalle = DetalleVenta::where('id_detalle', '=', $dev->id_detalle_venta)->get();
        $dev->detalle_venta = DetalleVenta::findOrFail($detalle[0]->id);
        $venta = Venta::where('numeroFactura', '=', $detalle[0]->Numero_facturaform)->get();
        $dev->venta = Venta::findOrFail($venta[0]->id);

        $response = $this->get(route('devolucion.mostrar', ['id' =>  $dev->id]));
        $response->assertSeeText($dev->Categoria->Descripcion);
    }

    public function test_69_acceder_ver_garantias_dev_con_etiquetas_adecuadas_dato_nombre_proveedor()
    {
        $user = User::find(1);

        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $datos = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();
        $dev = DevolucionVenta::findOrFail($datos[0]->id);

        $dev->producto = Product::findOrFail($dev->id_productos);
        $dev->Categoria = Categoria::findOrFail($dev->producto->categoria_id);
        $dev->Proveedor = Proveedor::findOrFail($dev->producto->proveedor_id);
        $detalle = DetalleVenta::where('id_detalle', '=', $dev->id_detalle_venta)->get();
        $dev->detalle_venta = DetalleVenta::findOrFail($detalle[0]->id);
        $venta = Venta::where('numeroFactura', '=', $detalle[0]->Numero_facturaform)->get();
        $dev->venta = Venta::findOrFail($venta[0]->id);

        $response = $this->get(route('devolucion.mostrar', ['id' =>  $dev->id]));
        $response->assertSeeText($dev->Proveedor->Nombre_empresa);
    }

    public function test_70_acceder_ver_garantias_dev_con_etiquetas_adecuadas_dato_descripcion()
    {
        $user = User::find(1);

        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $datos = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();
        $dev = DevolucionVenta::findOrFail($datos[0]->id);

        $dev->producto = Product::findOrFail($dev->id_productos);
        $dev->Categoria = Categoria::findOrFail($dev->producto->categoria_id);
        $dev->Proveedor = Proveedor::findOrFail($dev->producto->proveedor_id);
        $detalle = DetalleVenta::where('id_detalle', '=', $dev->id_detalle_venta)->get();
        $dev->detalle_venta = DetalleVenta::findOrFail($detalle[0]->id);
        $venta = Venta::where('numeroFactura', '=', $detalle[0]->Numero_facturaform)->get();
        $dev->venta = Venta::findOrFail($venta[0]->id);

        $response = $this->get(route('devolucion.mostrar', ['id' =>  $dev->id]));
        $response->assertSeeText($dev->Descripcion);
    }

    public function test_71_acceder_ver_garantias_dev_con_etiquetas_adecuadas_dato_fecha_devolucion()
    {
        $user = User::find(1);

        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $datos = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();
        $dev = DevolucionVenta::findOrFail($datos[0]->id);

        $dev->producto = Product::findOrFail($dev->id_productos);
        $dev->Categoria = Categoria::findOrFail($dev->producto->categoria_id);
        $dev->Proveedor = Proveedor::findOrFail($dev->producto->proveedor_id);
        $detalle = DetalleVenta::where('id_detalle', '=', $dev->id_detalle_venta)->get();
        $dev->detalle_venta = DetalleVenta::findOrFail($detalle[0]->id);
        $venta = Venta::where('numeroFactura', '=', $detalle[0]->Numero_facturaform)->get();
        $dev->venta = Venta::findOrFail($venta[0]->id);

        $response = $this->get(route('devolucion.mostrar', ['id' =>  $dev->id]));
        $response->assertSeeText($dev->Fecha_devolucion);
    }

    public function test_72_acceder_ver_garantias_dev_con_etiquetas_adecuadas_dato_fecha_facturacion()
    {
        $user = User::find(1);

        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $datos = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();
        $dev = DevolucionVenta::findOrFail($datos[0]->id);

        $dev->producto = Product::findOrFail($dev->id_productos);
        $dev->Categoria = Categoria::findOrFail($dev->producto->categoria_id);
        $dev->Proveedor = Proveedor::findOrFail($dev->producto->proveedor_id);
        $detalle = DetalleVenta::where('id_detalle', '=', $dev->id_detalle_venta)->get();
        $dev->detalle_venta = DetalleVenta::findOrFail($detalle[0]->id);
        $venta = Venta::where('numeroFactura', '=', $detalle[0]->Numero_facturaform)->get();
        $dev->venta = Venta::findOrFail($venta[0]->id);

        $response = $this->get(route('devolucion.mostrar', ['id' =>  $dev->id]));
        $response->assertSeeText($dev->venta->fechaFactura);
    }

}
