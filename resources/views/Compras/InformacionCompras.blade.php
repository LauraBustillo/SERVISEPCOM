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

      /*Los titulos */ 
      .titulo2 {
      font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
      color:black;
      font-family: 'Open Sans';
      font-size: 30px;
      text-align: center;
    }


    </style>

<h1 class="titulo1">Información de la factura de compra</h1>
<br>

<div>    
    <div class="titulo" > Factura N° : {{ $factura->Numero_factura }} </div>
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
                <td>Fecha de factura</td>
                <td>{{ $factura->Fecha_facturacion }}</td>
            </tr>  

            <tr>
                <td>Proveedor</td>
                <td id="Proveedor">{{ $factura->Proveedor }}</td> 
            </tr> 


        </tbody>
    </table>
  </div>
  <br>
  
<table class="table table-hover"  >
    <thead>
        
       
        <br>
        <tr>
            <th>Producto</th>
            <th>Marca</th>
            <th>Categoria</th>
            <th>Cantidad</th>
            <th>Precio de compra</th>
            <th>Precio de venta</th>
            <th>Impuesto</th>
            <th>Total Producto</th>
          
            
        </tr>
    </thead>
    <tbody id="body_table_detallesFac">
        </tbody>
  </table>
  
  

  <script>

       // varibles publicas, a las que pueden acceder todas las funciones   
        
        //pasando las variables php, a javascript
        var detallefactura = {!! json_encode($detallefactura, JSON_HEX_TAG) !!}; 
        var factura = {!! json_encode($factura, JSON_HEX_TAG) !!}; 
        var products = {!! json_encode($products, JSON_HEX_TAG) !!}; 

        var productfiltersProveedor;
        var totalFACTURA;   
    
        
        totalFACTURA= factura.Total_factura;
        document.getElementById("Proveedor").value = factura.Proveedor;  
    
        dibujarTabla(detallefactura);

        function dibujarTabla(data){
        var html = '';
        totalFACTURA = 0;
  
              data.forEach(element => {
                  
                  totalproducto = (( element.Cantidad * element.Costo) * (1+(element.Impuesto/100)))
      
                  html += '<tr>';   
                  html += '<td>'+element.nombre_producto+'</td>';
                  html += '<td>'+element.Marca+'</td>';
                  html += '<td>'+element.Categoria+'</td>';
                  html += '<td>'+element.Cantidad+'</td>';
                  html += '<td>'+element.Costo+'</td>';
                  html += '<td>'+element.Precio_venta+'</td>';
                  html += '<td>'+element.Impuesto+'</td>';
                  html += '<td>'+totalproducto.toFixed()+'</td>';
                  html += '</tr>';
  
                  totalFACTURA += totalproducto;
              });
  
  
              html += '<tr>';               
                html += '<td></td> <td></td> <td></td> <td></td> <td></td> <td></td>';
                html += '<td><strong >Total factura</strong></td>';
                html += '<td><strong>'+totalFACTURA.toFixed()+'</strong></td><td></td>';
                html += '<tr>';
  
            //inyectando los dos variables a donde correspondan
            document.getElementById('body_table_detallesFac').innerHTML = html;
         
    
        }

        function actualizarFactura() {
            //armamos el json con los campos de ls DB, ahora con el id de la base de datos que se hizo
            var jsonFactura = {
                Numero_factura : document.getElementById("Numero_factura").value,
                Fecha_facturacion : document.getElementById("Fecha_facturacion").value,
                Proveedor : document.getElementById("Proveedor").value,
                Total_factura : totalFACTURA,               
                id:factura.id    
            };
            //pasamos lo el json, y el arreglo de detalles, a string para que se manden como parametros por la ruta
            var stringarrayFactura = JSON.stringify(jsonFactura);
            var stringarrayDetalles = JSON.stringify(detallefactura);
            window.location.href = `{{URL::to('/actualizarFactura/`+stringarrayFactura+`/`+stringarrayDetalles+`')}}`;
        }
  </script>






@endsection
@include('common')