<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use DB;

class ProveedorController extends Controller
{
   

   /*Funcion para guardar proveedor*/
   public function guardar(){
    return view('Proveedores.RegistroProveedores');
    }

 public function agg (Request $request){

     $rules = ([
     'Nombre_empresa'=>'required|min:3|max:25',
     'Direccion' =>'required',
     'Correo'=>'required|email|unique:proveedors|max:30',
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

     'Telefono_empresa.required'=>'El número de teléfono de la empresa es obligatorio' ,
     'Telefono_empresa.numeric'=>'El número de  teléfono solo debe contener números' ,
     'Telefono_empresa.min'=>'El número de teléfono debe  tener minimo 8 números' ,
     'Telefono_empresa.max'=>'El número de teléfono debe  tener máximo  8 números' ,
     'Telefono_empresa.unique'=>'El número de teléfono de la empresa ya ha sido usado' ,
     'Telefono_empresa.regex'=>'El teléfono debe de empezar con 9, 8 o 3' ,

     'Nombre_encargado.required'=>'El nombre del encargado es obligatorio' ,
     'Nombre_encargado.min'=>'El nombre del encargado  debe tener minimo 3 letras' ,
     'Nombre_encargado.max'=>'El nombre del encargado  no debe de tener más de 25 letras' ,
 

     'Apellido_encargado.required'=>'El apellido del encargado es obligatorio' ,
     'Apellido_encargado.min'=>'El apellido debe tener minimo 4 letras' ,
     'Apellido_encargado.max'=>'El apellido  no debe de tener más de 25 letras' ,
 
     'Telefono_encargado.required'=>'El número de teléfono del encargado es obligatorio' ,
     'Telefono_encargado.numeric'=>'El número de  teléfono solo debe contener números' ,
     'Telefono_encargado.min'=>'El número de teléfono debe  tener minimo 8 números' ,
     'Telefono_encargado.max'=>'El número de teléfono debe  tener máximo  8 números' ,
     'Telefono_encargado.unique'=>'El número de teléfono del encargado ya ha sido usado' ,
     'Telefono_encargado.regex'=>'El teléfono debe de empezar con 9, 8 o 3' ,
     ]);
 
     $this->validate($request, $rules, $mesaje);

 $nuevoProveedor = new Proveedor();
 //Formulario 
 $nuevoProveedor -> Nombre_empresa = $request -> input('Nombre_empresa');
 $nuevoProveedor -> Direccion = $request -> input('Direccion');
 $nuevoProveedor -> Correo= $request -> input('Correo');
 $nuevoProveedor -> Telefono_empresa= $request -> input('Telefono_empresa');
 $nuevoProveedor -> Nombre_encargado = $request -> input('Nombre_encargado');
 $nuevoProveedor -> Apellido_encargado= $request -> input('Apellido_encargado');
 $nuevoProveedor -> Telefono_encargado= $request -> input('Telefono_encargado');

 $creado = $nuevoProveedor->save();

 if ($creado){
     return redirect()->route('proveedor.index')
     ->with('mensaje', 'Se guardó exitosamente');
 }else{
    

 }

}
}
