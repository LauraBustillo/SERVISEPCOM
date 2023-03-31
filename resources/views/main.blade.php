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
    <script type="text/javascript" src="{{ URL::asset('js/navbar.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('alertas')

    {{-- libreria de Jquery --}}
    <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>

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

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
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


    .nav_link {
        position: relative;
        color: white !important;
        margin-bottom: 1.5rem;
        transition: .3s
    }

    .nav_link1 {
        position: relative;
        color: white !important;
        margin-bottom: 8rem !important;
        padding-left: 30% !important;

    }

    .sidebar-nav {
        padding: 9px;
    }




    .dropdown-toggle {
        color: #f5f5f5 !important;
    }

</style>

<section class="content">

    {{-- Color del menu--}}
    <body class="bo" id="body-pd" style="padding-top: 1rem;  background-image: url({{asset('imagenes/tres.jpg')}})">

        <header class="" id="header">
            <!-- <svg  style="fill: #4723D9;cursor: pointer;" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 18v-2h18v2Zm0-5v-2h18v2Zm0-5V6h18v2Z"/></svg> -->
        </header>



        <div class="l-navbar" style="background-color: #000000" id="nav-bar">
            <nav class="nav">
                <div style="background-color: #000000">
                    <div class="nav_logo">
                        <svg id="header-toggle" style="fill: white;cursor: pointer;" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                            <path d="M3 18v-2h18v2Zm0-5v-2h18v2Zm0-5V6h18v2Z" /></svg>

                        <!-- <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M2 21q-.425 0-.712-.288Q1 20.425 1 20t.288-.712Q1.575 19 2 19h20q.425 0 .712.288.288.287.288.712t-.288.712Q22.425 21 22 21Zm2-3q-.825 0-1.412-.587Q2 16.825 2 16V5q0-.825.588-1.413Q3.175 3 4 3h16q.825 0 1.413.587Q22 4.175 22 5v11q0 .825-.587 1.413Q20.825 18 20 18Zm0-2h16V5H4v11Zm0 0V5v11Z"/></svg> -->
                        <div class="nav_logo-name">SEPCOM</div>
                    </div>

                    <div class="nav_list">

                        {{-- Registro clientes --}}
                        <a href="{{ route('cliente.index') }}" class="@if(Request::is('/Cliente')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M.1 18.2v-1.625q0-1.2 1.163-1.938Q2.425 13.9 4.25 13.9h.35q-.325.55-.512 1.162-.188.613-.188 1.313V18.2Zm6 0v-1.775q0-1.625 1.638-2.6Q9.375 12.85 12 12.85q2.65 0 4.275.975 1.625.975 1.625 2.6V18.2Zm14 0v-1.825q0-.7-.175-1.313-.175-.612-.525-1.162h.35q1.875 0 3.013.737 1.137.738 1.137 1.938V18.2ZM12 15q-1.075 0-1.988.25-.912.25-1.337.675v.125h6.675v-.125q-.425-.425-1.325-.675Q13.125 15 12 15Zm-7.75-1.975q-.8 0-1.375-.575t-.575-1.4q0-.8.575-1.375T4.25 9.1q.825 0 1.4.562.575.563.575 1.388 0 .8-.575 1.388-.575.587-1.4.587Zm15.5 0q-.8 0-1.375-.575t-.575-1.4q0-.8.575-1.375T19.75 9.1q.825 0 1.388.562.562.563.562 1.388 0 .8-.562 1.388-.563.587-1.388.587Zm-7.75-.9q-1.25 0-2.125-.875T9 9.125Q9 7.875 9.875 7T12 6.125q1.25 0 2.125.875T15 9.125q0 1.25-.875 2.125T12 12.125Zm0-3.85q-.325 0-.587.25-.263.25-.263.6 0 .325.263.587.262.263.612.263t.588-.263q.237-.262.237-.612 0-.325-.25-.575-.25-.25-.6-.25Zm0 7.775Zm0-6.925Z" /></svg>
                            <span class="nav_name">Clientes</span>
                        </a>

                        @if (App\Http\Permiso::traerRol(Auth::user()) == App\Http\Permiso::$roles[0])
                        {{-- Registro empleados --}}
                        <a href="{{ route('empleado.index') }}" class="@if(Request::is('Empleado')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M4.15 22.3q-1.025 0-1.737-.713-.713-.712-.713-1.737V9.25q0-1.025.713-1.737Q3.125 6.8 4.15 6.8h4.7V3.85q0-.9.625-1.525Q10.1 1.7 11 1.7h2q.9 0 1.525.625.625.625.625 1.525V6.8h4.7q1.025 0 1.737.713.713.712.713 1.737v10.6q0 1.025-.713 1.737-.712.713-1.737.713Zm0-2.15h15.7q.125 0 .212-.088.088-.087.088-.212V9.25q0-.125-.088-.213-.087-.087-.212-.087h-4.7q0 .875-.6 1.512-.6.638-1.5.638h-2.1q-.9 0-1.5-.638-.6-.637-.6-1.512h-4.7q-.125 0-.212.087-.088.088-.088.213v10.6q0 .125.088.212.087.088.212.088Zm1.7-2h6.2v-.425q0-.475-.262-.862-.263-.388-.688-.563-.575-.25-1.112-.362-.538-.113-1.038-.113t-1.037.113q-.538.112-1.113.362-.425.175-.687.563-.263.387-.263.862Zm8.2-1.5h4.3v-1.6h-4.3Zm-5.1-1.6q.65 0 1.1-.45.45-.45.45-1.1 0-.65-.45-1.1-.45-.45-1.1-.45-.65 0-1.1.45-.45.45-.45 1.1 0 .65.45 1.1.45.45 1.1.45Zm5.1-1.25h4.3v-1.65h-4.3ZM11 8.95h2v-5.1h-2Zm1 5.6Z" /></svg>
                            <span class="nav_name">Empleados</span>
                        </a>
                        @endif

                        {{-- Registro proveedor --}}
                        <a href="{{ route('proveedor.index') }}" class="@if(Request::is('Proveedor')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M17.25 8.925h2.4v-2.4h-2.4Zm0 4.25h2.4v-2.4h-2.4Zm0 4.25h2.4v-2.4h-2.4Zm-.625 3.875v-2.15h4.55V4.8h-9.1v1.775l-2.1-1.525v-.725q.125-.725.713-1.2.587-.475 1.387-.475h9.1q.925 0 1.538.612.612.613.612 1.538v14.35q0 .925-.612 1.538-.613.612-1.538.612Zm0-10.225Zm-15.95 9V12.2q0-.6.263-1.125.262-.525.762-.875l4.775-3.4q.675-.475 1.463-.475.787 0 1.437.475l4.775 3.4q.5.35.763.875.262.525.262 1.125v7.875q0 .5-.363.863-.362.362-.862.362H9.175v-5.55h-2.5v5.55H1.9q-.5 0-.862-.362-.363-.363-.363-.863Zm2.15-.925h2.1V14h6v5.15h2.1v-7.1l-5.1-3.575-5.1 3.575Zm8.1 0V14h-6v5.15V14h6Z" /></svg>

                            <span class="nav_name">Proveedor</span>
                        </a>

                        {{-- Registro producto --}}
                        <a href="{{ route('show.registroProductos') }}" class="@if(Request::is('Product')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M14.25 21.4q-.575.575-1.425.575-.85 0-1.425-.575l-8.8-8.8q-.275-.275-.437-.65Q2 11.575 2 11.15V4q0-.825.588-1.413Q3.175 2 4 2h7.15q.425 0 .8.162.375.163.65.438l8.8 8.825q.575.575.575 1.412 0 .838-.575 1.413ZM12.825 20l7.15-7.15L11.15 4H4v7.15ZM6.5 8q.625 0 1.062-.438Q8 7.125 8 6.5t-.438-1.062Q7.125 5 6.5 5t-1.062.438Q5 5.875 5 6.5t.438 1.062Q5.875 8 6.5 8ZM4 4Z" /></svg>
                            <span class="nav_name">Productos</span>
                        </a>


                        {{-- Registro compra --}}
                        <a href="{{ route('compra.index') }}" class="@if(Request::is('Compras')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M6 22q-1.25 0-2.125-.875T3 19v-3h3V2l1.5 1.5L9 2l1.5 1.5L12 2l1.5 1.5L15 2l1.5 1.5L18 2l1.5 1.5L21 2v17q0 1.25-.875 2.125T18 22Zm12-2q.425 0 .712-.288Q19 19.425 19 19V5H8v11h9v3q0 .425.288.712.287.288.712.288ZM9 9V7h6v2Zm0 3v-2h6v2Zm8-3q-.425 0-.712-.288Q16 8.425 16 8t.288-.713Q16.575 7 17 7t.712.287Q18 7.575 18 8t-.288.712Q17.425 9 17 9Zm0 3q-.425 0-.712-.288Q16 11.425 16 11t.288-.713Q16.575 10 17 10t.712.287Q18 10.575 18 11t-.288.712Q17.425 12 17 12ZM6 20h9v-2H5v1q0 .425.287.712Q5.575 20 6 20Zm-1 0v-2 2Z" /></svg>
                            <span class="nav_name">Compras</span>
                        </a>

                        {{-- Registro pedido--}}
                        <a href="{{ route('index.pedido') }}" class="@if(Request::is('Pedido')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M6 20q-1.25 0-2.125-.875T3 17H1V6q0-.825.588-1.412Q2.175 4 3 4h14v4h3l3 4v5h-2q0 1.25-.875 2.125T18 20q-1.25 0-2.125-.875T15 17H9q0 1.25-.875 2.125T6 20Zm0-2q.425 0 .713-.288Q7 17.425 7 17t-.287-.712Q6.425 16 6 16t-.713.288Q5 16.575 5 17t.287.712Q5.575 18 6 18Zm-3-3h.8q.425-.45.975-.725Q5.325 14 6 14t1.225.275q.55.275.975.725H15V6H3Zm15 3q.425 0 .712-.288Q19 17.425 19 17t-.288-.712Q18.425 16 18 16t-.712.288Q17 16.575 17 17t.288.712Q17.575 18 18 18Zm-1-5h4.25L19 10h-2Zm-8-2.5Z" /></svg>

                            <span class="nav_name">Pedidos</span>
                        </a>

                        {{-- Registro Iventario --}}
                        <a href="{{ route('inventario.index') }}" class="@if(Request::is('Inventario')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M11.025 20.75h-5.85q-.8 0-1.363-.562-.562-.563-.562-1.363V5.15q0-.825.55-1.375t1.25-.55h4.225q.25-.875 1.013-1.425.762-.55 1.662-.55.95 0 1.7.55t1 1.425h4.2q.825 0 1.375.55t.55 1.375v4.875H18.9V5.1h-2.05v2.875H7.175V5.1h-2.05v13.775h5.9Zm4.425-1.025L11.325 15.6l1.325-1.325 2.8 2.8 5.55-5.55 1.325 1.325ZM12.025 5q.375 0 .65-.275t.275-.675q0-.375-.275-.65t-.65-.275q-.4 0-.675.275t-.275.65q0 .4.275.675t.675.275Z" /></svg>
                            <span class="nav_name">Inventario</span>
                        </a>


                        {{-- Registro Sevicios --}}
                        <li class="nav-item dropdown" id="li_servicios">
                            <a class=" nav_link " id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M1.05 21v-2.8q0-.825.425-1.55.425-.725 1.175-1.1 1.275-.65 2.875-1.1Q7.125 14 9.05 14q1.925 0 3.525.45 1.6.45 2.875 1.1.75.375 1.175 1.1.425.725.425 1.55V21Zm2-2h12v-.8q0-.275-.137-.5-.138-.225-.363-.35-.9-.45-2.312-.9Q10.825 16 9.05 16q-1.775 0-3.187.45-1.413.45-2.313.9-.225.125-.362.35-.138.225-.138.5Zm6-6q-1.65 0-2.825-1.175Q5.05 10.65 5.05 9H4.8q-.225 0-.362-.137Q4.3 8.725 4.3 8.5q0-.225.138-.363Q4.575 8 4.8 8h.25q0-1.125.55-2.025.55-.9 1.45-1.425v.95q0 .225.138.362Q7.325 6 7.55 6q.225 0 .363-.138.137-.137.137-.362V4.15q.225-.075.475-.113Q8.775 4 9.05 4t.525.037q.25.038.475.113V5.5q0 .225.138.362.137.138.362.138.225 0 .363-.138.137-.137.137-.362v-.95q.9.525 1.45 1.425.55.9.55 2.025h.25q.225 0 .363.137.137.138.137.363 0 .225-.137.363Q13.525 9 13.3 9h-.25q0 1.65-1.175 2.825Q10.7 13 9.05 13Zm0-2q.825 0 1.413-.588.587-.587.587-1.412h-4q0 .825.588 1.412Q8.225 11 9.05 11Zm7.5 4-.15-.75q-.15-.05-.287-.113-.138-.062-.263-.187l-.7.25-.5-.9.55-.5v-.6l-.55-.5.5-.9.7.25q.1-.1.25-.175.15-.075.3-.125l.15-.75h1l.15.75q.15.05.3.125t.25.175l.7-.25.5.9-.55.5v.6l.55.5-.5.9-.7-.25q-.125.125-.262.187-.138.063-.288.113l-.15.75Zm.5-1.75q.3 0 .525-.225.225-.225.225-.525 0-.3-.225-.525-.225-.225-.525-.225-.3 0-.525.225-.225.225-.225.525 0 .3.225.525.225.225.525.225Zm1.8-3.25-.2-1.05q-.225-.075-.412-.188-.188-.112-.338-.262l-1.05.35-.7-1.2.85-.75q-.05-.125-.05-.2v-.4q0-.075.05-.2l-.85-.75.7-1.2 1.05.35q.15-.15.338-.263.187-.112.412-.187l.2-1.05h1.4l.2 1.05q.225.075.413.187.187.113.337.263l1.05-.35.7 1.2-.85.75q.05.125.05.2v.4q0 .075-.05.2l.85.75-.7 1.2-1.05-.35q-.15.15-.337.262-.188.113-.413.188l-.2 1.05Zm.7-2.25q.525 0 .888-.363.362-.362.362-.887t-.362-.888q-.363-.362-.888-.362t-.887.362q-.363.363-.363.888t.363.887q.362.363.887.363ZM3.05 19h12-12Z" /></svg>
                                <span class="nav_name dropdown-toggle">Servicios</span>
                            </a>
                            <div style="position: fixed;background: black;display:none;margin-left:-1rem" id="submenu_servicio">
                                <a class="nav_link1 " href="{{ route('reparacion.index') }}"><i class="bi bi-wrench-adjustable"> Reparación</i></a>

                                <a class="nav_link1 " href="{{ route('mantenimiento.index') }}"> <i class="bi bi-pc-display"> Mantenimiento </i> </a>
                            </div>
                        </li>

                        @if (App\Http\Permiso::traerRol(Auth::user()) == App\Http\Permiso::$roles[0])
                        {{-- rango factura --}}
                        <a href="{{ route('RangoFactura.index') }}" class="@if(Request::is('rangofactura')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M3 20q-.825 0-1.412-.587Q1 18.825 1 18q0-.825.588-1.413Q2.175 16 3 16h.263q.112 0 .237.05l4.55-4.55Q8 11.375 8 11.262V11q0-.825.588-1.413Q9.175 9 10 9t1.413.587Q12 10.175 12 11q0 .05-.05.5l2.55 2.55q.125-.05.238-.05h.524q.113 0 .238.05l3.55-3.55q-.05-.125-.05-.238V10q0-.825.587-1.413Q20.175 8 21 8q.825 0 1.413.587Q23 9.175 23 10q0 .825-.587 1.412Q21.825 12 21 12h-.262q-.113 0-.238-.05l-3.55 3.55q.05.125.05.238V16q0 .825-.587 1.413Q15.825 18 15 18q-.825 0-1.412-.587Q13 16.825 13 16v-.262q0-.113.05-.238l-2.55-2.55q-.125.05-.238.05H10q-.05 0-.5-.05L4.95 17.5q.05.125.05.238V18q0 .825-.588 1.413Q3.825 20 3 20ZM4 9.975l-.625-1.35L2.025 8l1.35-.625L4 6.025l.625 1.35L5.975 8l-1.35.625ZM15 9l-.95-2.05L12 6l2.05-.95L15 3l.95 2.05L18 6l-2.05.95Z"/></svg>
                            <span class="nav_name">Rango factura</span>
                        </a>
                        @endif



                        {{-- ventas--}}
                        <a href="{{ route('Venta.index') }}" class="@if(Request::is('venta')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                            <path d="M7 8q-.825 0-1.412-.588Q5 6.825 5 6V4q0-.825.588-1.413Q6.175 2 7 2h10q.825 0 1.413.587Q19 3.175 19 4v2q0 .825-.587 1.412Q17.825 8 17 8Zm0-2h10V4H7v2ZM4 22q-.825 0-1.412-.587Q2 20.825 2 20v-1h20v1q0 .825-.587 1.413Q20.825 22 20 22Zm-2-4 3.475-7.825q.25-.55.75-.863Q6.725 9 7.3 9h9.4q.575 0 1.075.312.5.313.75.863L22 18Zm6.5-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 15 9.5 15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 13 9.5 13h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 11 9.5 11h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Z"/></svg>
                            <span class="nav_name">Ventas</span>
                        </a>

                        {{-- Devoluciones--}}
                        <a href="{{ route('devolucion.index') }}" class="@if(Request::is('devolucion')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 96 960 960" width="28"><path d="M160 316v-60h642v60H160Zm5 580V638h-49v-60l44-202h641l44 202v60h-49v258h-60V638H547v258H165Zm60-60h262V638H225v198Zm-50-258h611-611Zm0 0h611l-31-142H206l-31 142Z"/></svg>
                            <span class="nav_name">Devolucion garantia</span>
                        </a>


                        {{-- Gastos --}}
                        <a href="{{ route('gasto.index') }}" class="@if(Request::is('gasto')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="28" width="28"><path d="M12 23q-2.8 0-5.15-1.275Q4.5 20.45 3 18.325V21H1v-6h6v2H4.525q1.2 1.8 3.163 2.9Q9.65 21 12 21q1.875 0 3.513-.712 1.637-.713 2.85-1.926 1.212-1.212 1.925-2.85Q21 13.875 21 12h2q0 2.275-.862 4.275-.863 2-2.363 3.5t-3.5 2.362Q14.275 23 12 23Zm-.9-4v-1.3q-1.175-.275-1.912-1.012Q8.45 15.95 8.1 14.75l1.65-.65q.3 1.025.938 1.537.637.513 1.462.513t1.412-.388q.588-.387.588-1.212 0-.725-.612-1.175-.613-.45-2.188-1.025-1.475-.525-2.162-1.25-.688-.725-.688-1.9 0-1.025.713-1.863.712-.837 1.937-1.087V5h1.75v1.25q.9.075 1.638.725.737.65 1.012 1.525l-1.6.65q-.2-.575-.65-.962-.45-.388-1.25-.388-.875 0-1.337.375-.463.375-.463 1.025 0 .65.575 1.025.575.375 2.075.875 1.8.65 2.4 1.525.6.875.6 1.925 0 .725-.25 1.275-.25.55-.662.937-.413.388-.963.625-.55.238-1.175.363V19ZM1 12q0-2.275.863-4.275.862-2 2.362-3.5t3.5-2.363Q9.725 1 12 1q2.8 0 5.15 1.275Q19.5 3.55 21 5.675V3h2v6h-6V7h2.475q-1.2-1.8-3.163-2.9Q14.35 3 12 3q-1.875 0-3.512.712-1.638.713-2.85 1.925-1.213 1.213-1.926 2.85Q3 10.125 3 12Z"/></svg>
                            <span class="nav_name">Gastos </span>
                        </a>

                        @if (App\Http\Permiso::traerRol(Auth::user()) == App\Http\Permiso::$roles[0])
                        {{-- usuarios --}}
                            <a href="{{ route('index.usuario') }}" class="@if(Request::is('usuario')) nav_link active @else nav_link @endif">
                                <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="28" width="28"><path d="M12.5 11.95q.725-.8 1.113-1.825Q14 9.1 14 8t-.387-2.125Q13.225 4.85 12.5 4.05q1.5.2 2.5 1.325T16 8q0 1.5-1 2.625t-2.5 1.325ZM18 20v-3q0-.9-.4-1.712-.4-.813-1.05-1.438 1.275.45 2.363 1.162Q20 15.725 20 17v3Zm2-7v-2h-2V9h2V7h2v2h2v2h-2v2ZM8 12q-1.65 0-2.825-1.175Q4 9.65 4 8q0-1.65 1.175-2.825Q6.35 4 8 4q1.65 0 2.825 1.175Q12 6.35 12 8q0 1.65-1.175 2.825Q9.65 12 8 12Zm-8 8v-2.8q0-.85.438-1.563.437-.712 1.162-1.087 1.55-.775 3.15-1.163Q6.35 13 8 13t3.25.387q1.6.388 3.15 1.163.725.375 1.162 1.087Q16 16.35 16 17.2V20Z"/></svg>
                                <span class="nav_name">Usuarios </span>
                            </a>
                        {{-- Planilla --}}
                          <a href="{{ route('index.planilla') }}" class="@if(Request::is('planilla')) nav_link active @else nav_link @endif">
                            <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 96 960 960" width="28"><path d="M640 653q-51 0-84.5-33.5T522 535q0-51 33.5-84.5T640 417q51 0 84.5 33.5T758 535q0 51-33.5 84.5T640 653ZM400 896v-66q0-18.864 9-35.932T433 770q45-32 98.5-47.5T640 707q55 0 108 17t99 46q14 10 23.5 25.5T880 830v66H400Zm55-71v11h370v-11q-39-26-90-42t-95-16q-44 0-95.5 16T455 825Zm185-232q26 0 42-16t16-42q0-26-16-42t-42-16q-26 0-42 16t-16 42q0 26 16 42t42 16Zm0-58Zm0 301ZM120 646v-60h306v60H120Zm0-330v-60h473v60H120Zm349 165H120v-60h380q-11 13-18.727 27.921Q473.545 463.841 469 481Z"/></svg>
                            <span class="nav_name">Planilla</span>
                        </a>
                        @endif














                    </div>
                </div>


                <a href="#" class="nav_link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-video" viewBox="0 0 16 16">
                        <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                        <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2Zm10.798 11c-.453-1.27-1.76-3-4.798-3-3.037 0-4.345 1.73-4.798 3H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1.202Z"/>
                      </svg>
                    <span class="nav_name">{{ Auth::user()->name }}</span>
                </a>

                <a href="#" onclick="logou()" class="nav_link">
                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                        <path d="M5 21q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h7v2H5v14h7v2Zm11-4-1.375-1.45 2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5Z" /></svg>
                    <span class="nav_name">Salir</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" id="formulario_logout" hidden>
                    @csrf
                </form>
            </nav>
        </div>







        <!--IMAGEN DE FONDO AZUL-->
        <!--Container Main start-->
        <!-- background-image: url('imagenes/compu.png') -->
        <div class="bo" style="padding-top: 1rem; background-image: url({{asset('imagenes/tres.jpg')}})">
            <!-- <div class="bo" style="padding-top: 1rem; background-image: URL::asset('imagenes/tres.jpg'"> -->

            @yield('main-content')
        </div>


        @stack('scripstss')
        <script>
            function logou(){
                Swal.fire({
                    title: '¿Está seguro que desea cerrar la sesión?',
                    icon: 'question',
                    confirmButtonColor: '#3085d6',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result)=>{
                        if (result.isConfirmed) {
                            document.getElementById('formulario_logout').submit();
                        }
                })

            }
        </script>

        <!--Container Main end-->



    </body>



</section>

</html>

