<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;
use DB;

class ClienteController extends Controller
{

    /*Funcion para el listado de clientes y el buscador*/ 
    public function index(Request $request){
      $cliente = [];
      $buscar = '';

      if($request->buscar != null && $request->buscar != ''){
        $buscar = $request->buscar;
        $cliente =  Cliente::where(DB::raw("LOWER(concat(Nombre,' ',Apellido))"),"like","%".strtolower($request->buscar)."%")
        ->orwhere('Numero_identidad', 'like','%'.strtolower($request->buscar).'%')
        ->paginate(10); 

        
      }else{
        $buscar = '';
        $cliente = Cliente::paginate(10);
      }

      return view('Clientes.ListadoClientes')->with('clientes', $cliente)->with('buscar',$buscar);
  }

          /*Funcion para mostrar mas informacion del cliente */ 
          public function show($id){
            $ver = Cliente::findOrFail($id);
            return view('Clientes.InformacionCliente')->with('ver', $ver);
        }

          /*Funcion para  guardar  */
            public function guardar(){
               return view('Clientes.RegistroClientes');
          }

          /* Validar  guardar  */
          public function agg(Request $request){

            $rules= ([
              'Nombre' =>'required|min:3|max:25',
              'Apellido' =>'required|min:4|max:25',
              'Numero_identidad' =>'required|unique:clientes|regex:([0-1][0-8][0-2][0-9]{10})|max:13',
              'Numero_telefono' => 'required|unique:clientes|regex:([9,8,3,2]{1}[0-9]{7}) |max:8',
              'Direccion' =>'required',

            ]);
            
  
           $mesaje=([

           'Nombre.required'=>'El nombre del cliente es obligatorio' ,
           'Nombre.min'=>'El nombre debe tener minimo 3 letras' ,
           'Nombre.max'=>'El nombre no debe de tener más de 25 letras' ,
           'Nombre.is_string'=>'Este campo solo debe de contener letras',


          'Apellido.required'=>'El apellido del cliente es obligatorio' ,
          'Apellido.min'=>'El apellido debe tener minimo 4 letras' ,
          'Apellido.max'=>'El apellido  no debe de tener más de 25 letras' ,

          'Numero_identidad.required'=>'El número de identidad es obligatorio' ,
          'Numero_identidad.numeric'=>'El número de identidad solo debe contener números' ,
          'Numero_identidad.min'=>'El número de identidad debe minimo tener 13 números' ,
          'Numero_identidad.max'=>'El número de identidad debe  tener 13 números' ,
          'Numero_identidad.unique'=>'El número de identidad ya ha sido usado' ,
          'Numero_identidad.regex'=>'deebe empezar con 0 o 1 ' ,
          ]);

          $this->validate($request, $rules, $mesaje);

         $agregar = new Cliente();

         $agregar -> Nombre = $request -> input('Nombre');
         $agregar -> Apellido = $request -> input('Apellido');
         $agregar -> Numero_identidad = $request -> input('Numero_identidad');
         $agregar -> Numero_telefono = $request -> input('Numero_telefono');
         $agregar -> Direccion = $request -> input('Direccion');

         $agregar1=  $agregar->save();

        if ($agregar1){
           return redirect()->route('cliente.index')->with('mensaje', 'Se guardó  con  éxito') ;
        } else {
        
      }
   }

   /*Funcion para  actualizar(editar) */
   public function actualizar($id){
    $modificar = Cliente::find($id);
     return view('Clientes.EditarCliente')->with('modificar', $modificar);    
}

public function actu (Request $request, $id){

$request->validate([
    'Nombre' =>'required',
    'Apellido' =>'required',
    'Numero_identidad' =>"required|numeric|unique:clientes,Numero_identidad, $id",
    'Numero_telefono' => "required|numeric|unique:clientes,Numero_telefono, $id",
    'Direccion' =>'required',
  ]); 
        
  $actu = Cliente::find($id);

  $actu -> Nombre = $request -> input('Nombre');
  $actu -> Apellido = $request -> input('Apellido');
  $actu -> Numero_identidad = $request -> input('Numero_identidad');
  $actu -> Numero_telefono = $request -> input('Numero_telefono');
  $actu -> Direccion = $request -> input('Direccion');
 
 $agregar = $actu -> save();

if ($agregar){
    return redirect()->route('cliente.index')->with('mensaje', 'se actualizó exitosamente') ;
  } else {
    
  }
}
}