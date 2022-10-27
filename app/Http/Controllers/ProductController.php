<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;
class ProductController extends Controller
{
    public function getcategorias(){
        $categorias = [];
        $proveedores = [];
        $categorias = Categoria::all();
        $proveedores = Proveedor::select('Nombre_empresa','id')->get();

        return view('Productos.RegistroProductos')->with('categorias',$categorias)->with('proveedores',$proveedores);
    }

    /*Funcion para  guardar  */
    public function guardar(){
        return view('Productos.RegistroProductos');
   }

   /* Validar  guardar  */
   public function agg(Request $request){

     $rules= ([
       'proveedor_id'=>'required',
       'Nombre_producto' =>'required',
       'Descripcion' =>'required',
       'Marca' => 'required',
       'categoria_id'=>'required',
       'Cantidad' =>'required',
       'Precio_compra' =>'required',
       'Precio_venta' =>'required',
       'Impuesto' =>'required',

     ]);
     

    $mesaje=([


   ]);

   $this->validate($request, $rules, $mesaje);

  $agregar = new Product();

  $agregar -> proveedor_id = $request ->proveedor_id;
  $agregar -> Nombre_producto = $request -> input('Nombre_producto');
  $agregar -> Descripcion = $request -> input('Descripcion');
  $agregar -> Marca = $request -> input('Marca');
  $agregar -> categoria_id = $request ->categoria_id;
  $agregar -> Cantidad = $request -> input('Cantidad');
  $agregar -> Precio_compra= $request -> input('Precio_compra');
  $agregar -> Precio_venta= $request -> input('Precio_venta');
  $agregar -> Impuesto = $request -> input('Impuesto');

  $agregar1=  $agregar->save();

/*    if ($agregar1){
      return redirect()->route('')->with('mensaje', 'Se guardó  con  éxito') ;} 
    
      else {
 
           }
   } */

}

/*Funcion para ver el listado y buscar el producto */
public function index(Request $request){
  $producto = [];
  $categoria = [];
  $buscar = '';

  if($request->buscar != null && $request->buscar != ''){
    $buscar = $request->buscar;
    $producto =  Product::where(DB::raw("LOWER(concat(Nombres,'',Apellidos))"),"like","%".strtolower($request->buscar)."%")
    ->orwhere('Numero_identidad', 'like','%'.strtolower($request->buscar).'%')
    ->paginate(10); 
  }else{
    $buscar = '';
    $producto = Product::paginate(10);
  }

  return view('Productos.ListadoProductos')->with('producto', $producto)->with('buscar',$buscar)->with('categoria', $categoria);
}
}