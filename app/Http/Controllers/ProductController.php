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
       'Nombre_producto' =>'required|regex:/^([0-9a-zñáéíóúñüàè A-ZÑ]+)(\s[0-9a-zñA-ZÑ ]+)*$/|min:3|max:25',
       'Marca' => 'required|regex:/^([0-9a-zñáéíóúñüàè A-ZÑ]+)(\s[0-9a-zñA-ZÑ ]+)*$/|min:2|max:25',
       'Descripcion' =>"required|min:3|max:150",
       'categoria_id'=>'required',
       'proveedor_id'=>'required',
       'Cantidad',
       'Precio_compra', 
       'Precio_venta',
       'Impuesto',
     ]);
     
    $mesaje=([

    'Nombre_producto.required'=>'El nombre del producto es obligatorio' ,
    'Nombre_producto.min'=>'El nombre del producto debe tener minimo 3 letras' ,
    'Nombre_producto.max'=>'El nombre del producto no debe de tener más de 25 letras' ,

    'Marca.required'=>'La marca del producto es obligatoria' ,
    'Marca.min'=>'La marca debe tener minimo 2 letras' ,
    'Marca.max'=>'La marca no debe de tener más de 25 letras' ,

    'Descripcion.required'=>'La descripción del producto es obligatoria' ,
    'Descripcion.min'=>'La descripción debe tener minimo 3 letras' ,
    'Descripcion.max'=>'La descripción no debe tener más de 150 caracteres' ,

    'categoria_id.required'=>'La categoría es obligatorio', 
    
    'proveedor_id.required'=>'El proveedor es obligatorio' ,
     
    

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

  if ($agregar1){
      return redirect()->route('show.registroProductos')->with('mensaje', 'Se guardó  con  éxito') ;} 
    
      else {
 
           }
   } 

public function guardarProductoModal(Request $request){
   
  $agregar = new Product();
  $agregar->proveedor_id = $request->data['proveedor'];
  $agregar->Nombre_producto =  $request->data['nombre'];
  $agregar->Descripcion =  $request->data['descripcion'];
  $agregar->Marca = $request->data['marca'];
  $agregar->categoria_id =  $request->data['categoria'];
  $agregar->Cantidad = 0;
  $agregar->Precio_compra= 0;
  $agregar->Precio_venta= 0;
  $agregar->Impuesto = 0;
  $agregar1=  $agregar->save();

  $query = 'SELECT p.id as id_product, cat.id as id_cat, prov.id as id_prov, p.Nombre_producto,p.Descripcion,
  p.Marca,p.Precio_compra,p.Precio_venta,p.Cantidad, p.Impuesto, prov.Nombre_empresa, 
  cat.Descripcion as DescripcionC  
  FROM products AS p
  INNER JOIN proveedors  as prov ON p.proveedor_id = prov.id
  INNER JOIN categorias AS cat ON p.categoria_id = cat.id;';
  $productos = DB::select(DB::raw($query));

  return $productos;
}



/*Funcion para ver el listado y buscar el producto */
public function index(Request $request){
  $producto = [];
  $categoria = [];
  $buscar = '';

  if($request->buscar != null && $request->buscar != ''){
    $buscar = $request->buscar;
    $producto =  Product::  
    
    select('categorias.Descripcion as Categoria','products.*')
    ->join('categorias', 'categorias.id', '=', 'products.categoria_id')
    ->where('Nombre_producto', 'like','%'.strtolower($request->buscar).'%')
    ->orwhere('Marca', 'like','%'.strtolower($request->buscar).'%')
    ->paginate(10); 
  }
  else{
    $buscar = '';
    $producto = Product::

    select('categorias.Descripcion as Categoria','products.*')

    ->join('categorias', 'categorias.id', '=', 'products.categoria_id') 
    ->paginate(10);
    // return $producto;
  }

  return view('Productos.ListadoProductos')->with('producto', $producto)->with('buscar',$buscar)->with('categoria', $categoria);
}
} 
