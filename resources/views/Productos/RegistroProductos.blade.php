@extends('main')
@section('extra-content')



<style>
  /*Las label*/ 
  .input-group-text  {
  background-color: #4c4d4e;;
  border: 1.3px solid #4c4d4e;;
  font-family: 'Open Sans';
  color: #FFFFFF;

}
/*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #4c4d4e;;
  
  font-family: 'Open Sans';
  font-size: 20xp;
}

/*Cajas de texto*/ 
.form-control  {
    background-color: transparent;
    border: 1.3px solid #000000;
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

@if (session('mensaje'))
  <script>
    mensaje = {!! json_encode(session('mensaje'), JSON_HEX_TAG) !!};
    alertify.success(mensaje);
  </script> 
@endif 
<script>
  var errores = []
  errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!}; 
  if(errores.length > 0){
    errores.forEach(element => {
      alertify.error(element)
    });   
  }
</script>

      <form class="form-control" id="form_guardarPr" name="form_guardarPr"  method="POST" style="text-align: center;" onsubmit="confirmar()">
            @csrf
            <br>
            {{-- Título --}}
            <H1 class="titulo" >Registrar producto</H1>
            <br>

            {{-- Nombre del producto y marca --}}         
            <div class="row g-3"  class="input-group input-group-sm mb-1" style="padding-right:6.5%"  style="width: 100%" >
                  <div class="col" style="padding-left: 7%">
                    <span class="input-group-text"  >Nombre del producto</span>
                    <input type="text"   maxlength="25" name="Nombre_producto" id="Nombre_producto"  onkeyup="app.inputKeyUpDirect(this);"

                    class="form-control" placeholder="Nombre del producto"
                    aria-label="First name" value="{{old('Nombre_producto')}}">
                  </div>

                  <div class="col">
                    <span class="input-group-text" >Marca del producto</span>
                    <input type="text" maxlength="25" name="Marca" id="Marca"  class="form-control" onkeyup="app.inputKeyUpDirect(this);"
                    placeholder="Marca del producto" aria-label="First name" value="{{old('Marca')}}">
                  </div>
            </div>
            <br>

  
            {{-- categorias--}}
            <div class="input-group input-group-sm mb-1" style="padding-right:6.5%"   >
              <div class="col" style="padding-left: 7% " >
                <span class="input-group-text" >Categorías</span>
                <select name="categoria_id" id= "categoria_id"  class="form-control select" style="background:transparent"  >
                  <option value="{{old('categoria_id')}}" [readonly]='true' >Seleccione o busque Categoría</option>
                  @foreach ($categorias as $c)
                    <option value="{{$c->id}}" {{ old('categoria_id') == $c->id ? 'selected' : '' }}> {{$c->Descripcion}} </option>
                  @endforeach
                </select>
              </div>
              {{-- proveedores--}}
              <div class="col" style="padding-left:2% "  >
                <span class="input-group-text" >Proveedor</span>
                <select class="form-control select" name="proveedor_id" id="proveedor_id"
                  class="buscador-select">
                  <option  value="{{old('proveedor_id')}}"  required [readonly]='true'>Seleccione o busque el proveedor</option>
                  @foreach ($proveedores as $p)
                  <option value="{{$p->id}}" {{ old('proveedor_id') == $p->id ? 'selected' : '' }}>{{$p->Nombre_empresa}}</option>
                  @endforeach 
                </select>
              </div>
            </div>
            <br>

            {{-- Descripcion --}}
            <div  class="mb-3" style="padding-left: 22%"> 
              <span class="input-group-text"  style="width: 70%">Descripción del producto</span>
              <textarea class="form-control" style="width: 70%"  spellcheck="true" maxlength="150"  onkeyup="app.inputKeyUpDirect(this);"
              name="Descripcion" id="Descripcion" id="exampleFormControlTextarea1" rows="3" 
              placeholder="Ingrese la descripción del producto">{{old('Descripcion')}}</textarea>
            </div>         
  
           {{--Cantidad--}} 
           <div class="input-group input-group-sm mb-1 " style="padding-right:4%"  style="width: 150%"> <br>
              <div class="col" style="padding-left:15%" > 
                  
                  <input type="hidden" style="width: 70%"   minlength="1" maxlength="1" name="Cantidad" id="Cantidad" class="form-control" aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-sm" required title=" Solo debe tener números."  null readonly  pattern="[0-9]+" 
                value="{{old('Cantidad')}}">
              </div>
        
                  {{--Precio compra--}} 
                <div class="col" style="padding-left:1%" >   
                    <input type="hidden" style="width: 70%"  value="0"  minlength="1" maxlength="5" name="Precio_compra" id="Precio_compra" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm" required title=" solo debe tener números."  pattern="[0-9]+" placeholder='Ingrese el precio'value="{{old('Precio_compra')}}">
                </div>

                {{-- Impuesto--}}
                <div class="col" > 
                    <input type="hidden" style="width: 70%"   minlength="1" maxlength="2" name="Impuesto" id="Impuesto" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm" required title=" solo debe tener números."  pattern="[0-9]+" placeholder='' value="15" readonly
                    value="{{old('Impuesto')}}">
                </div>

                    {{--Precio venta--}} 
                <div class="col" style="padding-left:1%" > 
                    <input type="hidden" style="width: 70%"   minlength="1" maxlength="5" name="Precio_venta" id="Precio_venta" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm"  value="0" title=" solo debe tener números."   pattern="[0-9]+"  value="{{old('Precio_venta')}}">
                </div>
              </div>
       
            {{--Botones falta cerrar--}}
            <div class="col" >
            <button  class="boton1 button button-blue" type="submit" ><i class="bi bi-folder-fill"> Guardar </i></button>
            <button type="reset" class="boton1 button button-blue"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
            
            </div>
            <br>
            <label for=""></label>
        </div>
      </form>
@endsection
{{--mensaje de confirmacion --}}
@push('alertas')
    <script>

 

/* Para poner en mayuscula la primer letra*/
var app = app || {};
        
        app.toCapitalizeWords = function(text){
            return text.replace(/\w\S*/g, function(txt){
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        }

        app.inputKeyUp = function(e){
            var value = e.target.value;
            e.target.value = app.toCapitalizeWords(value);
        }

        app.inputKeyUpDirect = function(input){
            input.value = app.toCapitalizeWords(input.value);
        }

        var inputsToCapitalizeWordsCollection = document.getElementsByClassName("toCapitalizeWords");

        for (let i = 0; i < inputsToCapitalizeWordsCollection.length; i++) {
            const element = inputsToCapitalizeWordsCollection[i];
            element.addEventListener("keyup", app.inputKeyUp);
            
        }





        function confirmar() {
           var formul = document.getElementById("form_guardarPr");
           
           Swal.fire({
                title: '¿Está seguro que desea guardar los datos?',
                icon: 'question',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then((result)=>{
                if (result.isConfirmed) {
                    formul.submit();
                }
            })
            event.preventDefault()
        }
    </script>
@endpush
@include('common')