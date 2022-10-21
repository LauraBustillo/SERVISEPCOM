<?php

namespace App\Http\Controllers;
use App\Models\Compra;
use Illuminate\Http\Request;
use BD;

class CompraController extends Controller
{

    /*Funcion para  guardar  */
    public function guardar(){
        return view('Compras.RegistroCompras');
   }

   /* Validar  guardar  */
   public function agg(Request $request){

     $rules= ([
       'Numero_factura' =>'required|numeric',
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



/*   
 if ($agregar1){
    return redirect()->route('cliente.index')->with('mensaje', 'Se guardó  con  éxito') ;
 } else {
 
}*/
} 
}