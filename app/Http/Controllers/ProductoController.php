<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Producto;
use Illuminate\Http\Request;
use DB;
class ProductoController extends Controller
{
    public function getcategorias (){
        $categorias = [];
        $proveedores = [];
        $categorias = Categoria::all();
        $proveedores = Proveedor::select('Nombre_empresa','id')->get();

        return view('Productos/RegistroProductos')->with('categorias',$categorias)->with('proveedores',$proveedores);
    }
}
