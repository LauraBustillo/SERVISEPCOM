<?php
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
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


/*Registro cliente*/
Route::get('/registroclientes', [ClienteController::class, 'guardar'])  ->name('show.registroCliente');
Route::POST('/registroclientes', [ClienteController::class, 'agg'])->name('datos');

/*Para actualizar el cliente*/
Route::get('/cliente/{id}/editar', [ClienteController::class, 'actualizar'])-> name('cliente.editar');
Route::put('/cliente/{id}/editar', [ClienteController::class, 'actu'])-> name('cliente.update');

/*Registro de cliente*/ 
Route::get('/Clientes/crear', [ClienteController::class, 'create'])->name('cliente.crear');













 