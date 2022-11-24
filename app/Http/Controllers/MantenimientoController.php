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
      "estado"=>"", "categoria"=>"", "nombre_equipo"=>"", "marca"=>"", "modelo"=>"",

      "fecha_ingreso"=>"","fecha_entrega"=>"");
      // return    $mantenimiento ;
      $clientes =DB::table('clientes')->orderBy('id','DESC')->get();
      return view('Servicios.RegistroMantenimiento')->with('clientes',$clientes)->with('mantenimiento',$mantenimiento)->with('accion',$accion);;
    }

    


    /*Funcion para  guardar  */
    public function guardar(Request $request){

      $rules= ([
   
        'cliente_id'=>'required',
        'categoria'=>'required',
        'nombre_equipo'=>'required|min:4|max:25',
         'marca' =>'required|min:2|max:25',
         'modelo'=>'required|min:4|max:25',
         'fecha_ingreso'=>'required',
         'fecha_entrega'=>'required',
    
       ]);
       $mesaje=([
    
      'cliente_id.required'=>'Debe agregar un cliente',
      'categoria.required'=>'La categoría es requerida',
    
       'nombre_equipo.required'=>'El nombre del equipo es requerido' ,
       'nombre_equipo.min'=>'El nombre del equipo debe tener minimo 4 letras' ,
       'nombre_equipo.max'=>'El nombre del equipo  no debe de tener más de 25 letras' ,
    
       'marca.required'=>'La marca es requerida' ,
       'marca.min'=>'La marca debe tener como minimo 2 letras' ,
       'marca.max'=>'La marca no debe de tener más de 25 letras' ,
    
       'modelo.required'=>'El modelo es requerido' ,
       'modelo.min'=>'El modelo debe tener como minimo 4 letras' ,
       'modelo.max'=>'El modelo no debe de tener más de 25 letras' ,
    
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
  $actu->fecha_ingreso = $request->data['fecha_ingreso'];
  $actu->fecha_entrega = $request->data['fecha_entrega'];
  $agregar = $actu -> save();
  
  $mantenimientos = [];

  $mantenimientos =  Mantenimiento::select('mantenimientos.*','clientes.Nombre','clientes.Apellido')
  ->join('clientes','clientes.id','=','mantenimientos.cliente_id')->get();

  return view('Servicios.ListadoMantenimiento')->with('mantenimientos', $mantenimientos);
  // return redirect()->route('mantenimiento.index')->with('mensaje', 'Se actualizo con éxito');

  
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
