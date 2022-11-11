<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers;
use App\Models\CompraDetalles;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use DB;

class CompraDetallesController extends Controller
{

  public function index(Request $request)
    {
        $inventario= [];
        $buscar = '';
  
        if($request->buscar != null && $request->buscar != ''){
          $buscar = $request->buscar;          
        }


        $inventario =  DB::table('compra_detalles')
        ->join('proveedors','proveedors.id','=','compra_detalles.id_prov')
        ->join('products','products.id','=','compra_detalles.id_product')
        ->join('categorias','categorias.id','=','compra_detalles.id_cat')
        ->select('products.id as id_producto','products.Nombre_producto',DB::raw('SUM(compra_detalles.Cantidad) as Cantidad'),
        'categorias.id','compra_detalles.Marca','categorias.Descripcion AS Categoria','proveedors.Nombre_empresa')
        ->where("products.Nombre_producto","like","%".$buscar."%")
        ->orWhere("categorias.Descripcion","like","%".$buscar."%")
        ->orWhere("proveedors.Nombre_empresa","like","%".$buscar."%")
        ->orWhere("compra_detalles.Marca","like","%".$buscar."%")
        ->groupBy("products.id")
        ->paginate(10);
  
        return view('Inventario.Inventario')->with('inventario', $inventario)->with('buscar',$buscar);
    }
  
   
      

  
        
          // $inventario = DB::select(DB::raw("SELECT SUM(c.Cantidad) AS cantidad,
          // c.Marca,prov.Nombre_empresa,prod.Nombre_producto,cat.Descripcion AS Categoria FROM compra_detalles AS c 
          // inner join proveedors AS prov ON prov.id = c.id_prov
          // INNER JOIN products AS prod ON prod.id = c.id_product
          // INNER JOIN categorias AS cat ON cat.id = c.id_cat
          // GROUP BY c.id_cat,c.id_product
          // where prod.Nombre_producto = '".$request->buscar."';")); 
          
        
//           $inventario = DB::table('compra_detalles as c')
//           ->select('c.Marca',
//           'prov.Nombre_empresa','prod.Nombre_producto',
// 'cat.Descripcion AS Categoria')->pluck('sum','c.Cantidad')
// ->join('proveedors as prov', 'prov.id', '=', 'c.id_prov')
// ->join('products as prod', 'prod.id', '=', 'c.id_product')
// ->join('categorias as cat', 'cat.id', '=', 'c.id_cat')
// ->groupBy('c.id_cat','c.id_product')
// ->paginate(10); 
// ->where('prod.Nombre_producto', 'like','%'.strtolower($request->buscar).'%')

//  CompraDetalles::select(DB::raw("SELECT c.id, SUM(c.Cantidad) AS Cantidad,c.Marca,prov.Nombre_empresa,prod.Nombre_producto,cat.Descripcion AS Categoria FROM compra_detalles AS c 
//  inner join proveedors AS prov ON prov.id = c.id_prov
//  INNER JOIN products AS prod ON prod.id = c.id_product
//  INNER JOIN categorias AS cat ON cat.id = c.id_cat
//  GROUP BY c.id_cat,c.id_product;"))
//  ->paginate(10); 
          
        // $proveedor = DB::Table('proveedors')->
        // join('compra_detalles', 'compra_
        // detalles.id', '=' , 'proveedors.id')->
        // select ('proveedors.Nombre_empresa', )-> get();

        // dd($proveedor);

    public function show()
    {
        
        $inventario = DB::select(DB::raw("SELECT prov.Nombre_empresa,
        FROM compra_detalles AS c 
        inner join proveedors AS prov ON prov.id = c.id_prov ;"));

        $detalles = CompraDetalles::all();
    
        return view('show.Inventario')->with('inventario', $inventario)->with('detalles',$detalles);
    }


}
