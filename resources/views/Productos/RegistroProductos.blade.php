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
</style>

<script>
  var errores = []
  errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!}; 
  if(errores.length > 0){
    errores.forEach(element => {
      alertify.error(element)
    });   
  }
</script>

<br>
<br>



<form class="form-control" id="form_guardarPr" name="form_guardarPr"  method="POST" style="text-align: center;" onsubmit="confirmar()">
 @csrf
 <br><br>

 {{-- Título --}}

 <H1 class="titulo"  style="font-size: 30px" >Registrar producto</H1>
 <br>


 {{-- Nombre del producto y marca --}}
 
 <div class="row g-3"  class="input-group input-group-sm mb-1"style="padding-right:6.5%"  style="width: 150%" >
  <div class="col" style="padding-left: 7%">
    <span class="input-group-text"  >Nombre del producto</span>
    <input type="text"   maxlength="25" name="Nombre_producto" id="Nombre_producto"  

   class="form-control" placeholder="Nombre del producto"
    aria-label="First name" value="{{old('Nombre_producto')}}">
  </div>

  <div class="col">
    <span class="input-group-text" >Marca del producto</span>
    <input type="text" maxlength="25" name="Marca" id="Marca"  class="form-control" placeholder="Marca del producto" aria-label="First name" value="{{old('Marca')}}">
    </div>
 </div>

  <br>

 {{-- Descripcion --}}
 <div class="input-group input-group-sm mb-1 " style="padding-right:4%"  style="width: 150%"> <br>
 <div class="col" style="padding-left: 6.4% " > 
  <span class="input-group-text" style="width: 181.5%">Descripción del producto</span>

 <textarea class="form-control ancho-alto" spellcheck="true" maxlength="150" name="Descripcion" id="Descripcion" id="exampleFormControlTextarea1"
  placeholder="Ingrese la descripción del producto">{{old('Descripcion')}}</textarea>
 </div>
 



{{-- categorias--}}
 <div class="col" style="padding-left: 20%">
 <label for="Categorias">Categorias</label>
 <select name="categoria_id" id= "categoria_id"  class="" style="background:transparent"  >
    <option value="{{old('categoria_id')}}" [readonly]='true' >Seleccione</option>
    @foreach ($categorias as $c)
      <option value="{{$c->id}}" {{ old('categoria_id') == $c->id ? 'selected' : '' }}> {{$c->Descripcion}} </option>
    @endforeach
  </select>
 </div> 
 

                
      {{-- proveedores--}}
      <div class="col"  >
      <label for="Proveedores">Proveedores</label>
      <select name="proveedor_id" id="proveedor_id"  class="" style="background: transparent" >
      <option value="{{old('proveedor_id')}}"  required [readonly]='true'>Seleccione</option>
      @foreach($proveedores as $p)
    <option value="{{$p->id}}" {{ old('proveedor_id') == $p->id ? 'selected' : '' }}>{{$p->Nombre_empresa}}</option>
  @endforeach
  </select> 
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
        </div>
            <br>
            <br>
          
            {{--Botones falta cerrar--}}
            <div class="col" >
            <button  class="btn btn-outline-dark" type="submit" ><i class="bi bi-folder-fill"> Guardar </i></button>
            <button type="reset" class="btn btn-outline-dark"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
            
            </div>
        </div>
    

</form>
@endsection
{{--mensaje de confirmacion --}}
@push('alertas')
    <script>
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