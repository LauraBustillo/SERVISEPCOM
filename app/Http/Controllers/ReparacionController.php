<?php

namespace App\Http\Controllers;
use App\Models\Reparacion;
use Illuminate\Http\Request;
use App\Models\Cliente;
use DB;

class ReparacionController extends Controller
{
    //


    public function index(Request $request){
        $reparaciones = [];

        $reparaciones=  Reparacion::select('reparacions.*','clientes.Nombre','clientes.Apellido')
        ->join('clientes','clientes.id','=','reparacions.cliente_id')->orderBy('created_at','DESC')->get();
  
        return view('Servicios.ListadoReparacion')->with('reparaciones', $reparaciones);
    }

    public function reparacion(){

        $accion = 'agregar';
      $reparacion = (object)array("cliente_id"=>"", "Nombre"=>"", "Apellido"=>"", "Numero_telefono"=>"", "Numero_identidad"=>"","Direccion"=>"", 
      "numero_factura"=>"", "fecha_facturacion"=>"", "precio"=>"", "descripcion"=>"",
      "estado"=>"","numero_factura"=>"", "fecha_factura"=>"", "precio"=>"", "descripcion"=>"",  
       "descripcionr"=>"", "foto"=>"","foto1"=>"","foto2"=>"","foto3"=>"","foto4"=>"",
       "cambio_pieza"=>"","garantia"=>"","categoria"=>"", "nombre_equipo"=>"", "marca"=>"", "modelo"=>"",

      "fecha_ingreso"=>"","fecha_entrega"=>"", "categoria_producto_inv"=>"", "marca_producto_inv"=>"",
      "nombre_producto_inv" =>"", "id_producto_inv" =>"",);
      
      $clientes =DB::table('clientes')->orderBy('id','DESC')->get();

      $inventario =  DB::table('compra_detalles')
      ->join('proveedors','proveedors.id','=','compra_detalles.id_prov')
      ->join('products','products.id','=','compra_detalles.id_product')
      ->join('categorias','categorias.id','=','compra_detalles.id_cat')
      ->select('products.id as id_producto','products.Nombre_producto',
      DB::raw('SUM(compra_detalles.Cantidad  )as Cantidad'), 
      'categorias.id','compra_detalles.Marca','categorias.Descripcion AS Categoria',
      'proveedors.Nombre_empresa')
    ->groupBy("products.id")
      ->get();  
       
        return view('Servicios.RegistroReparacion')
        ->with('clientes',$clientes)
        ->with('reparacion',$reparacion)
        ->with('inventario',$inventario)
        ->with('accion',$accion);
      }



      /*Funcion para  guardar  */
    public function guardar(Request $request){

        $rules= ([
     
          'cliente_id'=>'required',
          'categoria'=>'required',
          'nombre_equipo'=>'required|regex:/^([a-zñA-ZÑ]+)(\s[a-zñA-ZÑ]+)*$/|min:4|max:20',
          'marca' =>'required|regex:/^([a-zñA-ZÑ0-9]+)(\s[a-zñA-ZÑ0-9]+)*$/|min:2|max:20',
          'modelo'=>'required|regex:/^([a-zñA-ZÑ0-9]+)(\s[a-zñA-ZÑ0-9]+)*$/|min:4|max:20',
          'descripcionr'=>'required|regex:/^([a-zñA-ZÑ0-9]+)(\s[a-zñA-ZÑ0-9]+)*$/|min:4|max:200',

          'foto',
          'foto1',
          'foto2',
          'foto3',
          'foto4',
          'cambio_pieza',
          'garantia',

          'fecha_ingreso'=>'required',
          'fecha_entrega'=>'required',
      
         ]);
         $mesaje=([

          'cliente_id.required'=>'Debe agregar un cliente',
          'categoria.required'=>'La categoría es requerida',


          'nombre_equipo.required'=>'El nombre del equipo es requerido' ,
          'nombre_equipo.regex'=>'El nombre del equipo solo debe tener letras' ,
          'nombre_equipo.min'=>'El nombre del equipo debe tener mínimo 4 letras' ,
          'nombre_equipo.max'=>'El nombre del equipo  no debe de tener más de 25 letras' ,

          'marca.required'=>'La marca es requerida' ,
          'marca.min'=>'La marca debe tener como mínimo 2 letras' ,
          'marca.max'=>'La marca no debe de tener más de 25 letras' ,
          'marca.regex'=>'La marca solo puede tener letras y números' ,

          'modelo.required'=>'El modelo es requerido' ,
          'modelo.regex'=>'El modelo solo puede tener letras y números' ,


          'descripcionr.required'=>'La descripción es requerido' ,
          'descripcionr.min'=>'La descripción debe tener como mínimo 4 letras' ,
          'descripcionr.max'=>'La descripción debede tener más de 15 letras' ,
          'descripcionr.regex'=>'La descripción solo puede tener letras y números' ,

           //FALTA 
          'foto',
          'cambio_pieza',
          'garantia',

          'fecha_ingreso.required'=>'La fecha de ingreso es requerida' ,
    
          'fecha_entrega.required'=>'La fecha de entrega es requerida' ,

         
         ]);
       $this->validate($request, $rules, $mesaje);
  
        $agregar = new Reparacion();
        $agregar->cliente_id = $request -> input('cliente_id');
        $agregar->estado =  'Pendiente';
        $agregar->categoria = $request -> input('categoria');
        $agregar->nombre_equipo = $request -> input('nombre_equipo');
        $agregar->marca = $request -> input('marca');
        $agregar->modelo = $request -> input('modelo');
        $agregar->descripcionr = $request -> input('descripcionr');


        $agregar->foto = $request -> input('foto');
        $agregar->foto1 = $request -> input('foto1');
        $agregar->foto2 = $request -> input('foto2');
        $agregar->foto3 = $request -> input('foto3');
        $agregar->foto4 = $request -> input('foto4');

        if($request->switchCambioPieza){
          $agregar->cambio_pieza = 'Si';
          $agregar->categoria_producto_inv = $request -> input('categoria_producto_inv');
          $agregar->marca_producto_inv = $request -> input('marca_producto_inv');
          $agregar->nombre_producto_inv = $request -> input('nombre_producto_inv');
          $agregar->id_producto_inv = $request -> input('id_producto_inv');          
        }

        if($request->switchGarantia){
          $agregar->garantia = "Si";
        }else{
          $agregar->garantia = "No";
        }  
      
        $agregar->fecha_ingreso = $request -> input('fecha_ingreso');
        $agregar->fecha_entrega = $request -> input('fecha_entrega');
        $agregar1=  $agregar->save();
  
        return redirect()->route('reparacion.index')->with('mensaje', 'Se guardó  con  éxito');
      }

