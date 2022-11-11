<?php
namespace App\Http\Controllers;
use App\Models\Inventario;
use App\Models\Compra;
use App\Models\CompraDetalles;
use App\Models\Product;
use App\Models\Proveedor;
use Illuminate\Http\Request;

use DB;


class InventarioController extends Controller
{
     
 /*Funcion para el listado  el buscador*/ 
 
 



  /*Funcion para mostrar mas informacion  */ 
  public function show($id){
  $ver = Inventario::findOrFail($id);
     return view('Inventario.InformacionInventario')->with('ver', $ver);
   }

         
      }


