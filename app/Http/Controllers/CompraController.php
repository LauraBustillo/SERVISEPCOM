<?php

namespace App\Http\Controllers;
use App\Models\Compra;
use App\Models\CompraDetalles;
use App\Models\Proveedor;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class CompraController extends Controller
{
  /*Funcion para  guardar  */
public function index(Request $request){
  $compras = [];
  $buscar = '';
  
  if($request->buscar != null && $request->buscar != ''){
    $buscar = $request->buscar;
    $compras =  Compra::where(DB::raw ('Numero_factura'), "like","%".strtolower($request->buscar)."%")
    ->orwhere('Fecha_facturacion', 'like','%'.strtolower($request->buscar).'%')->paginate(10); 
   
  }else{
    $buscar = '';
    $compras = Compra::paginate(10);
  }

    return view('Compras.ListadoCompras' )->with('compras', $compras)->with('buscar', $buscar);
}

  /*Funcion para  guardar  */
  // public function guardar(){
  //     return view('Compras.RegistroCompras');
  // }


/*Funcion para  guardar  */
public function show(){

    $query = 'SELECT p.id as id_product, cat.id as id_cat, prov.id as id_prov, p.Nombre_producto,p.Descripcion,
    p.Marca,p.Precio_compra,p.Precio_venta,p.Cantidad, p.Impuesto, prov.Nombre_empresa, 
    cat.Descripcion as DescripcionC  
    FROM products AS p
    INNER JOIN proveedors  as prov ON p.proveedor_id = prov.id
    INNER JOIN categorias AS cat ON p.categoria_id = cat.id;';
    $accion = 'guardar';
    $today = Carbon::now()->format('Y-m-d');

    $detallefactura = [];
    $factura = array("Numero_factura"=>"","Fecha_facturacion"=>$today,"Total_factura"=>0,"Telefono_proveedor"=>'',"Proveedor"=>"");
    $products = DB::select(DB::raw($query));
    $proveedores = Proveedor::all();

    return view('Compras.RegistroCompras')->with('products',$products)
    ->with('detallefactura',$detallefactura)
    ->with('accion',$accion)
    ->with('proveedores',$proveedores)
    ->with('factura',$factura);
}

public function guardarFactura($arrayFac,$arrayDet){
 
  // pasamos los string parametros a arreglos
  $jsonFactura =  json_decode($arrayFac);
  $arrayDetallesFac =  json_decode($arrayDet);

  $agregar = new Compra();
  $agregar -> Fecha_facturacion = $jsonFactura -> Fecha_facturacion;
  $agregar -> Numero_factura = $jsonFactura -> Numero_factura;
  $agregar -> Total_factura = $jsonFactura -> Total_factura;
  $agregar -> Proveedor = $jsonFactura -> Proveedor;
  $agregar1=  $agregar->save();

  foreach ($arrayDetallesFac as $detFact) {
    $a = new CompraDetalles;
    $a->id_detalle= $detFact->id_detalle;
    $a->Numero_facturaform = $detFact->Numero_facturaform;
    $a->id_prov = $detFact->id_prov;

    $a->id_product = $detFact->id_product ;
    $a->nombre_producto = $detFact->nombre_producto ;
    $a->Descripcion = $detFact->Descripcion ;
    $a->Marca = $detFact->Marca ;
    $a->id_cat = $detFact->id_cat;
    $a->Categoria = $detFact->Categoria ;
    $a->Cantidad= $detFact->Cantidad ;
    $a->Costo= $detFact->Costo; 
    $a->Precio_venta= $detFact->Precio_venta; 
    $a->Impuesto= $detFact->Impuesto;
    $agregar1=  $a->save();
  }

  // $ultimacompra = Compra::where('Numero_factura','=',$jsonFactura -> Numero_factura)->first();
  // return redirect()->route('comprasEdit', $ultimacompra->id);
  return redirect()->route('compra.index');
}


  //Funcion para actualizar
public function actualizarFactura(Request $request){
  $actu = Compra::find($request->data['id']);
  $actu -> Total_factura = $request -> data['Total_factura'];
  $agregar1 =  $actu->save();
  return  $agregar1;
}

//Funcion para editar
public function comprasEdit($id){

    $query = 'SELECT p.id as id_product, cat.id as id_cat, prov.id as id_prov, p.Nombre_producto,p.Descripcion,p.Marca,p.Precio_compra,p.Precio_venta,p.Cantidad, p.Impuesto, prov.Nombre_empresa,cat.Descripcion as DescripcionC  FROM products AS p
    INNER JOIN proveedors  as prov ON p.proveedor_id = prov.id
    INNER JOIN categorias AS cat ON p.categoria_id = cat.id;';
    $products = DB::select(DB::raw($query));

    $factura = Compra::where('id','=',$id)->first();
    $detallefactura = CompraDetalles::where('Numero_facturaform','=',$factura->Numero_factura)->get();
    $proveedores = Proveedor::all();
    $accion = 'editar';

    $saludo = 'hola laura';
    return view('Compras.RegistroCompras')
    ->with('products',$products)
    ->with('accion',$accion)
    ->with('proveedores',$proveedores)
    ->with('factura',$factura)
    ->with('detallefactura',$detallefactura)->with('saludo',$saludo);
}


/*
|--------------------------------------------------------------------------
| IVENTARIO
|--------------------------------------------------------------------------
*/

/* Funcion para ver los detalles de la compra*/
public function detallecomp($id){
  $products= [];
  $products=DB::select(DB::raw("SELECT p.id as id_product, cat.id as id_cat, prov.id as id_prov, p.Nombre_producto,p.Descripcion,
  p.Marca,p.Precio_compra,p.Precio_venta,p.Cantidad, p.Impuesto, prov.Nombre_empresa,cat.Descripcion as DescripcionC 
  FROM products AS p
  INNER JOIN proveedors  as prov ON p.proveedor_id = prov.id
  INNER JOIN categorias AS cat ON p.categoria_id = cat.id;"));
  

  $factura = Compra::where('id','=',$id)->first();
  $detallefactura = CompraDetalles::where('Numero_facturaform','=',$factura->Numero_factura)->get();
  $proveedores = Proveedor::all();


  return view('Compras.InformacionCompras')
  ->with('products',$products)
  ->with('proveedores',$proveedores)
  ->with('factura',$factura)
  ->with('detallefactura',$detallefactura);
 }

   /*Funcion para mostrar mas informacion  */ 
public function mirar($id){

    $product = Product::
    select('categorias.Descripcion as Categoria','proveedors.Nombre_empresa as Proveedor','products.*')
    ->join('categorias', 'categorias.id', '=', 'products.categoria_id') 
    ->join('proveedors', 'proveedors.id', '=', 'products.proveedor_id') 
    ->where('products.id','=',$id)
    ->first();

  $historial = DB::table('historial_precio')->where('id_producto','=',$id)->get();
  
  return view('Inventario.InformacionInventario')->with('product', $product)->with('historial', $historial);
}

/*Funcion para mostar el historial de precios*/

  /*Funcion para mostrar mas informacion  */ 
  public function editardetallepro(Request $request){
   $actu =   DB::select(DB::raw("UPDATE compra_detalles SET
     Cantidad = '".$request->data['Cantidad']."',
     Costo = '".$request->data['Costo']."',
     Precio_venta = '".$request->data['Precio_venta']."',
     Impuesto = '".$request->data['Impuesto']."'
     WHERE id_detalle = '".$request->data['id']."'
    "));
    return $actu;
  }

  public function agregardetallepro(Request $request){
    $a = new CompraDetalles;
    $a->id_detalle= $request->data['id_detalle'];
    $a->Numero_facturaform = $request->data['Numero_facturaform'];
    $a->id_prov = $request->data['id_prov'];
    
    $a->id_product = $request->data['id_product'] ;
    $a->nombre_producto = $request->data['nombre_producto'] ;
    $a->Descripcion = $request->data['Descripcion'] ;
    $a->Marca = $request->data['Marca'] ;
    $a->id_cat = $request->data['id_cat'];
    $a->Categoria = $request->data['Categoria'] ;
    $a->Cantidad= $request->data['Cantidad'] ;
    $a->Costo= $request->data['Costo']; 
    $a->Precio_venta= $request->data['Precio_venta']; 
    $a->Impuesto= $request->data['Impuesto'];
    $agregar1=  $a->save();
   }

   public function eliminardetallepro(Request $request){
    CompraDetalles::where('id_detalle',$request->data)->delete();  
   }
  



  }