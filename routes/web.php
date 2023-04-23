<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\CompraDetallesController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\ReparacionController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\RangoFacturaController;
use App\Http\Controllers\GastoController;
use App\Models\RangoFactura;
use App\Http\Controllers\DevolucionVentaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PlanillaController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/users', function () {
        return view('users');
    })->name('show.users');

    Route::get('/products', function () {
        return view('products');
    })->name('show.products');



    /*
|--------------------------------------------------------------------------
|  RUTAS PARA CLIENTES
|--------------------------------------------------------------------------
*/

    /*Clientes y la ruta para el buscador*/
    Route::get('/Cliente', [ClienteController::class, 'index'])->name('cliente.index');
    Route::post('/Cliente', [ClienteController::class, 'index'])->name('cliente.index');

    /*Para mostrar la infomarcion de cada cliente*/
    Route::get('/Clientes/{id}', [ClienteController::class, 'show'])->name('cliente.mostrar')->where('id', '[0-9]+');

    /*Registro cliente*/
    Route::get('/registroclientes', [ClienteController::class, 'guardar'])->name('show.registroCliente');
    Route::POST('/registroclientes', [ClienteController::class, 'agg'])->name('datos');

    /*Para actualizar el cliente*/
    Route::get('/cliente/{id}/editar', [ClienteController::class, 'actualizar'])->name('cliente.editar');
    Route::put('/cliente/{id}/editar', [ClienteController::class, 'actu'])->name('cliente.update');

    /*Registro de cliente*/
    Route::get('/Clientes/crear', [ClienteController::class, 'create'])->name('cliente.crear');
    Route::post('/guardarClienteMantenimiento', [ClienteController::class, 'guardarClienteMantenimiento'])->name('guardarClienteMantenimiento.guardar');


    Route::get('/Clientess/crear', [ClienteController::class, 'create'])->name('cliente.crear');

    Route::post('/guardarClienteReparacion', [ClienteController::class, 'guardarClienteReparacion'])->name('guardarClienteReparacion.guardar');



    /*
|--------------------------------------------------------------------------
|  RUTAS PARA EMPLEADOS
|--------------------------------------------------------------------------
*/


    /*Empleado*/
    Route::get('/registroempleados', function () {
        return view('RegistroEmpleados');
    })->name('show.registroEmpleado');

    /*Registro empleado*/
    Route::get('/registroempleados', [EmpleadoController::class, 'guardar'])->name('show.registroEmpleado');
    Route::post('/registroempleados', [EmpleadoController::class, 'agg'])->name('datos');

    /*Funcion del listado y buscador del empleado. */
    Route::get('/Empleado', [EmpleadoController::class, 'index'])->name('empleado.index');
    Route::post('/Empleado', [EmpleadoController::class, 'index'])->name('empleado.index');

    /*Para mostrar la infomarcion de cada empleado*/
    Route::get('/Empleados/{id}', [EmpleadoController::class, 'show'])
        ->name('empleado.mostrar')
        ->where('id', '[0-9]+');

    /*Para editar el empleado*/
    Route::get('/empleado/{id}/editar', [EmpleadoController::class, 'actualizar'])->name('empleado.editar');
    Route::put('/empleado/{id}/editar', [EmpleadoController::class, 'actu'])->name('empleado.update');


    /*
|--------------------------------------------------------------------------
|  RUTAS PARA PROVEEDORES
|--------------------------------------------------------------------------
*/
    Route::get('/registroproveedor', function () {
        return view('Proveedores/RegistroProveedores');
    })->name('show.registroProveedores');


    /*Registro proveedor*/
    Route::get('/registroproveedores', [ProveedorController::class, 'guardar'])->name('show.registroProveedor');
    Route::post('/registroproveedores', [ProveedorController::class, 'agg'])->name('datos');

    /*Funcion del listado y buscador del proveedor. */
    Route::get('/Proveedor', [ProveedorController::class, 'index'])->name('proveedor.index');
    Route::post('/Proveedor', [ProveedorController::class, 'index'])->name('proveedor.index');

    /*Para mostrar la infomarcion de cada proveedor*/
    Route::get('/Proveedores/{id}', [ProveedorController::class, 'show'])
        ->name('proveedor.mostrar')
        ->where('id', '[0-9]+');

    /*Para actualizar el proveedor*/
    Route::get('/proveedor/{id}/editar', [ProveedorController::class, 'actualizar'])->name('proveedor.editar');
    Route::put('/proveedor/{id}/editar', [ProveedorController::class, 'actu'])->name('proveedor.update');

    /*
|--------------------------------------------------------------------------
|  RUTAS PARA PRODUCTOS
|--------------------------------------------------------------------------
*/
    Route::get('/registroproductos', [ProductController::class, 'getcategorias', 'guardar'])->name('show.registroProductos');
    Route::POST('/registroproductos', [ProductController::class, 'agg'])->name('datos');

    /*Funcion del listado y buscador del producto. */
    Route::get('/Producto', [ProductController::class, 'index'])->name('producto.index');
    Route::post('/Producto', [ProductController::class, 'index'])->name('producto.index');

    /*
|--------------------------------------------------------------------------
|  RUTAS PARA COMPRAS
|--------------------------------------------------------------------------
*/


    Route::get('/registrocompra', [CompraController::class, 'show'])->name('show.registroCompras');

    Route::get('/guardarFactura/{arrayFac}/{arrayDet}', [CompraController::class, 'guardarFactura']);

    Route::post('/actualizarFactura', [CompraController::class, 'actualizarFactura']);
    Route::get('/comprasEdit/{id}', [CompraController::class, 'comprasEdit'])->name('comprasEdit');
    Route::post('/editardetallepro', [CompraController::class, 'editardetallepro'])->name('editardetallepro');
    Route::post('/agregardetallepro', [CompraController::class, 'agregardetallepro'])->name('agregardetallepro');
    Route::post('/eliminardetallepro', [CompraController::class, 'eliminardetallepro'])->name('eliminardetallepro');


    Route::get('/facturacion', function () {
        return view('Compras/facturacion');
    })->name('show.registroFacturacion');

    Route::get('/listas', function () {
        return view('Compras/Lista');
    });

    /*Funcion del listado y buscador compra. */
    Route::get('/Compra', [CompraController::class, 'index'])->name('compra.index');
    // Route::post('/Compra',[CompraController::class, 'index'])->name('compra.index');

    /*Para mostrar la infomarcion */
    Route::get('/Compras/{id}', [CompraController::class, 'detallecomp'])->name('compra.mostrar')->where('id', '[0-9]+');





    /*
|--------------------------------------------------------------------------
|  RUTAS PARA INVENTARIO
|--------------------------------------------------------------------------
*/


    Route::get('/Inventario', [CompraDetallesController::class, 'index'])->name('inventario.index');
    Route::post('/Inventario', [CompraDetallesController::class, 'index'])->name('inventario.index');
    /*Route::get('/Inventario/{id}', [CompraDetallesController::class, 'show'])->name('show.Inventario')->where('id', '[0-9]+');*/



    Route::get('/Inventario/{id}', [CompraController::class, 'mirar'])->name('inventario.mostrar')->where('id', '[0-9]+');

    /*Historial de precio*/
    Route::get('/Historial', [CompraController::class, 'historial'])->name('historial.mostrar');




    /*
|--------------------------------------------------------------------------
|  RUTAS PARA PEDIDO
|--------------------------------------------------------------------------
*/
    Route::get('/createpedidos', [PedidoController::class, 'create'])->name('create.pedido');
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('index.pedido');
    Route::post('/pedidos', [PedidoController::class, 'index'])->name('index.pedido');
    Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('editar.pedido');
    Route::post('/getProductosProv', [PedidoController::class, 'getProductosProv'])->name('getProductosProv.pedido');
    Route::post('/getProductosDB', [PedidoController::class, 'getProductosDB'])->name('getProductosDB.pedido');
    Route::post('/guardarPedido', [PedidoController::class, 'guardarPedido'])->name('guardarPedido.pedido');
    Route::post('/guardarDetallePedido', [PedidoController::class, 'guardarDetallePedido'])->name('guardarDetallePedido.pedido');
    Route::post('/actualizarDetallePedido', [PedidoController::class, 'actualizarDetallePedido'])->name('actualizarDetallePedido.pedido');
    Route::post('/eliminarDetallePedido', [PedidoController::class, 'eliminarDetallePedido'])->name('eliminarDetallePedido.pedido');
    Route::post('/actualizarPedido', [PedidoController::class, 'actualizarPedido'])->name('actualizarPedido.pedido');
    Route::get('/pedido/{id}', [PedidoController::class, 'detallepedido'])->name('pedido.mostrar')->where('id', '[0-9]+');



    Route::post('/guardarProductoModal', [ProductController::class, 'guardarProductoModal'])->name('guardarProductoModal.store');


    /*
|--------------------------------------------------------------------------
|  RUTAS PARA MANTENIMIENTO
|--------------------------------------------------------------------------
*/


    Route::get('/mantenimiento', [MantenimientoController::class, 'mantenimiento'])->name('RegistroMantenimiento');
    /*Guardar mantenimiento*/

    Route::post('/mantenimiento', [MantenimientoController::class, 'guardar'])->name('show.registroMantenimiento');

    Route::get('/ListadoMantenimiento', [MantenimientoController::class, 'index'])->name('mantenimiento.index');
    Route::get('/mantenimiento/{id}', [MantenimientoController::class, 'mostrar'])->name('mantenimiento.mostrar');
    //Route::get('/mantenimiento/{id}',[MantenimientoController::class, 'mostrar'])->name('mantenimiento.mostrar'); se le quito el id


    Route::post('/actualizarMantenimiento', [MantenimientoController::class, 'actualizarMantenimiento'])->name('actualizarMantenimiento.update');
    Route::post('/guardarFacturaMantenimiento', [MantenimientoController::class, 'guardarFacturaMantenimiento'])->name('guardarFacturaMantenimiento.update');
    // Route::post('/ListadoMantenimiento',[MantenimientoController::class, 'index'])->name('mantenimiento.index');
    Route::get('/mantenimientos/pdf/{id}', [MantenimientoController::class, 'factura_pdf'])->name('pdf.mantenimiento');
    /*Para mostrar la infomarcion de cada mantenimiento*/
    Route::get('/mantenimientos/{id}', [MantenimientoController::class, 'detallemantenimento'])
        ->name('mantenimientos.ver')
        ->where('id', '[0-9]+');



    /*
|--------------------------------------------------------------------------
|  RUTAS PARA REPARACION
|--------------------------------------------------------------------------
*/

    Route::get('/reparacion', [ReparacionController::class, 'reparacion'])->name('RegistroReparacion');

    Route::get('/ListadoReparacion', [ReparacionController::class, 'index'])->name('reparacion.index');


    Route::post('/reparacion', [ReparacionController::class, 'guardar'])->name('show.registroReparacion');
    Route::get('/reparacion/{id}', [ReparacionController::class, 'mostrar'])->name('reparacion.mostrar');
    Route::post('/actualizarReparacion/{id}', [ReparacionController::class, 'actualizarReparacion'])->name('actualizarReparacion.update');

    //Route::get('/reparacion/{id}',[ReparacionController::class, 'mostrar'])->name('reparacion.mostrar');
    Route::get('/repaciones/{id}', [ReparacionController::class, 'detallereparacion'])->name('repacionones.ver')->where('id', '[0-9]+');
    Route::post('/guardarFacturaReparacion', [ReparacionController::class, 'guardarFacturaReparacion'])->name('guardarFacturaReparacion.update');

    Route::get('/repaciones/pdf/{id}', [ReparacionController::class, 'factura_pdf'])->name('pdf.reparacion');
    Route::get('/repaciones/garantia/{id}', [ReparacionController::class, 'garantia_pdf'])->name('pdf.garantia');



    /*
|--------------------------------------------------------------------------
|  RUTAS PARA Factura
|--------------------------------------------------------------------------
*/
    Route::get('/listaRangoFactura', [RangoFacturaController::class, 'index'])->name('RangoFactura.index');
    Route::get('/createRangoFactura', [RangoFacturaController::class, 'create'])->name('create.rangofactura');
    Route::post('/storeRangoFactura', [RangoFacturaController::class, 'store'])->name('store.rangofactura');






    /*
|--------------------------------------------------------------------------
|  RUTAS PARA VENTAS
|--------------------------------------------------------------------------
*/


    Route::get('/venta', [VentaController::class, 'index'])->name('Venta.index');
    Route::get('/registroventa', [VentaController::class, 'show'])->name('show.registroventa');
    Route::get('/guardarventa/{arrayFac}/{arrayDet}', [VentaController::class, 'store'])->name('store.registroventa');
    Route::post('/rangoventa', [RangoFacturaController::class, 'storeVentas'])->name('store.registroRang');
    Route::get('/venta/pdf/{id}', [VentaController::class, 'factura_pdf'])->name('Venta.pdf');
    Route::get('/venta/pdf/garantia/{id}', [VentaController::class, 'garantia_pdf'])->name('VentaGarantia.pdf');
    //Para moestrar la informacion en detalles
    Route::get('/LVentas/{id}', [VentaController::class, 'mostrar'])->name('venta.mostrar');


    /*Para mostrar la infomarcion */

    /*
|--------------------------------------------------------------------------
| Devoluciones GARANTIA DE VENTA
|--------------------------------------------------------------------------
*/

    Route::get('/devoluciongarantiaventa', [DevolucionVentaController::class, 'show'])->name('show.devolucion');
    Route::post('/devoluciongarantiaventa/store', [DevolucionVentaController::class, 'store'])->name('store.devolucion');
    Route::get('/listadodevolucion', [DevolucionVentaController::class, 'index'])->name('devolucion.index');

    Route::get('/detallesdevolucion/{id}', [DevolucionVentaController::class, 'mostrarDev'])->name('devolucion.mostrar');

    Route::post('/editardevolucion/{id}', [DevolucionVentaController::class, 'actualizarDev'])->name('devolucion.editar');
    Route::put('/editardevolucion/editar', [DevolucionVentaController::class, 'actuDev'])->name('devolucion.update');


    /* Route::get('/editardevolucionnn', function () {
    return view('DevolucionesGarantiaVenta.EditarDevolucion');
})->name('show.users'); */

    /*
|--------------------------------------------------------------------------
| RUTAS PARA GASTOS
|--------------------------------------------------------------------------
*/


    Route::get('/gastos', [GastoController::class, 'show'])->name('show.gasto');

    Route::post('/gastos/store', [GastoController::class, 'store'])->name('store.gasto');

    Route::get('/listadodegastos', [GastoController::class, 'index'])->name('gasto.index');

    Route::get('/detallegatos/{id}', [GastoController::class, 'mostrarGas'])->name('gasto.mostrar');

    /*
|--------------------------------------------------------------------------
| RUTAS PARA USUARIOS
|--------------------------------------------------------------------------
*/


    Route::get('/registrousuario', [UsuarioController::class, 'show'])->name('show.registroUsuarios');
    Route::post('/store/usuarios', [UsuarioController::class, 'store'])->name('store.registroUsuarios');
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('index.usuario');


    /*
|--------------------------------------------------------------------------
| RUTAS PARA PLANILLA
|--------------------------------------------------------------------------
*/

    Route::get('/registroplanilla', [PlanillaController::class, 'show'])->name('show.registroPlanilla');
    Route::get('/listadoplanilla', [PlanillaController::class, 'index'])->name('index.planilla');


    Route::PUT('/asistencia', [PlanillaController::class, 'restar_horas'])->name('put.planilla.dias');
    Route::PUT('/asistencia/diurna', [PlanillaController::class, 'diurnas_horas'])->name('put.planilla.hora_diurnas');
    Route::PUT('/asistencia/nocturna', [PlanillaController::class, 'nocturnas_horas'])->name('put.planilla.hora_nocturna');


    Route::delete('/asistencia/eliminar/{id}', [PlanillaController::class, 'eliminar_planilla'])->name('delete.planilla');
    Route::post('/asistencia/guardar/{id}', [PlanillaController::class, 'guardar_planilla'])->name('guardar.planilla');

    //Para moestrar la informacion en detalles
    Route::get('LPlanilla/{id}', [PlanillaController::class, 'mostrar'])->name('planilla.mostrar');
});
