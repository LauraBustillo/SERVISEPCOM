<?php
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
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
Route::get('/Cliente',[ClienteController::class, 'index'])->name('cliente.index');
Route::post('/Cliente',[ClienteController::class, 'index'])->name('cliente.index');

/*Para mostrar la infomarcion de cada cliente*/
Route::get('/Clientes/{id}', [ClienteController::class, 'show'])->name('cliente.mostrar')->where('id', '[0-9]+');

/*Registro cliente*/
Route::get('/registroclientes', [ClienteController::class, 'guardar'])  ->name('show.registroCliente');
Route::POST('/registroclientes', [ClienteController::class, 'agg'])->name('datos');

/*Para actualizar el cliente*/
Route::get('/cliente/{id}/editar', [ClienteController::class, 'actualizar'])-> name('cliente.editar');
Route::put('/cliente/{id}/editar', [ClienteController::class, 'actu'])-> name('cliente.update');

/*Registro de cliente*/ 
Route::get('/Clientes/crear', [ClienteController::class, 'create'])->name('cliente.crear');



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
Route::get('/registroempleados', [EmpleadoController::class, 'guardar'])  ->name('show.registroEmpleado');
Route::post('/registroempleados', [EmpleadoController::class, 'agg'])->name('datos');

/*Funcion del listado y buscador del empleado. */
Route::get('/Empleado',[EmpleadoController::class, 'index'])->name('empleado.index');
Route::post('/Empleado',[EmpleadoController::class, 'index'])->name('empleado.index');

 /*Para mostrar la infomarcion de cada empleado*/
 Route::get('/Empleados/{id}', [EmpleadoController::class, 'show'])
 ->name('empleado.mostrar')
 ->where('id', '[0-9]+');

 /*Para editar el empleado*/
Route::get('/empleado/{id}/editar', [EmpleadoController::class, 'actualizar']) -> name('empleado.editar');
Route::put('/empleado/{id}/editar', [EmpleadoController::class, 'actu']) -> name('empleado.update');


/*
|--------------------------------------------------------------------------
|  RUTAS PARA PROVEEDORES
|--------------------------------------------------------------------------
*/
Route::get('/registroproveedor', function () {
    return view('Proveedores/RegistroProveedores');
})->name('show.registroProveedores');


/*Registro proveedor*/
Route::get('/registroproveedores', [ProveedorController::class, 'guardar'])  ->name('show.registroProveedor');
Route::post('/registroproveedores', [ProveedorController::class, 'agg'])->name('datos');

/*Funcion del listado y buscador del proveedor. */
Route::get('/Proveedor',[ProveedorController::class, 'index'])->name('proveedor.index');
Route::post('/Proveedor',[ProveedorController::class, 'index'])->name('proveedor.index');

/*Para mostrar la infomarcion de cada proveedor*/
Route::get('/Proveedores/{id}', [ProveedorController::class, 'show'])
->name('proveedor.mostrar')
->where('id', '[0-9]+');

/*Para actualizar el proveedor*/
Route::get('/proveedor/{id}/editar', [ProveedorController::class, 'actualizar'])-> name('proveedor.editar');
Route::put('/proveedor/{id}/editar', [ProveedorController::class, 'actu'])-> name('proveedor.update');

/*
|--------------------------------------------------------------------------
|  RUTAS PARA PRODUCTOS
|--------------------------------------------------------------------------
*/
Route::get('/registroproducto', [ProductoController::class, 'getcategorias'])-> name('show.registroProductos');




 