<?php

namespace App\Http\Controllers;
use App\Models\Compra;
use App\Models\CompraDetalles;
use App\Models\Proveedor;
use App\Models\Product;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
/*Funcion para  guardar  */
public function index(Request $request){
  $compras = [];
  $buscar = '';


  if($request->buscar != null && $request->buscar != ''){
    $buscar = $request->buscar;
    //$compras =  Compra::where(DB::raw ('Numero_factura'), "like","%".strtolower($request->buscar)."%")
    //->orwhere('Fecha_facturacion', 'like','%'.strtolower($request->buscar).'%')->paginate(10); --}}

  }
   // $buscar = '';
    //$compras = Compra::paginate(10);



    $compras= DB::table('Compras')
    ->join('proveedors','proveedors.id','=','Compras.proveedor')
    ->select('Compras.id as compras','Compras.Numero_factura','Compras.Fecha_facturacion',
    'proveedors.Nombre_empresa', 'Compras.Total_factura' )
    ->where('Numero_factura',"like","%".$buscar."%")
    ->orWhere("Fecha_facturacion","like","%".$buscar."%")
    ->orWhere("proveedors.Nombre_empresa","like","%".$buscar."%")
    ->get();

    // ->andWhere("Fecha_facturacion",">=",$request->fechafrom)
    // ->andWhere("Fecha_facturacion","<=",$request->fechato)
    // SELECT * FROM compras AS c WHERE c.Fecha_facturacion >= '2022-11-08' AND c.Fecha_facturacion <= '2022-11-09';



    return view('Compras.ListadoCompras' )->with('compras', $compras)->with('buscar', $buscar)->with('mensaje', 'Se guardó  con  éxito') ;
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
    $categorias = Categoria::all();

    return view('Compras.RegistroCompras')->with('products',$products)
    ->with('detallefactura',$detallefactura)
    ->with('accion',$accion)
    ->with('proveedores',$proveedores)
    ->with('categorias',$categorias)
    ->with('factura',$factura);
}



/* La prueba no estaba comprobando la ruta correctamente, pero de igual manera tomamos en cuenta agregar algunas validacionesa en la
 función guardarFactura de compras, la función del test actúadirectamente con la base de datos y no pasara por las validaciones de
  la ruta (POST) creada para guardar la compra */

public function guardarFactura($arrayFac,$arrayDet){

  // pasamos los string parametros a arreglos 
  $jsonFactura =  json_decode($arrayFac);
  $arrayDetallesFac =  json_decode($arrayDet);

    $rules = [
        'Numero_factura' => 'required|regex:/^\d{3}-\d{3}-\d{2}-\d{8}$/|unique:compras,Numero_factura',
        'empleadoVentas' => 'required|regex:/^[a-zA-Z\s]+$/',
        'Fecha_facturacion' => 'required|date',
        'Proveedor' => 'required|regex:/^[a-zA-Z\s]+$/',
        'Total_factura' => 'required|numeric',
    ];

    // Definir mensajes personalizados
    $messages = [
      'Numero_factura.required' => 'El número de factura es requerido.',
        'Numero_factura.regex' => 'El número de factura debe tener el formato 000-000-00-00000000.',
        'Numero_factura.unique' => 'El número de factura ya está en uso.',

        'empleadoVentas.required' => 'El empleado de compras es requerido.',
        'empleadoVentas.regex' => 'El formato del empleado de compras no es válido.',

        'Fecha_facturacion.required' => 'La fecha de factura es requerida.',
        'Fecha_facturacion.date' => 'La fecha de factura debe ser una fecha válida.',

        'Proveedor.required' => 'El proveedor de la factura es requerido.',
        'Proveedor.regex' => 'El formato del proveedor no es válido.',

        'Total_factura.required' => 'El total de factura es requerido.',
        'Total_factura.numeric' => 'El total de factura debe ser un número.',
        
    ];


$validator = Validator::make((array) $jsonFactura, $rules, $messages);

if ($validator->fails()) {
    return redirect()->back()
        ->withErrors($validator)
        ->withInput();
}



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

    return redirect()->route('compra.index')->with('mensaje', 'Se guardó  con  éxito') ;


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

/* Funcion para ver los detalles de la compra*/
public function detallecomp($id){
  $products= [];
  $factura = Compra::select('proveedors.Nombre_empresa as proveedor', 'compras.*')
  ->join('proveedors','proveedors.id', '=', 'compras.proveedor')
  ->where('compras.id', '=', $id)
  ->first();
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

    $product =  DB::table('compra_detalles')
        ->join('proveedors','proveedors.id','=','compra_detalles.id_prov')
        ->join('products','products.id','=','compra_detalles.id_product')
        ->join('categorias','categorias.id','=','compra_detalles.id_cat')
        ->select('products.id as id_producto','products.Nombre_producto',
        DB::raw('SUM(compra_detalles.Cantidad) as Cantidad'), 'compra_detalles.Descripcion',
        'categorias.id','compra_detalles.Marca','categorias.Descripcion AS Categoria',
        'proveedors.Nombre_empresa')->where('products.id','=',$id)->first();

  $historial = DB::table('historial_precios')->where('id_producto','=',$id)->get();

  return view('Inventario.InformacionInventario')->with('product', $product)->with('historial', $historial);
}

/*Funcion para mostar el historial de precios*/

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
