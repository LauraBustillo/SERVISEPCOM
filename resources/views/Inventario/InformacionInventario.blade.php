@extends('main')
@section('extra-content')
<style>
    .input-group-text  {
   background-color: #B8D7F9;
   border: 1.5px solid #000000;
 }
 
 .form-control  {
     background-color: transparent;
     border: 1.5px solid #000000;
 }
 
 .table-1{
     width: 100%;
     color: rgb(3, 10, 1);
   
     border: 1px solid #000000;
 
 }
 
 .table-1 th{
     background-color: #0319C4;
     color:white;
     padding: .2rem;
     text-align: start;
 }
 
 .btn-info{
     background-color: transparent;
     border: 1px solid #000000;
 }
 
 /*Los titulos */ 
 .titulo {
   font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
   color: black;
   font-family: 'Open Sans';
   font-size: 20xp;
 }
 
 
 /*Los botones*/ 
 .btn-outline-dark {
   background-color: transparent;
   border: 1.8px solid #000000;
   text-decoration: none;
   color: black;
 }

   /*Los titulos */ 
.titulo1 {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color:black;
  font-family: 'Open Sans';
  font-size: 40px;
  text-align: center;
}
/*Quitar Subrayado*/ 
  a:link, a:visited, a:active, a:focus{
     text-decoration:none;
     Color: black; 
    
   }
 </style>
{{--Botones --}}


<a class="btn btn-outline-dark" href="{{route('historial.mostrar')}}"> <i class="bi bi-arrow-left-circle-fill"> Precio </i></a>

<a class="btn btn-outline-dark" href="{{route('inventario.index')}}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>

<h1 class="titulo1">Información del producto</h1>
<table class="table table-hover"  >
  <thead>
      
     
      <br>
      <tr>
          <th>Número de factura</th>
          <th>Nombre del producto</th>
          <th>Descripción</th>
          <th>Marca</th>
          <th>Categoria</th>
          <th>Cantidad</th>
          <th>Precio de venta</th>
          <th>Impuesto</th>
          <th>Historial precio</th>
        
          
      </tr>
  </thead>
  <tbody id="body_table_detallesFac">
      </tbody>
</table>

 <script>

 </script>




 @endsection
 @include('common')