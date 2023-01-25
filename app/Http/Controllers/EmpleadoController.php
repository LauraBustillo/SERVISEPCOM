<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class EmpleadoController extends Controller
{

      /*Funcion para ver el listado y buscar empleado */
      public function index(Request $request){
        $empleado = [];
        $buscar = '';
        if($request->buscar != null && $request->buscar != ''){
          $buscar = $request->buscar;
          $empleado =  Empleado::where(DB::raw("LOWER(concat(Nombres,'',Apellidos))"),"like","%".strtolower($request->buscar)."%")
          ->orwhere('Numero_identidad', 'like','%'.strtolower($request->buscar).'%')
          ->paginate(10); 
        }else{
          $buscar = '';
          $empleado = Empleado::paginate(10);
        }
  
        return view('Empleados.ListadoEmpleados')->with('empleados', $empleado)->with('buscar',$buscar);
    }
   
      /*Funcion para mostrar mas informacion del empleado */ 
      public function show($id){
        $ver = Empleado::findOrFail($id);
        $meses = ['Enero','Febrero','Marzo',
        'Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre',
        'Octubre','Noviembre','Diciembre'];

          $f1 = $ver->Fecha_nacimiento;
          $fechaN = Carbon::parse($f1)->format("m");  
          $monthNac =  $meses[$fechaN -1];
          $fechaNacimiento = Carbon::parse($f1)->format("d")." de ".$monthNac." de ".Carbon::parse($f1)->format("Y");  
          $ver['fechaNacimiento'] = $fechaNacimiento;
         
          $f2 = $ver->Fecha_contrato;
          $fechaC = Carbon::parse($f2)->format("m");  
          $monthCon =  $meses[$fechaC -1];
          $fechaContrato = Carbon::parse($f2)->format("d")." de ".$monthCon." de ".Carbon::parse($f2)->format("Y");
          $ver['fechaContrato'] = $fechaContrato;


        return view('Empleados.InformacionEmpleado')->with('ver', $ver);
      }
 
         /*Funcion para guardar empleado*/
        public function guardar(){
           return view ('Empleados.RegistroEmpleados');
           }

        public function agg (Request $request){

            $rules = ([
            'Nombres' =>'required|regex:/^([a-zñA-ZÑ]+)(\s[a-zñA-ZÑ]+)*$/|min:3|max:25',
            'Apellidos' =>'required|regex:/^([a-zñA-ZÑ]+)(\s[a-zñA-ZÑ]+)*$/|min:4|max:25',
            'Numero_identidad' =>'required|unique:empleados|regex:([0-1]{1}[0-8]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0-9]{8})|min:13',
            'Fecha_nacimiento' =>'required',
            'Numero_telefono' => 'required|unique:empleados|regex:([9,8,3,2]{1}[0-9]{7})|min:8|max:8',
            'Salrio' => 'required|numeric',
            'Fecha_contrato' => 'required',
            'Direccion' =>'required',
          ]); 

           $mesaje=([

            'Nombres.required'=>'El nombre del empleado es obligatorio' ,
            'Nombres.regex'=>'El nombre del empleado solo puede tener letras' ,
            'Nombres.min'=>'El nombre del empleado debe tener minimo 3 letras' ,
            'Nombres.max'=>'El nombre del empleado no debe de tener más de 25 letras',

            'Apellidos.required'=>'El apellido del empleado es obligatorio' ,
            'Apellidos.regex'=>'El apellido del empleado solo puede tener letras' ,
            'Apellidos.min'=>'El apellido del empleado debe tener minimo 4 letras' ,
            'Apellidos.max'=>'El apellido del empleado no debe de tener más de 25 letras' ,

            
            'Numero_identidad.required'=>'El número de identidad es obligatorio' ,
            'Numero_identidad.unique'=>'El número de identidad ya ha sido usado' ,
            'Numero_identidad.min'=>'El número de identidad debe tener minimo 13 números' ,
            'Numero_identidad.max'=>'El número de identidad debe  tener 13 números' ,
            'Numero_identidad.regex'=>'El número de identidad solo debe contener números y empezar con 0 o 1',
        
            'Fecha_nacimiento.required'=>'La fecha de nacimiento es obligatoria' ,
        
            'Numero_telefono.required'=>'El número de teléfono es obligatorio' ,
            'Numero_telefono.min'=>'El número de teléfono debe  tener minimo 8 números' ,
            'Numero_telefono.max'=>'El número de teléfono debe  tener máximo  8 números' ,
            'Numero_telefono.unique'=>'El número de teléfono ya ha sido usado' ,
            'Numero_telefono.regex'=>'El teléfono solo debe contener números y empezar con 2, 3, 8 o 9',

            'Fecha_contrato.required'=>'La fecha de contrato es obligatoria' ,

            'Salrio.required'=>'El salario es obligatorio' ,
            'Salrio.numeric'=>'El salario solo debe contener números' ,

            'Direccion.required'=>'La dirección es obligatoria' ,
        
            
            ]);
        
            $this->validate($request, $rules, $mesaje);

        $nuevoEmpleado = new Empleado();
        //Formulario 
        $nuevoEmpleado -> Nombres = $request -> input('Nombres');
        $nuevoEmpleado -> Apellidos = $request -> input('Apellidos');
        $nuevoEmpleado -> Numero_identidad= $request -> input('Numero_identidad');
        $nuevoEmpleado -> Fecha_nacimiento= $request -> input('Fecha_nacimiento');
        $nuevoEmpleado -> Numero_telefono = $request -> input('Numero_telefono');
        $nuevoEmpleado -> Salrio = $request -> input('Salrio');
        $nuevoEmpleado -> Fecha_contrato= $request -> input('Fecha_contrato');
        $nuevoEmpleado -> Direccion= $request -> input('Direccion');
       
       
        $creado = $nuevoEmpleado->save();

        if ($creado){
            return redirect()->route('empleado.index')
            ->with('mensaje', 'Se guardo exitosamente');
        }else{
           

        }

    }

    /*Funcion para  actualizar empleado */
    public function actualizar($id){
      $modificar = Empleado::find($id);
       return view('Empleados.EditarEmpleado')->with('modificar', $modificar);
       
  }
  
      public function actu (Request $request, $id){
        $rules = ([
          'Nombres' =>'required|regex:/^([a-zñA-ZÑ]+)(\s[a-zñA-ZÑ]+)*$/|min:3|max:25',
          'Apellidos' =>'required|regex:/^([a-zñA-ZÑ]+)(\s[a-zñA-ZÑ]+)*$/|min:4|max:25',
          'Numero_identidad' =>"required|regex:([0-1][0-8][0-2][0-9]{10})|min:13|unique:empleados,Numero_identidad, $id",
          'Fecha_nacimiento' =>'required',
          'Numero_telefono' =>"required|regex:([9,8,3,2]{1}[0-9]{7})|min:8|max:8|unique:empleados,Numero_telefono, $id",
          'Salrio' => 'required|numeric',
          'Fecha_contrato' => 'required',
          'Direccion' =>'required',
        ]); 

         $mesaje=([

          'Nombres.required'=>'El nombre del empleado es obligatorio' ,
          'Nombres.regex'=>'El nombre del empleado solo puede tener letras' ,
          'Nombres.min'=>'El nombre del empleado debe tener minimo 3 letras' ,
          'Nombres.max'=>'El nombre del empleado no debe de tener más de 25 letras',

          'Apellidos.required'=>'El apellido del empleado es obligatorio' ,
          'Apellidos.regex'=>'El apellido del empleado solo puede tener letras' ,
          'Apellidos.min'=>'El apellido del empleado debe tener minimo 4 letras' ,
          'Apellidos.max'=>'El apellido del empleado no debe de tener más de 25 letras' ,

          
          'Numero_identidad.required'=>'El número de identidad es obligatorio' ,
          'Numero_identidad.unique'=>'El número de identidad ya ha sido usado' ,
          'Numero_identidad.min'=>'El número de identidad debe tener minimo 13 números' ,
          'Numero_identidad.max'=>'El número de identidad debe  tener 13 números' ,
          'Numero_identidad.regex'=>'El número de identidad solo debe contener números y empezar con 0 o 1 ' ,
      
          'Fecha_nacimiento.required'=>'La fecha de nacimiento es obligatoria' ,
      
          'Numero_telefono.required'=>'El número de teléfono es obligatorio' ,
          'Numero_telefono.min'=>'El número de teléfono debe  tener minimo 8 números' ,
          'Numero_telefono.max'=>'El número de teléfono debe  tener máximo  8 números' ,
          'Numero_telefono.unique'=>'El número de teléfono ya ha sido usado' ,
          'Numero_telefono.regex'=>'El teléfono solo debe contener números y empezar con 9, 8 o 3' ,

          'Fecha_contrato.required'=>'La fecha de contrato es obligatoria' ,

          'Salrio.required'=>'El salario es obligatorio' ,
          'Salrio.numeric'=>'El salario solo debe contener números' ,

          'Direccion.required'=>'La dirección es obligatoria' ,
      
          
          ]);
        
          $this->validate($request, $rules, $mesaje);
              
        $actu = Empleado::find($id);

        $actu -> Nombres = $request -> input('Nombres');
        $actu -> Apellidos = $request -> input('Apellidos');
        $actu -> Numero_identidad= $request -> input('Numero_identidad');
        $actu -> Fecha_nacimiento= $request -> input('Fecha_nacimiento');
        $actu -> Numero_telefono = $request -> input('Numero_telefono');
        $actu -> Salrio = $request -> input('Salrio');
        $actu -> Fecha_contrato= $request -> input('Fecha_contrato');
        $actu -> Direccion= $request -> input('Direccion');


      $agregar =  $actu -> save();

      if ($agregar){
          return redirect()->route('empleado.index')->with('mensaje', 'Se actualizó exitosamente') ;
        } else {
          
        }
      }
     
}

