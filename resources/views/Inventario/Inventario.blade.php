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

 /*Quitar Subrayado*/
  a:link, a:visited, a:active, a:focus{
     text-decoration:none;
     Color: black;

   }

   div.dataTables_wrapper div.dataTables_filter input {

display: inline-block;
width: 80% !important;
background-color: transparent;
   border: 1.5px solid #000000;
   float: left;
}
.dataTables_wrapper .dataTables_filter {
  float: left !important ;
  text-align: left !important;
width: 50% !important;



}

.dt-buttons{
  padding-left: 85% !important;


}
.dt-button{
  padding: 0 !important;
  border: none !important;
}




 </style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>


<script  src = 'build/pdfmake.min.js' ></script>
<script  src = 'build/vfs_fonts.js' ></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

<script  src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script  src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script  src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
<script  src="https://cdn.datatables.net/plug-ins/1.13.1/api/sum().js"></script>

{{--Para los reportes--}}

<script  src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

<script  src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script  src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>


{{-- Darle forma a los borones de reporte--}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">













 <h1 class="titulo" style="text-align:center">Listado de inventario</h1>

 {{-- Buscador
 <br>
 <nav class="navbar navbar-nav bg-nav" >
   <div class="container-fluid" >
     <form class="d-flex" id="ablescroll" method="POST" action="Inventario">
     @csrf
       <input type="text" style="width: 500px;"  class="form-control me-2" name="buscar" value="{{$buscar}}" placeholder="Buscar por nombre del producto, marca o categoría" aria-label="Sizing example input">
       <button  type="submit" class="btn btn-outline-dark me-2" id="buscar" name="buscador" value=" "><i class="bi bi-search"> </i></button>
       <a href="{{ route('inventario.index') }}" class="btn btn-outline-dark" ><i class="bi bi-x-square"></i></a>
     </form>
   </div>
   </nav>--}}

 <br>



 <div>
     <table id="example" class="table table-hover">
         <thead>
         <tr>

         <th scope="col">Nombre del producto</th>
         <th scope="col">Marca</th>
         <th scope="col">Provedor</th>
         <th scope="col">Cantidad</th>
         <th scope="col">Categoría</th>
         <th scope="col">Detalles inventario</th>
         </tr>
         </thead>

      <tbody>
         @forelse($inventario as $in)

         <tr>
         <td scope="row">{{ $in->Nombre_producto}}</td>
         <td>{{ $in->Marca }}</td>
         <td>{{ $in->Nombre_empresa}}</td>
         <td>{{ $in->Cantidad}}</td>
         <td>{{ $in->Categoria}}</td>

         {{-- Botones --}}
         <td><a class="btn-detalles" href="{{route('inventario.mostrar' , ['id' => $in->id_producto]) }}"> <i class="bi bi-file-text-fill"> Detalles </i> </a></td>

        </tr>
        @empty
        @endforelse
     </tbody>
     </table>
   </div>

   <script>

    $().ready(function(){
    $('#example').DataTable({




      dom:  '<"wrapper"fBlitp>',
     language:{ "sProcessing": "Procesando...",
          "sLengthMenu": "",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "",
          "sInfo": "",
          "sInfoEmpty": "",
          "sInfoFiltered": "",
          "sInfoPostFix": "",
          "sSearch": "Buscar por nombre del producto, marca o categoría",
          "sUrl": ".",
          "sInfoThousands": "",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          },
          "buttons": {
              "copy": "Copiar",
              "colvis": "Visibilidad"
          }
      },

      buttons: [

 //Imprimir

       {
        extend:    'print',
        text:  '<button class ="btn btn-secondary" > <i class="fa fa-print" ></i></button>',
        titleAttr: 'Imprimir',
        title:'Reporte de listado de inventario ',





       },



//PDF

      {
   extend: 'pdfHtml5',
   text:  '<button class ="btn btn-danger" > <i class="fa fa-file-pdf-o"></i></button>',
   titleAttr: 'Archivo PDF',
   orientation: 'portrait',
   pageSize: 'A4',
   title:'Reporte de listado de inventario ',
   exportOptions: { columns: [0, 1, 2, 3,4] ,


},

      customize: function(doc) {
          doc.content[1].margin =[100, 0, 100, 0] ,
          doc.content.splice(1, 0, {
              columns: [{
              }
            ],
            });

            doc['footer'] = (function(page, pages) {
                    return {
                      columns: [
                        {
                          alignment: 'center',
                          text: [
                            { text: page.toString(), italics: true },
                  ' / ',
                            { text: pages.toString(), italics: true }
                  ]
                      }],
                      margin: [10, 0]
                    }
                  });

        }
},

{
extend:    'excelHtml5',
text:       '<button class ="btn btn-success" > <i class="fa fa-file-excel-o"></i></button>',
titleAttr: 'Archivo Excel',
exportOptions: { columns: [0, 1, 2, 3,4] }


},

]

  });



});

 </script>


@endsection
@include('common')



