<?php

namespace App\Http\Controllers;
use App\Models\Compra;
use App\Models\CompraDetalles;
use App\Models\Proveedor;
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
  public function actualizarFactura($arrayFac,$arrayDet){
  $jsonFactura =  json_decode($arrayFac);
  $arrayDetallesFac =  json_decode($arrayDet);
  $actu = Compra::find($jsonFactura->id);
  $actu -> Fecha_facturacion = $jsonFactura -> Fecha_facturacion;
  $actu -> Numero_factura = $jsonFactura -> Numero_factura;
  $actu -> Total_factura = $jsonFactura -> Total_factura;
  $actu -> Proveedor = $jsonFactura -> Proveedor;
  $agregar1=  $actu->save();

  CompraDetalles::where('Numero_facturaform',$jsonFactura->Numero_factura)->delete();

  foreach ($arrayDetallesFac as $detFact) {
    $a = new CompraDetalles;
    $a->id_detalle= $detFact ->id_detalle;
    $a->Numero_facturaform = $jsonFactura -> Numero_factura;
    $a->id_prov = $detFact->id_prov ;
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

  $ultimacompra = Compra::where('Numero_factura','=',$jsonFactura -> Numero_factura)->first();
  return redirect()->route('comprasEdit', $ultimacompra->id);
  // return redirect()->route('compra.index');
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

    return view('Compras.RegistroCompras')
    ->with('products',$products)
    ->with('accion',$accion)
    ->with('proveedores',$proveedores)
    ->with('factura',$factura)
    ->with('detallefactura',$detallefactura);
}



/*
|--------------------------------------------------------------------------
| IVENTARIO
|--------------------------------------------------------------------------
*/



   /*Funcion para mostrar mas informacion  */ 
   public function mirar($id){
    $factura = Compra::findOrFail($id);
    return view('Inventario.InformacionInventario')->with('factura', $factura);
}

/*Funcion para mostar el historial de precios*/

  /*Funcion para mostrar mas informacion  */ 
  public function historial(){
    /*$his = Compra::findOrFail($id);*/
    return view('HistorialPrecios.HistorialPrecios');
}

}