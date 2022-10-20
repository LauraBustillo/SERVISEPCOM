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
        width: 170%;
        height: 31%;
        resize: none;
    }
</style>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $mesaje)
                <li>{{ $mesaje }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
    <input type="text"   minlength="3" maxlength="25" name="Nombre_producto" id="Nombre_producto"  pattern="[A-ZÑ a-zñ]+" class="form-control"  required title="Este campo solo debe de contener letras" placeholder="Nombre del producto"
    aria-label="First name" value="{{old('Nombre_producto')}}">
  </div>
  <div class="col">
    <input type="text" minlength="4" maxlength="25" name="Marca" id="Marca" pattern="[A-ZÑ a-zñ]+" class="form-control"   required title="Este campo solo debe de contener letras"
     placeholder="Marca del producto" aria-label="First name" value="{{old('Marca')}}">
    </div>
 </div>

  <br>



 {{-- Descripcion --}}
 <div class="input-group input-group-sm mb-1 " style="padding-right:4%"  style="width: 150%"> <br>
 <div class="col" style="padding-left: 6.4% " > 
 <span class="input-group-text ancho-alto" >Descripción</span>
 <textarea class="form-control ancho-alto" spellcheck="true"
 minlength="10" maxlength="150" name="Descripcion" id="Descripcion" id="exampleFormControlTextarea1" placeholder=" Ingrese la descripción del producto" required>{{old('Descripcion')}}</textarea>
 </div>



{{-- categorias--}}
 <div class="col" style="padding-left: 20% "  >
 <label for="Categorias">Categorias</label>
 <select name="categoria" id=""  class="" style="background: transparent" required>
    <option value="" [readonly]='true'>Seleccione </option>
    @foreach($categorias as $c)
      <option value="{{$c->Descripcion}}">{{$c->Descripcion}}</option>
    @endforeach
  </select>
 </div> 
 

                
 {{-- proveedores--}}
 <div class="col"  >
 <label for="Proveedores">Proveedores</label>
 <select name="Proveedor" id=""  class="" style="background: transparent" required>
  <option value="" [readonly]='true'>Seleccione </option>
  @foreach($proveedores as $p)
    <option value="{{$p->id}}">{{$p->Nombre_empresa}}</option>
  @endforeach
</select>
 </div> 


           {{--Cantidad--}} 
           <div class="input-group input-group-sm mb-1 " style="padding-right:4%"  style="width: 150%"> <br>
            <div class="col" style="padding-left:20%" > 
                <span class="input-group-text" style="width: 60%"  id="inputGroup-sizing-sm"> Cantidad</span>
                <input type="text" style="width: 60%"   minlength="8" maxlength="8" name=" Cantidad" id=" Cantidad" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm" required title=" solo debe contener números."  pattern="[0-9]+" 
               value="{{old('Cantidad')}}">
            </div>
        
              {{--Precio--}} 
         
            <div class="col" style="padding-left:1%" > 
                <span class="input-group-text" style="width: 60%"  id="inputGroup-sizing-sm">Precio</span>
                <input type="text" style="width: 60%"   minlength="8" maxlength="8" name=" Cantidad" id=" Cantidad" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm" required title=" solo debe contener números."  pattern="[0-9]+" 
               value="{{old('Precio')}}">
            </div>

    
            {{-- Impuesto--}}
            <div class="col" > 
                <span class="input-group-text" style="width: 60%"  id="inputGroup-sizing-sm">Impuesto</span>
                <input type="text" style="width: 60%"   minlength="8" maxlength="8" name="Impuesto" id="Impuesto" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm" required title=" solo debe contener números."  pattern="[0-9]+" 
               value="{{old('Impuesto')}}">
            </div>
          </div>
        </div>
            <br>
            <br>
          
            {{--Botones --}}
            <div class="col" >
            <button  class="btn btn-outline-dark" type="submit" ><i class="bi bi-folder-fill"> Guardar</i></button>
            <button type="reset" class="btn btn-outline-dark"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
            <button type="button" class="btn btn-outline-dark">
            <a class="a"  href="{{route('proveedor.index')}}"><i class="bi bi-x-circle-fill"> Cerrar </i></a></button>
            </div>
        </div>
    

</form>
@endsection
@include('common')