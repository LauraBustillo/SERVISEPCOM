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
  color: #4c4d4e;
  font-family: 'Open Sans';
  font-size: 20px;
}
/*Los titulos */ 
.titulo1 {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #4c4d4e;
  font-family: 'Open Sans';
  font-size: 40px;
  text-align: center;
}

.button {
    border-bottom: 1px solid hsla(0, 0%, 100%, 0);
    text-shadow: 0 1px 0 hsla(0, 0%, 0%, 0);
    text-decoration: none !important;
    text-transform: uppercase;
    color: #fff !important;
    font-weight: bold;
    border-radius: 5px;
    padding: 10px 20px;
    margin: 0 3px;
    position: relative;
    display: inline-block;
    -webkit-transition: all 0.1s;
    -moz-transition: all 0.1s;
    -o-transition: all 0.1s;
    transition: all 0.1s;
}
.button:active {
    -webkit-transform: translateY(7px);
    -moz-transform: translateY(7px);
    -o-transform: translateY(7px);
    transform: translateY(7px);
}

.button-blue {
    background: #4c4d4e;
    box-shadow: 0 5px 0 #161616,
                0 11px 5px hsla(0, 0%, 0%, 0.5);
}
.button-blue:active {
    box-shadow: 0 3px 0 #161616,
                0 4px 6px hsla(0, 0%, 0%, 0.7);
}

.boton1{
  border: none;
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
                <td id="Proveedor">{{ $factura->proveedor }}</td> 
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
            <th>Categoría</th>
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

  <a class="button button-blue " href="{{route('compra.index')}}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>
  {{-- <a class="btn btn-outline-dark" href="{{route('comprasEdit', ['id'=>$factura->id])}}"> <i class="bi bi-pen-fill"> Editar </i></a>--}}
  

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
        subtotalFACTURA = 0;
        totalFACTURA = 0;
        totalInmpuesto = 0;

              data.forEach(element => {

                totalproducto = ( element.Cantidad * element.Costo)
                totalInmpuesto += (( element.Cantidad * element.Costo) * (element.Impuesto/100))
      
                  html += '<tr>';   
                  html += '<td>'+element.nombre_producto+'</td>';
                  html += '<td>'+element.Marca+'</td>';
                  html += '<td>'+element.Categoria+'</td>';
                  html += '<td>'+element.Cantidad+'</td>';
                  html += '<td>Lps. '+element.Costo+'</td>';
                  html += '<td>Lps. '+element.Precio_venta+'</td>';
                  html += '<td>'+element.Impuesto+'%</td>';
                  html += '<td>Lps. '+totalproducto.toFixed()+'</td>';
                  html += '</tr>';
  
                  subtotalFACTURA += totalproducto;


              });
  
  
                html += '<tr>';               
                html += '<td></td> <td></td> <td></td> <td></td> <td></td> <td></td>';
                html += '<td><strong >SubTotal</strong></td>';
                html += '<td><strong>Lps. '  +subtotalFACTURA.toFixed()+'</strong></td><td></td>';
                html += '<tr>';
                html += '<tr>';               
                html += '<td></td> <td></td> <td></td> <td></td> <td></td> <td></td>';
                html += '<td><strong >Impuesto</strong></td>';
                html += '<td><strong>Lps. '+totalInmpuesto.toFixed()+'</strong></td><td></td>';
                html += '<tr>';
                totalFACTURA =  (parseFloat(subtotalFACTURA) + parseFloat(totalInmpuesto));
                html += '<tr>';               
                html += '<td></td> <td></td> <td></td> <td></td> <td></td> <td></td>';
                html += '<td><strong >Total factura</strong></td>';
                html += '<td><strong>Lps. '+totalFACTURA.toFixed() +'</strong></td><td></td>';
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