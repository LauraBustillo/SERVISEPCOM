<?php

namespace App\Http\Controllers;
use App\Models\Inventario;
use App\Models\Compra;
use App\Models\CompraDetalles;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use DB;


class InventarioController extends Controller
{
     
 /*Funcion para el listado  el buscador*/ 
 public function index(Request $request){
      $inventario= [];
      $buscar = '';

      if($request->buscar != null && $request->buscar != ''){
        $buscar = $request->buscar;
        $inventario =  Inventario::where(DB::raw("LOWER(concat(Nombre,' ',Apellido))"),"like","%".strtolower($request->buscar)."%")
        ->orwhere('Numero_identidad', 'like','%'.strtolower($request->buscar).'%')
        ->paginate(10); 
      }else{
        $buscar = '';
        $inventario = Inventario::paginate(10);
      }

      return view('Inventario.Inventario')->with('inventario', $inventario)->with('buscar',$buscar);
  }



  /*Funcion para mostrar mas informacion  */ 
  public function show($id){
  $ver = Inventario::findOrFail($id);
     return view('Inventario.InformacionInventario')->with('ver', $ver);
   }

         
      }



