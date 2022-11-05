<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    {{-- styles --}}
    <link rel="stylesheet" href="{{ URL::asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/letters.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/tables.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/card.css') }}">
    {{-- scripts --}}
    <!-- <script src="./../js/navbar.js" crossorigin="anonymous" ></script>     -->
    <script  type="text/javascript"  src="{{ URL::asset('js/navbar.js') }}" ></script>    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('alertas')

     {{-- libreria de Jquery --}}
    <script  type="text/javascript"  src="{{ URL::asset('js/jquery.js') }}" ></script>   

    {{-- librerias del select con buscador --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- librerias del select con buscador --}}


    {{-- icons --}}
    {{-- https://fonts.google.com/icons --}}  
    <title>SEPCOM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>



{{-- Alertify --}}
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
{{-- Alertify --}}



</head>

<style>
.bo {
background-color: #f5f5f5;
background-position: 0, center;
background-repeat: no-repeat, repeat;
background-size: cover, auto;
background-attachment: fixed, scroll;
}


.nav_link{
    position: relative;
    color: white !important;
    margin-bottom: 1.5rem;
    transition: .3s
}
</style>

<section class="content">
    
{{-- Color del menu--}}
<body class="bo" id="body-pd" style="padding-top: 1rem;  background-image: url({{asset('imagenes/tres.jpg')}})"
>
    
    <header class="" id="header">
        <!-- <svg  style="fill: #4723D9;cursor: pointer;" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 18v-2h18v2Zm0-5v-2h18v2Zm0-5V6h18v2Z"/></svg> -->
     </header>


    
    <div class="l-navbar" style="background-color: #000000" id="nav-bar" >
        <nav class="nav">
            <div style="background-color: #000000"> 
                <div class="nav_logo"> 
        <svg  id="header-toggle" style="fill: white;cursor: pointer;" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 18v-2h18v2Zm0-5v-2h18v2Zm0-5V6h18v2Z"/></svg>

                    <!-- <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M2 21q-.425 0-.712-.288Q1 20.425 1 20t.288-.712Q1.575 19 2 19h20q.425 0 .712.288.288.287.288.712t-.288.712Q22.425 21 22 21Zm2-3q-.825 0-1.412-.587Q2 16.825 2 16V5q0-.825.588-1.413Q3.175 3 4 3h16q.825 0 1.413.587Q22 4.175 22 5v11q0 .825-.587 1.413Q20.825 18 20 18Zm0-2h16V5H4v11Zm0 0V5v11Z"/></svg> -->
                    <div class="nav_logo-name">SEPCOM</div> 
   </div>
                
                <div class="nav_list"> 

                    {{-- Registro clientes --}}
                    <a href="{{ route('cliente.index') }}"  class="@if(Request::is('/Cliente')) nav_link active @else nav_link @endif" >
                        <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M.1 18.2v-1.625q0-1.2 1.163-1.938Q2.425 13.9 4.25 13.9h.35q-.325.55-.512 1.162-.188.613-.188 1.313V18.2Zm6 0v-1.775q0-1.625 1.638-2.6Q9.375 12.85 12 12.85q2.65 0 4.275.975 1.625.975 1.625 2.6V18.2Zm14 0v-1.825q0-.7-.175-1.313-.175-.612-.525-1.162h.35q1.875 0 3.013.737 1.137.738 1.137 1.938V18.2ZM12 15q-1.075 0-1.988.25-.912.25-1.337.675v.125h6.675v-.125q-.425-.425-1.325-.675Q13.125 15 12 15Zm-7.75-1.975q-.8 0-1.375-.575t-.575-1.4q0-.8.575-1.375T4.25 9.1q.825 0 1.4.562.575.563.575 1.388 0 .8-.575 1.388-.575.587-1.4.587Zm15.5 0q-.8 0-1.375-.575t-.575-1.4q0-.8.575-1.375T19.75 9.1q.825 0 1.388.562.562.563.562 1.388 0 .8-.562 1.388-.563.587-1.388.587Zm-7.75-.9q-1.25 0-2.125-.875T9 9.125Q9 7.875 9.875 7T12 6.125q1.25 0 2.125.875T15 9.125q0 1.25-.875 2.125T12 12.125Zm0-3.85q-.325 0-.587.25-.263.25-.263.6 0 .325.263.587.262.263.612.263t.588-.263q.237-.262.237-.612 0-.325-.25-.575-.25-.25-.6-.25Zm0 7.775Zm0-6.925Z"/></svg>
                        <span class="nav_name">Clientes</span> 
                    </a>
                    
                    {{-- Registro empleados --}}
                    <a href="{{ route('empleado.index') }}" class="@if(Request::is('Empleado')) nav_link active @else nav_link @endif">                     
                        <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M4.15 22.3q-1.025 0-1.737-.713-.713-.712-.713-1.737V9.25q0-1.025.713-1.737Q3.125 6.8 4.15 6.8h4.7V3.85q0-.9.625-1.525Q10.1 1.7 11 1.7h2q.9 0 1.525.625.625.625.625 1.525V6.8h4.7q1.025 0 1.737.713.713.712.713 1.737v10.6q0 1.025-.713 1.737-.712.713-1.737.713Zm0-2.15h15.7q.125 0 .212-.088.088-.087.088-.212V9.25q0-.125-.088-.213-.087-.087-.212-.087h-4.7q0 .875-.6 1.512-.6.638-1.5.638h-2.1q-.9 0-1.5-.638-.6-.637-.6-1.512h-4.7q-.125 0-.212.087-.088.088-.088.213v10.6q0 .125.088.212.087.088.212.088Zm1.7-2h6.2v-.425q0-.475-.262-.862-.263-.388-.688-.563-.575-.25-1.112-.362-.538-.113-1.038-.113t-1.037.113q-.538.112-1.113.362-.425.175-.687.563-.263.387-.263.862Zm8.2-1.5h4.3v-1.6h-4.3Zm-5.1-1.6q.65 0 1.1-.45.45-.45.45-1.1 0-.65-.45-1.1-.45-.45-1.1-.45-.65 0-1.1.45-.45.45-.45 1.1 0 .65.45 1.1.45.45 1.1.45Zm5.1-1.25h4.3v-1.65h-4.3ZM11 8.95h2v-5.1h-2Zm1 5.6Z"/></svg>
                        <span class="nav_name">Empleados</span> 
                    </a> 

                     {{-- Registro proveedor --}}
                     <a href="{{ route('proveedor.index') }}" class="@if(Request::is('Proveedor')) nav_link active @else nav_link @endif">                     
                        <svg style="fill: white"  xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M17.25 8.925h2.4v-2.4h-2.4Zm0 4.25h2.4v-2.4h-2.4Zm0 4.25h2.4v-2.4h-2.4Zm-.625 3.875v-2.15h4.55V4.8h-9.1v1.775l-2.1-1.525v-.725q.125-.725.713-1.2.587-.475 1.387-.475h9.1q.925 0 1.538.612.612.613.612 1.538v14.35q0 .925-.612 1.538-.613.612-1.538.612Zm0-10.225Zm-15.95 9V12.2q0-.6.263-1.125.262-.525.762-.875l4.775-3.4q.675-.475 1.463-.475.787 0 1.437.475l4.775 3.4q.5.35.763.875.262.525.262 1.125v7.875q0 .5-.363.863-.362.362-.862.362H9.175v-5.55h-2.5v5.55H1.9q-.5 0-.862-.362-.363-.363-.363-.863Zm2.15-.925h2.1V14h6v5.15h2.1v-7.1l-5.1-3.575-5.1 3.575Zm8.1 0V14h-6v5.15V14h6Z"/></svg>
                    
                        <span class="nav_name">Proveedor</span> 
                    </a> 

                    {{-- Registro producto --}}
                     <a href="{{ route('producto.index') }}" class="@if(Request::is('Product')) nav_link active @else nav_link @endif">                     
                     <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M14.25 21.4q-.575.575-1.425.575-.85 0-1.425-.575l-8.8-8.8q-.275-.275-.437-.65Q2 11.575 2 11.15V4q0-.825.588-1.413Q3.175 2 4 2h7.15q.425 0 .8.162.375.163.65.438l8.8 8.825q.575.575.575 1.412 0 .838-.575 1.413ZM12.825 20l7.15-7.15L11.15 4H4v7.15ZM6.5 8q.625 0 1.062-.438Q8 7.125 8 6.5t-.438-1.062Q7.125 5 6.5 5t-1.062.438Q5 5.875 5 6.5t.438 1.062Q5.875 8 6.5 8ZM4 4Z"/></svg>                           
                     <span class="nav_name">Productos</span> 
                    </a>   
                    
                    
                    {{-- Registro compra --}}
                       <a href="{{ route('compra.index') }}" class="@if(Request::is('Compras')) nav_link active @else nav_link @endif">                     
                        <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M6 22q-1.25 0-2.125-.875T3 19v-3h3V2l1.5 1.5L9 2l1.5 1.5L12 2l1.5 1.5L15 2l1.5 1.5L18 2l1.5 1.5L21 2v17q0 1.25-.875 2.125T18 22Zm12-2q.425 0 .712-.288Q19 19.425 19 19V5H8v11h9v3q0 .425.288.712.287.288.712.288ZM9 9V7h6v2Zm0 3v-2h6v2Zm8-3q-.425 0-.712-.288Q16 8.425 16 8t.288-.713Q16.575 7 17 7t.712.287Q18 7.575 18 8t-.288.712Q17.425 9 17 9Zm0 3q-.425 0-.712-.288Q16 11.425 16 11t.288-.713Q16.575 10 17 10t.712.287Q18 10.575 18 11t-.288.712Q17.425 12 17 12ZM6 20h9v-2H5v1q0 .425.287.712Q5.575 20 6 20Zm-1 0v-2 2Z"/></svg>
                        <span class="nav_name">Compras</span> 
                       </a>  

                       {{-- Registro Iventario --}}
                        <a href="{{ route('inventario.index') }}" class="@if(Request::is('Inventario')) nav_link active @else nav_link @endif">                     
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M11.025 20.75h-5.85q-.8 0-1.363-.562-.562-.563-.562-1.363V5.15q0-.825.55-1.375t1.25-.55h4.225q.25-.875 1.013-1.425.762-.55 1.662-.55.95 0 1.7.55t1 1.425h4.2q.825 0 1.375.55t.55 1.375v4.875H18.9V5.1h-2.05v2.875H7.175V5.1h-2.05v13.775h5.9Zm4.425-1.025L11.325 15.6l1.325-1.325 2.8 2.8 5.55-5.55 1.325 1.325ZM12.025 5q.375 0 .65-.275t.275-.675q0-.375-.275-.65t-.65-.275q-.4 0-.675.275t-.275.65q0 .4.275.675t.675.275Z"/></svg>
                            <span class="nav_name">Inventario</span> 
                           </a> 
                </div>
            </div> 

            
            
            <a href="#" class="nav_link"> 
                <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M5 21q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h7v2H5v14h7v2Zm11-4-1.375-1.45 2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5Z"/></svg>
                <span class="nav_name">Logout</span> 
            </a>
        </nav>
    </div>




    <!--IMAGEN DE FONDO AZUL-->
    <!--Container Main start-->
    <!-- background-image: url('imagenes/compu.png') -->
    <div class="bo" style="padding-top: 1rem; background-image: url({{asset('imagenes/tres.jpg')}})">
    <!-- <div class="bo" style="padding-top: 1rem; background-image: URL::asset('imagenes/tres.jpg'"> -->
    
        @yield('main-content')
    </div>



    <!--Container Main end-->




    



</body>



</section>

</html>