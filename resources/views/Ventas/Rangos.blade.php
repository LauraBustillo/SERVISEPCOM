@extends('main')
@section('extra-content')

<style>
/*Los titulos */ 
  .titulo {
    font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
    color: #000000;
    font-family: 'Open Sans';
    font-size: 20xp;
  }

  /*Cajas de texto*/ 
  .form-control  {
      background-color: transparent;
      border: 1.3px solid #000000;
      height: fit-content;

  }
  /*Alinear Div*/ 
  .divaling {
    position: relative;
    right: -4%;
  }

  /*Alinear botones*/ 
  .divalingn {
    position: relative;
    right: -8%;
  }

  /*Las label*/ 
  .input-group-text  {
    background-color: #000000;
    border: 1.3px solid #000000;
    font-family: 'Open Sans';
    color: #FFFFFF;

  }

  /*Los botones*/ 
  .btn-outline-dark {
  
    background-color: transparent;
    border: 1.8px solid #000000;
  }
  .btn-outline-dark:hover{
      background-color: rgb(48, 48, 48);
      color: white;
  }

  a { color: aliceblue;
    outline: none;
    text-decoration: none;
    color: #000000;
  }
  .a:hover{
      background-color: rgb(48, 48, 48);
      color: white;
  }
  .ancho-alto {
          width: 182%;
          height: 40%;
          resize: none;
      }

      /*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color:black;
  font-family: 'Open Sans';
  font-size: 20px;
}

.titulo1 {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color:black;
  font-family: 'Open Sans';
  font-size: 40px;
  text-align: center;
}

.letra{
        font-weight: bold;
    }

.input{
	content: "";
	width: 26px;
	height: 26px;
	float: left;
	margin-right: 1em;
	border: 2px solid #ccc;
	background: rgb(94, 237, 5) !important;
	margin-top: 0.5em;
  text-align: center !important;
  vertical-align: middle !important;
} 
</style>


<form class="form-control" action="">
    <h1 class="titulo1 mx-auto" style="text-align:center">Habilitar rangos de factura</h1> 
<br>

            <div style="display: flex">

                    <div style="width: 30%" class="mx-auto">
                        <h6 class="mx-auto letra titulo" >Facturación electrónica de venta</h6> 
                    </div>
            </div> 
            <br>
    <center>     
            <div style="display: flex">  
                    <div style="width: 30%" class="mx-auto">
                        <label  >Rango desde</label> 
                        <input  id="rango_desde" type="text" class="form-control" placeholder="">
                    </div> &nbsp;&nbsp;
                    <div style="width: 30%" class="mx-auto">
                        <label  >Rango hasta</label> 
                        <input  id="rango_hasta" type="text" class="form-control" placeholder="Fecha del pedido">
                    </div>
            </div>
    </center>
    <center> 
            <div style="display: flex" >  
                    <div style="width: 30%" class="mx-auto">
                        <label  >Fecha desde</label> 
                        <input  id="fecha_desde" type="date" class="form-control" placeholder="">
                    </div> &nbsp;&nbsp;
                    <div style="width: 30%" class="mx-auto">
                        <label  >Fecha hasta</label> 
                        <input  id="fecha_hasta" type="date" class="form-control" placeholder="">
                    </div>
            </div>
    </center>
    <br>
    <br>
            <div style="display: flex" >  
                    <div style="display: flex" class="mx-auto">  
                        <button type="button"  class="btn btn-outline-dark"><i class="bi bi-plus-square"> Agregar</i></button> &nbsp;
                        <a class="btn btn-outline-dark"><i class="bi bi-eraser-fill"> Limpiar </i> </a>

                    </div>

            </div>
            <br>
            <div style="display: flex" >  
                    <div style="display: flex" class="mx-auto">  
                        <table class="table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Prefijo</th>
                                        <th>Rango desde</th>
                                        <th>Rango hasta</th>
                                        <th>Fecha desde</th>
                                        <th>Fecha hasta</th>
                                        <th>Estado</th>
                                        <th>Editar</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody id="body_table_detallesFac">
                                
                                </tbody>
                        </table>
                    </div>

            </div>





</form>

        <script>
            function dibujarTablaDetalles(){

let html = ''
html += '<table class="table table-hover" style="width: 100%";>'
html += '<thead>'
html += '<tr>'
html += '<th>Nombre producto</th> <th>Marca</th> <th>Descripción</th> <th>Cantidad</th> <th>Eliminar</th>'
html += '</tr>'
html += '</thead>'
html += '<tbody>'
if(detalles_pedido.length > 0){
  detalles_pedido.forEach(element => {
    html += '<tr>'
    html += '<td>''</td>'
    html += '<td>''</td>'
    html += '<td>''</td>'
    html += '<td>''</td>'
    html += `<td><button class="btn btn-outline-dark" onclick="eliminardetalleproducto('` `')"><i class="bi bi-trash"></i></button></td>`
    html += '</tr>'      
  });
}else{
  html += '<tr><td colspan="5" style="text-align:center">No hay productos agregados</td></tr>'     
}
html += '</tbody>'
html += '</table>'

document.getElementById('tabladetallespedido').innerHTML = html;
}
            
        </script>
 
     



  



@endsection
@include('common')