      public function actualizarReparacion(Request $request){


        $actu = Reparacion::find($request->data['id']);

        $actu->estado = $request->data['estado'];        
        $actu->numero_factura = $request->data['numero_factura'];        
        $actu->fecha_factura = $request->data['fecha_factura'];        
        $actu->precio = $request->data['precio'];        
        $actu->descripcion = $request->data['descripcion'];        

        $actu->cambio_pieza = $request->data['cambio_pieza'];        
        $actu->categoria_producto_inv = $request->data['categoria_producto_inv'];
        $actu->marca_producto_inv = $request->data['marca_producto_inv'];
        $actu->nombre_producto_inv = $request->data['nombre_producto_inv'];
        $actu->id_producto_inv = $request->data['id_producto_inv'];
        $actu->garantia = $request->data['garantia'];

        $actu->fecha_ingreso = $request->data['fecha_ingreso'];
        $actu->fecha_entrega = $request->data['fecha_entrega'];
        $agregar = $actu -> save();

        return response()->json("actualizado correctamente");
    
        
  }


      /* Funcion para ver los detalles de reparacion */
public function detallereparacion($id){
  $products= [];
  $detalle = Reparacion::select('clientes.Nombre as Nombre', 'clientes.Apellido as Apellido' , 
  'clientes.Numero_identidad as Identidad', 'clientes.Numero_telefono as Telefono',
  'clientes.Direccion as Direccion',  'reparacions.*')
  ->join('clientes','Clientes.id', '=', 'reparacions.cliente_id')
  ->where('reparacions.id', '=', $id)
  ->first();
  $Cliente = Cliente::all();
 

  return view('Servicios.InformacionReparacion')
  ->with('products',$products)
  ->with('detalle',$detalle)
  ->with('Cliente',$Cliente);
 }

 public function mostrar($id){
   
  $accion = 'editar';
  $clientes = [];
  $inventario =  DB::table('compra_detalles')
  ->join('proveedors','proveedors.id','=','compra_detalles.id_prov')
  ->join('products','products.id','=','compra_detalles.id_product')
  ->join('categorias','categorias.id','=','compra_detalles.id_cat')
  ->select('products.id as id_producto','products.Nombre_producto',
  DB::raw('SUM(compra_detalles.Cantidad  )as Cantidad'), 
  'categorias.id','compra_detalles.Marca','categorias.Descripcion AS Categoria',
  'proveedors.Nombre_empresa')
->groupBy("products.id")
  ->get();  

  $reparacion = Reparacion::select('reparacions.*','clientes.Nombre','clientes.Apellido','clientes.Numero_identidad','clientes.Numero_telefono','clientes.Direccion')
  ->join('clientes','clientes.id','=','reparacions.cliente_id')
  ->where('reparacions.id','=',$id)
  ->first();




  return view('Servicios.RegistroReparacion')
  ->with('clientes',$clientes)
  ->with('reparacion',$reparacion)
  ->with('inventario',$inventario)
  ->with('accion',$accion);
}


public function guardarFacturaReparacion(Request $request){
    $actu = Reparacion::find($request->data['id']);
    $actu->numero_factura = $request->data['numero_facturaR'];
    $actu->fecha_factura = $request->data['fecha_facturacionR'];
    $actu->precio = $request->data['precio_reparacion'];
    $actu->descripcion = $request->data['descripcion_reparacion'];
    $agregar = $actu -> save();
    return response()->json('actualizado con exito'); 
  }



  
}


