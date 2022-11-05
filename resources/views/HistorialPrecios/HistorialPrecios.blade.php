@extends('main')
@section('extra-content')

<style>
    .input-group-text  {
   background-color: #B8D7F9;
   border: 1px solid #0319C4;
 }
 
 .form-control  {
     background-color: transparent;
     border: 1px solid #0319C4;
 }
 
 .btn-info{
     background-color: transparent;
     border: 1px solid #0319C4;
 }
 /*Los titulos */ 
 .titulo {
   font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
   color:black;
   font-family: 'Open Sans';
   font-size: 20px;
 }
 /*Los titulos */ 
 .titulo1 {
   font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
   color:black;
   font-family: 'Open Sans';
   font-size: 40px;
   text-align: center;
 }
 </style>
 

<H1 class="titulo1">Historial de precios</H1>
<br>
<div>    
    
<br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Datos</th>
                <th>Información</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Fecha de cambio</td>
        
            </tr>  


            <tr>
                <td>Precio de venta anterior</td>
              
            </tr> 

            <tr>
                <td>Precio de compra anterior</td>
              
            </tr> 


            <tr>
                <td>Nuevo precio de venta</td>
               
            </tr> 

            <tr>
                <td>Nuevo precio de compra</td>
               
            </tr> 

        </tbody>
    </table>
  </div>

  

  <a class="btn btn-outline-dark" href="{{route('inventario.index')}}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>


@endsection
@include('common')