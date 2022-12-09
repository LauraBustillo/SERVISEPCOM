<?php

namespace App\Http\Controllers;
use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use App\Models\Cliente;
use DB;

class MantenimientoController extends Controller
{
    //

    public function index(Request $request){
        $mantenimientos = [];

        $mantenimientos =  Mantenimiento::select('mantenimientos.*','clientes.Nombre','clientes.Apellido')
        ->join('clientes','clientes.id','=','mantenimientos.cliente_id')->get();
  
        return view('Servicios.ListadoMantenimiento')->with('mantenimientos', $mantenimientos);
    }

    public function mantenimiento(){
      $accion = 'agregar';
      $mantenimiento = (object)array("cliente_id"=>"", "Nombre"=>"", "Apellido"=>"", "Numero_telefono"=>"", "Numero_identidad"=>"","Direccion"=>"", 
      "numero_factura"=>"", "fecha_facturacion"=>"", "precio"=>"", "descripcion"=>"",
      "estado"=>"",  "descripcionm"=>"", "categoria"=>"", "nombre_equipo"=>"", "marca"=>"", "modelo"=>"",

      "fecha_ingreso"=>"","fecha_entrega"=>"");
      // return    $mantenimiento ;
      $clientes =DB::table('clientes')->orderBy('id','DESC')->get();
      return view('Servicios.RegistroMantenimiento')->with('clientes',$clientes)->with('mantenimiento',$mantenimiento)->with('accion',$accion);
    }

    
    

    /*Funcion para  guardar  */
    public function guardar(Request $request){

       $rules= ([
   
        'cliente_id'=>'required',
        'categoria'=>'required',
        'nombre_equipo'=>'required|regex:/^([a-zñA-ZÑ]+)(\s[a-zñA-ZÑ]+)*$/|min:4|max:20',
         'marca' =>'required|regex:/^([a-zñA-ZÑ0-9]+)(\s[a-zñA-ZÑ0-9]+)*$/|min:2|max:20',
         'modelo'=>'required|regex:/^([a-zñA-ZÑ0-9]+)(\s[a-zñA-ZÑ0-9]+)*$/|min:4|max:20',
         'descripcionm'=>'required|regex:/^([a-zñA-ZÑ0-9]+)(\s[a-zñA-ZÑ0-9]+)*$/|min:4|max:100',
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

       'descripcionm.required'=>'La descripción es requerido' ,
       'descripcionm.min'=>'La descripción debe tener como mínimo 4 letras' ,
       'descripcionm.max'=>'La descripción debede tener más de 100 letras' ,
       'descripcionm.regex'=>'La descripción solo puede tener letras y números' ,
    
       'fecha_ingreso.required'=>'La fecha de ingreso es requerida' ,
    
       'fecha_entrega.required'=>'La fecha de entrega es requerida' ,
    
       
       ]);
     $this->validate($request, $rules, $mesaje);

      $agregar = new Mantenimiento();
      $agregar->cliente_id = $request -> input('cliente_id');
      $agregar->estado =  'Pendiente';
      $agregar->categoria = $request -> input('categoria');
      $agregar->nombre_equipo = $request -> input('nombre_equipo');
      $agregar->marca = $request -> input('marca');
      $agregar->modelo = $request -> input('modelo');
      $agregar->descripcionm = $request -> input('descripcionm');
      $agregar->fecha_ingreso = $request -> input('fecha_ingreso');
      $agregar->fecha_entrega = $request -> input('fecha_entrega');
      $agregar1=  $agregar->save();

      return redirect()->route('mantenimiento.index')->with('mensaje', 'Se guardó  con  éxito');
    }

 
    

public function actualizarMantenimiento(Request $request){
  $actu = Mantenimiento::find($request->data['id']);
  $actu->estado = $request->data['estado'];
  $actu->numero_factura = $request->data['numero_factura'];
  $actu->fecha_facturacion = $request->data['fecha_facturacion'];
  $actu->precio = $request->data['precio_mantenimiento'];

  $actu->descripcion= $request->data['descripcion_mantenimiento'];
  $actu->categoria = $request->data['categoria'];
  $actu->nombre_equipo = $request->data['nombre_equipo'];
  $actu->marca = $request->data['marca'];
  $actu->modelo = $request->data['modelo'];
  $actu->descripcionm = $request -> input('descripcionm');
  $actu->fecha_ingreso = $request->data['fecha_ingreso'];
  $actu->fecha_entrega = $request->data['fecha_entrega'];
  $agregar = $actu -> save();
  
  $mantenimientos = [];

  $mantenimientos =  Mantenimiento::select('mantenimientos.*','clientes.Nombre','clientes.Apellido')
  ->join('clientes','clientes.id','=','mantenimientos.cliente_id')->get();

  return view('Servicios.ListadoMantenimiento')->with('mantenimientos', $mantenimientos);
  // return redirect()->route('mantenimiento.index')->with('mensaje', 'Se actualizo con éxito');

  
}

public function guardarFacturaMantenimiento(Request $request){
  $actu = Mantenimiento::find($request->data['id_m']);
  $actu->numero_factura = $request->data['numero_facturaM'];
  $actu->fecha_facturacion = $request->data['fecha_facturacionM'];
  $actu->precio = $request->data['precio_mantenimientoM'];
  $actu->descripcion = $request->data['descripcion_mantenimiento'];
  $agregar = $actu -> save();
  return response()->json('actualizado con exito'); 
}


/* Funcion para ver los detalles del mantenimiento*/
public function detallemantenimento($id){
  $products= [];
  $detalle = Mantenimiento::select('clientes.Nombre as Nombre', 'clientes.Apellido as Apellido' , 
  'clientes.Numero_identidad as Identidad', 'clientes.Numero_telefono as Telefono',
  'clientes.Direccion as Direccion',  'mantenimientos.*')
  ->join('clientes','Clientes.id', '=', 'mantenimientos.cliente_id')
  ->where('mantenimientos.id', '=', $id)
  ->first();
  $Cliente = Cliente::all();


  return view('Servicios.InformacionMantenimiento')
  ->with('products',$products)
  ->with('detalle',$detalle)
  ->with('Cliente',$Cliente);
 }

 public function mostrar($id){
  $accion = 'editar';
  $clientes = [];
  $mantenimiento = Mantenimiento::select('mantenimientos.*','clientes.Nombre','clientes.Apellido','clientes.Numero_identidad','clientes.Numero_telefono','clientes.Direccion')
  ->join('clientes','clientes.id','=','mantenimientos.cliente_id')
  ->where('mantenimientos.id','=',$id)
  ->first();

  return view('Servicios.RegistroMantenimiento')->with('clientes',$clientes)->with('mantenimiento',$mantenimiento)->with('accion',$accion);
}

}
