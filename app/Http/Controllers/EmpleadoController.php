<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use Illuminate\Http\Request;
use DB;

class EmpleadoController extends Controller
{
   
         /*Funcion para guardar empleado*/
        public function guardar(){
           return view ('Empleados.RegistroEmpleados');
           }

        public function agg (Request $request){

            $rules = ([
            'Primer_nombre' =>'required|min:3|max:25',
            'Primer_apellido' =>'required|min:4|max:25',

            'Numero_identidad' =>'required|unique:empleados|regex:([0-1][0-8][0-2][0-9]{10})|max:13',
            'Fecha_nacimiento' =>'required',
            'Numero_telefono' => 'required|unique:empleados|regex:([9,8,3]{1}[0-9]{7}) |max:8',
            'Salrio' => 'required|numeric',
            'Fecha_contrato' => 'required',
            'Direccion' =>'required',
          ]); 

           $mesaje=([

            'Primer_nombre.required'=>'El primer nombre del empleado es obligatorio' ,
            'Primer_nombre.min'=>'El primer nombre debe tener minimo 3 letras' ,
            'Primer_nombre.max'=>'El nombre no debe de tener más de 25 letras' ,


            'Primer_apellido.required'=>'El primer apellido del empleado es obligatorio' ,
            'Primer_apellido.min'=>'El apellido debe tener minimo 4 letras' ,
            'Primer_apellido.max'=>'El apellido  no debe de tener más de 25 letras' ,

            
            'Numero_identidad.required'=>'El número de identidad es obligatorio' ,
            'Numero_identidad.numeric'=>'El número de identidad solo debe contener números' ,
            'Numero_identidad.min'=>'El número de identidad debe minimo tener 13 números' ,
            'Numero_identidad.max'=>'El número de identidad debe  tener 13 números' ,
            'Numero_identidad.unique'=>'El número de identidad ya ha sido usado' ,
            'Numero_identidad.regex'=>'' ,
        
            'Fecha_nacimiento.required'=>'La fecha de nacimiento es obligatorio' ,
           
        
            'Numero_telefono.required'=>'El número de teléfono es obligatorio' ,
            'Numero_telefono.numeric'=>'El número de  teléfono solo debe contener números' ,
            'Numero_telefono.min'=>'El número de teléfono debe  tener minimo 8 números' ,
            'Numero_telefono.max'=>'El número de teléfono debe  tener máximo  8 números' ,
            'Numero_telefono.unique'=>'El número de teléfono ya ha sido usado' ,
            'Numero_telefono.regex'=>'El teléfono debe de empezar con 9, 8 o 3' ,

            'Salrio.required'=>'El salario es obligatorio' ,
            'Salrio.numeric'=>'El salario solo debe contener números' ,

            'Direccion.required'=>'La dirección es obligatoria' ,
        
            
            ]);
        
            $this->validate($request, $rules, $mesaje);

        $nuevoEmpleado = new Empleado();
        //Formulario 
        $nuevoEmpleado -> Primer_nombre = $request -> input('Primer_nombre');
        $nuevoEmpleado -> Segundo_nombre = $request -> input('Segundo_nombre');
        $nuevoEmpleado -> Primer_apellido = $request -> input('Primer_apellido');
        $nuevoEmpleado -> Segundo_apellido = $request -> input('Segundo_apellido');
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
     
}

