<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    //








     /*Funcion para guardar empleado*/
     public function guardar(){
        return view ('Proveedores.RegistroProveedores');
        }

     public function agg (Request $request){

         $rules = ([
         'Nombre_empresa'=>'required|min:3|max:25',
         'Direccion' =>'required',
         'Correo'=>'required|email|unique:proveedors|regex:(#^[\w.-]+@[\w.-]+\.[a-zA-Z]$#)|max:30',
         'Telefono_empresa' => 'required|unique:proveedors|regex:([9,8,3,2]{1}[0-9]{7}) |max:8',
         'Nombre_encargado' =>'required|min:3|max:25',
         'Apellido_encargado' =>'required|min:4|max:25',
         'Telefono_encargado' => 'required|unique:proveedors|regex:([9,8,3,2]{1}[0-9]{7}) |max:8',
          
       ]); 

        $mesaje=([

         'Nombre_empresa.required'=>'El nombre de la empresa es obligatorio' ,
         'Nombre_empresa.min'=>'El nombre de la empresa debe tener minimo 3 letras' ,
         'Nombre_empresa.max'=>'El nombre de la empresa no debe de tener más de 25 letras' ,

         'Direccion.required'=>'La dirección es obligatoria' ,
     
         'Correo.required'=>'El correo es obligatorio' ,
         'Correo.unique'=>'El correo ya ha sido usado' ,
         'Correo.max'=>'El correo no debe tener más de 30 caracteres' ,

         'Telefono_empresa.required'=>'El número de teléfono es obligatorio' ,
         'Telefono_empresa.numeric'=>'El número de  teléfono solo debe contener números' ,
         'Telefono_empresa.min'=>'El número de teléfono debe  tener minimo 8 números' ,
         'Telefono_empresa.max'=>'El número de teléfono debe  tener máximo  8 números' ,
         'Telefono_empresa.unique'=>'El número de teléfono ya ha sido usado' ,
         'Telefono_empresa.regex'=>'El teléfono debe de empezar con 9, 8 o 3' ,

         'Nombre_encargado.required'=>'El nombre del encargado es obligatorio' ,
         'Nombre_encargado.min'=>'El nombre del encargado  debe tener minimo 3 letras' ,
         'Nombre_encargado.max'=>'El nombre del encargado  no debe de tener más de 25 letras' ,
     

         'Apellido_encargado.required'=>'El apellido del encargado es obligatorio' ,
         'Apellido_encargado.min'=>'El apellido debe tener minimo 4 letras' ,
         'Apellido_encargado.max'=>'El apellido  no debe de tener más de 25 letras' ,
     
         'Telefono_encargado.required'=>'El número de teléfono es obligatorio' ,
         'Telefono_encargado.numeric'=>'El número de  teléfono solo debe contener números' ,
         'Telefono_encargado.min'=>'El número de teléfono debe  tener minimo 8 números' ,
         'Telefono_encargado.max'=>'El número de teléfono debe  tener máximo  8 números' ,
         'Telefono_encargado.unique'=>'El número de teléfono ya ha sido usado' ,
         'Telefono_encargado.regex'=>'El teléfono debe de empezar con 9, 8 o 3' ,
         ]);
     
         $this->validate($request, $rules, $mesaje);

     $nuevoProveedor = new Proveedor();
     //Formulario 
     $nuevoProveedor -> Nombres = $request -> input('Nombres');
     $nuevoProveedor -> Apellidos = $request -> input('Apellidos');
     $nuevoProveedor -> Numero_identidad= $request -> input('Numero_identidad');
     $nuevoProveedor -> Fecha_nacimiento= $request -> input('Fecha_nacimiento');
     $nuevoProveedor -> Numero_telefono = $request -> input('Numero_telefono');
     $nuevoProveedor -> Salrio = $request -> input('Salrio');
     $nuevoProveedor -> Fecha_contrato= $request -> input('Fecha_contrato');
     $nuevoProveedor -> Direccion= $request -> input('Direccion');
    
    
     $creado = $nuevoProveedor->save();

     if ($creado){
         return redirect()->route('Proveedor.index')
         ->with('mensaje', 'Se guardó exitosamente');
     }else{
        

     }

 }
}
