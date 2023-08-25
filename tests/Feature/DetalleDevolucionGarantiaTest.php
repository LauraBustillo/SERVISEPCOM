<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DetalleDevolucionGarantiaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    // H8 - Estefany López
    public function test_36_registro_nueva_dev_garantia_correctamente_con_correctos_sin_logueo()
    {

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.gasto'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $response->assertRedirect(route('login'));
    }

    public function test_37_registro_nueva_dev_garantia_correctamente_con_correctos_con_logueo()
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

        $response->assertRedirect(route('devolucion.index'));
    }

    public function test_38_registro_nueva_dev_garantia_sin_producto()
    {
        $user = User::find(1);
        Auth::login($user);

        $detalle = DetalleVenta::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => '',
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $detalle2 = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_39_registro_nueva_dev_garantia_sin_producto_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $detalle = DetalleVenta::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => '',
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $response->assertInvalid([
            'id_producto_devolucion' => 'El producto es obligatorio',
        ]);
    }

    public function test_40_registro_nueva_dev_garantia_id_producto_texto()
    {
        $user = User::find(1);
        Auth::login($user);

        $detalle = DetalleVenta::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => 'id',
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $detalle2 = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_41_registro_nueva_dev_garantia_id_producto_texto_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $detalle = DetalleVenta::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => 'id',
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $response->assertInvalid([
            'id_producto_devolucion' => 'El campo ID de producto de devolución debe ser un número entero.',
        ]);
    }

    public function test_42_registro_nueva_dev_garantia_id_producto_inexistente()
    {
        $user = User::find(1);
        Auth::login($user);

        $detalle = DetalleVenta::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => -1,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $detalle2 = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_43_registro_nueva_dev_garantia_id_producto_inexistente_texto_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $detalle = DetalleVenta::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', [$detalle->id_detalle]);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => -1,
                'id_detalle_venta' => $detalle->id_detalle,
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $response->assertInvalid([
            'id_producto_devolucion' => 'El producto de devolución no existe en la tabla de productos.',
        ]);
    }


    public function test_44_registro_nueva_dev_garantia_sin_seleccionar_detalle_venta()
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
                'id_detalle_venta' => '',
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $detalle2 = DevolucionVenta::where('Descripcion', '=', 'Defecto de frabricacion en el colocado de la lamina')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_45_registro_nueva_dev_garantia_sin_seleccionar_detalle_venta_texto_mensaje_validacion()
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
                'id_detalle_venta' => '',
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $response->assertInvalid([
            'id_detalle_venta' => 'El id_detalle_venta es obligatorio',
        ]);
    }

    public function test_46_registro_nueva_dev_garantia_detalle_venta_inexistente()
    {
        $user = User::find(1);
        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', ['324324234']);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => '324324234',
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $detalle2 = DevolucionVenta::where('id_detalle_venta', '=', '324324234')->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_47_registro_nueva_dev_garantia_detalle_venta_inexistente_texto_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        $detalle = DetalleVenta::all()->first();
        $product = Product::all()->first();

        DB::delete('delete from devolucion_ventas where id_detalle_venta = ?', ['324324234']);

        $response = $this->post(
            route('store.devolucion'),
            [
                'id_producto_devolucion' => $product->id,
                'id_detalle_venta' => '324324234',
                'fechaDev' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $response->assertInvalid([
            'id_detalle_venta' => 'El detalle de venta no existe en la tabla de detalle de venta.',
        ]);
    }

    public function test_48_registro_nueva_dev_garantia_fecha_devolucion_vacio()
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
                'fechaDev' => '',
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $detalle2 = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_49_registro_nueva_dev_garantia_fecha_devolucion_vacio_mensaje_validacion()
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
                'fechaDev' => '',
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $response->assertInvalid([
            'fechaDev' => 'La fecha de la devolucion es obligatoria',
        ]);
    }

    public function test_50_registro_nueva_dev_garantia_fecha_devolucion_texto_cualquiera()
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
                'fechaDev' => 'asdasdasd',
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $detalle2 = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_51_registro_nueva_dev_garantia_fecha_devolucion_texto_cualquiera_mensaje_validacion()
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
                'fechaDev' => 'asdasdasd',
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $response->assertInvalid([
            'fechaDev' => 'La fecha de la devolucion debe ser una fecha',
        ]);
    }

    public function test_52_registro_nueva_dev_garantia_fecha_devolucion_numero_cualquiera()
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
                'fechaDev' => 123123123,
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $detalle2 = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_53_registro_nueva_dev_garantia_fecha_devolucion_numero_cualquiera_mensaje_validacion()
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
                'fechaDev' => 123123123,
                'des_devolucion' => 'Defecto de frabricacion en el colocado de la lamina',
                'switchDev' => ''
            ]
        );

        $response->assertInvalid([
            'fechaDev' => 'La fecha de la devolucion debe ser una fecha',
        ]);
    }

    public function test_54_registro_nueva_dev_garantia_descripcion_devolucion_vacio()
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
                'des_devolucion' => '',
                'switchDev' => ''
            ]
        );

        $detalle2 = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_55_registro_registro_nueva_dev_garantia_descripcion_devolucion_vacio_mensaje_validacion()
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
                'des_devolucion' => '',
                'switchDev' => ''
            ]
        );

        $response->assertInvalid([
            'des_devolucion' => 'La descripción es obligatorio',
        ]);
    }

    public function test_56_registro_nueva_dev_garantia_descripcion_devolucion_maximo_caracteres()
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
                'des_devolucion' => 'sdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasdasddddddddd',
                'switchDev' => ''
            ]
        );

        $detalle2 = DevolucionVenta::where('id_detalle_venta', '=', $detalle->id_detalle)->get();

        $this->assertFalse(isset($detalle2[0]->id_detalle));
    }

    public function test_57_registro_nueva_dev_garantia_descripcion_devolucion_maximo_caracteres_mensaje_validacion()
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
                'des_devolucion' => 'sdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasdasddddddddd',
                'switchDev' => ''
            ]
        );

        $response->assertInvalid([
            'des_devolucion' => 'La descripción no debe superar los 255 caracteres',
        ]);
    }
}
