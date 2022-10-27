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
  public function index(){
    $compras = Compra::orderBy('created_at', 'DESC')->paginate(10);
    $buscar = '';
    return view('Compras.ListadoCompras' )->with('compras', $compras)->with('buscar', $buscar);
    

}

    /*Funcion para  guardar  */
    public function guardar(){
        return view('Compras.RegistroCompras');
   }

   /*Funcion para  guardar  */
   public function show(){
    // $products = Product::table('')->join();



    $query = 'SELECT p.id as id_product, cat.id as id_cat, prov.id as id_prov, p.Nombre_producto,p.Descripcion,
    p.Marca,p.Precio_compra,p.Precio_venta,p.Cantidad, p.Impuesto, prov.Nombre_empresa, cat.Descripcion as DescripcionC  
    FROM products AS p
    INNER JOIN proveedors  as prov ON p.proveedor_id = prov.id
    INNER JOIN categorias AS cat ON p.categoria_id = cat.id;';
    $accion = 'guardar';
    $today = Carbon::now()->format('Y-m-d');
    // return $today;

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


public function comprasEdit($id){
  $query = 'SELECT p.id as id_product, cat.id as id_cat, prov.id as id_prov, p.Nombre_producto,p.Descripcion,p.Marca,p.Precio_compra,p.Precio_venta,p.Cantidad, p.Impuesto, prov.Nombre_empresa,cat.Descripcion as DescripcionC  FROM products AS p
    INNER JOIN proveedors  as prov ON p.proveedor_id = prov.id
    INNER JOIN categorias AS cat ON p.categoria_id = cat.id;';
    $factura = Compra::where('id','=',$id)->first();
    $detallefactura = CompraDetalles::where('Numero_facturaform','=',$factura->Numero_factura)->get();
    $proveedores = Proveedor::all();
    $products = DB::select(DB::raw($query));
    $accion = 'editar';


    return view('Compras.RegistroCompras')
    ->with('products',$products)
    ->with('accion',$accion)
    ->with('proveedores',$proveedores)
    ->with('factura',$factura)
    ->with('detallefactura',$detallefactura);
}
   /* Validar  guardar  */
   public function agg(Request $request){

     $rules= ([
       'Numero_factura' =>'required|numeric|min:11|max:11',
       'Fecha_facturacion' =>'required|date',
       'Total_factura' =>'required|numeric',
     ]);
     

    $mesaje=([

    'Numero_factura.required'=>'El número de factura es obligatorio',
    'Numero_factura.numeric'=>'El número de factura solo debe contener números',
    'Numero_factura.min'=>'El número de factura debe contener minimo 8 números',
    'Numero_factura.max'=>'El número de factura debe contener máximo 8 números',

    'Fecha_facturacion.required'=>'La fecha de factura es obligatorio',
    'Fecha_facturacion.numeric'=>'La fecha de factura solo debe contener números',

    'Total_factura.required'=>'El total de la factura es obligatorio',
    'Total_factura.numeric'=>'El total de la factura solo debe contener números',
    'Total_factura.min'=>'El total de la factura debe contener minimo 3 números',
    'Total_factura.max'=>'El total de la factura debe contener máximo 5 números',
   ]);

   $this->validate($request, $rules, $mesaje);

  $agregar = new Compra();

  $agregar -> Numero_factura = $request->input('Numero_factura');
  $agregar -> Fecha_facturacion = $request->input('Fecha_facturacion');
  $agregar -> Total_factura = $request->input('Total_factura');

  $agregar1 =  $agregar->save();


 if ($agregar1){
    return redirect()->route('show.registroCompras')->with('mensaje', 'Se guardó  con  éxito') ;
 } else {
 
}
} 
}