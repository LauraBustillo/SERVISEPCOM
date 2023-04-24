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
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">


   
</head>

<style>
    .bo {
        background-color:transparent;
        background-position: 0, center;
        background-repeat: no-repeat, repeat;
        background-size: cover, auto;
        background-attachment: fixed, scroll;
    }


    .nav_link {
        position: relative;
        color: white !important;
        margin-bottom: 0.5rem;
        background-image: radial-gradient(circle at 52.46% 56.76%, var(--bs-info) 0, #378d99c7 50%, #080808 100%) !important;
        
    }

    .nav_link2 {
        position: relative;
        color: white !important;
        margin-bottom: 0.5rem;
        background-image: radial-gradient(circle at 52.46% 56.76%, var(--bs-info) 0, #54b3c090 50%, #0c0c0c75 100%) !important;

        
    }

    .nav_link3 {
        position: relative;
        color: white !important;
        margin-bottom: 0.5rem;
        left: -32px;
        width: 116% !important;
        background-image: radial-gradient(circle at 52.46% 56.76%, var(--bs-info) 0, #216e7977 50%, #0c0c0c58 100%) !important;
    }

    .nav_link1 {
        position: relative;
        color: white !important;
        margin-bottom: 8rem !important;
        padding-left: 30% !important;
        background-image: radial-gradient(circle at 52.46% 56.76%, var(--bs-info) 0, #378d99c7 50%, #080808 100%) !important;

    }

    .sidebar-nav {
        padding: 9px;
        background-image: radial-gradient(circle at 52.46% 56.76%, var(--bs-info) 0, #378d99c7 50%, #080808 100%) !important;
    }




    .dropdown-toggle {
        color: #f5f5f5 !important;
        background-image: radial-gradient(circle at 52.46% 56.76%, var(--bs-info) 0, #378d99c7 50%, #080808 100%) !important;
    }

.scrollable-content {

  overflow-y: scroll;
  scrollbar-color: #999 #f5f5f5;
  height: 100%;
  width: 300px;
  background-image: radial-gradient(circle at 52.46% 56.76%, var(--bs-info) 0, #378d99c7 50%, #080808 100%) !important;


}

.scrollable-content1 {

overflow-y: scroll;
scrollbar-color: #999 #f5f5f5;
height: 100%;
width: 100%;
background-image: radial-gradient(circle at 52.46% 56.76%, var(--bs-info) 0, #378d99c7 50%, #080808 100%) !important;


}

.scrollable-content::-webkit-scrollbar {
  width: 15px;
}

.scrollable-content::-webkit-scrollbar-track {
    background-image: radial-gradient(circle at 52.46% 56.76%, var(--bs-info) 0, #378d99c7 50%, #080808 100%) !important;}

.scrollable-content::-webkit-scrollbar-thumb {
  background-color: #999;
  border-radius: 30px;
  border: 1px solid #f5f5f5;
  background-image: radial-gradient(circle at 52.46% 56.76%, var(--bs-info) 0, #378d99c7 50%, #080808 100%) !important;
}



 
.nav_logo-name{
    color: var(--white-color);
    font-weight: 700;
    margin-bottom: 0% !important;
    
}

.nav_logo{
    color: var(--white-color);
    font-weight: 700;
    margin-bottom: 0% !important;
padding-left: 35% !important;
}

.bg-light {
    background-color: transparent !important;

}


.blanco{
    color:white !important;

}

* {
  margin: 0;
  padding: 0;
}

ul {
  list-style: none;
  width: 100%;
}

.accordion-menu {
 
  max-width: 350px;
  margin: 0px auto 20px;
  background: transparent;
  border-radius: 1px;
}
.accordion-menu li.open .dropdownlink {
  
  color: #294093;
  .fa-chevron-down {
    transform: rotate(180deg);
  }
}
.accordion-menu li:last-child .dropdownlink {
  border-bottom: 0;

}
.dropdownlink {
  cursor: pointer;
  display: block;
  padding: 10px 10px 10px 45px;
  font-size: 18px;
  border-bottom: 1px solid #ccc;
  color: #212121;
  position: relative;
  transition: all 0.4s ease-out;
  i {
    position: absolute;
    top: 17px;
    left: 16px;
  }
  .fa-chevron-down {
    right: 12px;
    left: 3;
  }
}

.submenuItems {
  display: none;
  background: transparent;
  padding-left: 0.5% !important;
  li li{
    border-bottom: 1px solid #B6B6B6;
  }
}

.submenuItems a {
  display: block;
  color: #727272;
  padding: 10px 10px 10px 45px;
  transition: all 0.4s ease-out;

  &:hover {
    background-color: #7c68ee75;
  }
}
</style>
<script>

$(function() {
  var Accordion = function(el, multiple) {
    this.el = el || {};
    // more then one submenu open?
    this.multiple = multiple || false;
    
    var dropdownlink = this.el.find('.dropdownlink');
    dropdownlink.on('click',
                    { el: this.el, multiple: this.multiple },
                    this.dropdown);
  };
  
  Accordion.prototype.dropdown = function(e) {
    var $el = e.data.el,
        $this = $(this),
        //this is the ul.submenuItems
        $next = $this.next();
    
    $next.slideToggle();
    $this.parent().toggleClass('open');
    
    if(!e.data.multiple) {
      //show only one menu at the same time
      $el.find('.submenuItems').not($next).slideUp().parent().removeClass('open');
      $el.find('.submenuItems1').not($next).slideUp().parent().removeClass('open');
    }
  }
  
  var accordion = new Accordion($('.accordion-menu'), false);
})
</script>
<section class="content">

    {{-- Color del menu--}}
    
    <body class="bo " id="body-pd" style="padding-top: 1rem; background-size:100% 100%; zoom:68%;  background-image: url({{asset('imagenes/fondo2.jpg')}})">

            <nav class="l-navbar scrollable-content " style="background-image: radial-gradient(circle at 52.46% 56.76%, #635e75 0, #413e5e 50%, #1d2148 100%);" id="nav-bar" >

                <div  style="background-color: transparent" >
                    <div class="nav_logo ">
                        <img id="" height="24" width="24" src="imagenes/Sepcom-logo.png" alt="" srcset="">
                        <div class="nav_logo-name">
                            <a href="{{ route('dashboard') }}" class="blanco" > SEPCOM</a>
                          
                        </div>
                    </div>
                
                    <div class="nav_list " >
                        <ul class="accordion-menu">
                            <li>
                              <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white " xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M.1 18.2v-1.625q0-1.2 1.163-1.938Q2.425 13.9 4.25 13.9h.35q-.325.55-.512 1.162-.188.613-.188 1.313V18.2Zm6 0v-1.775q0-1.625 1.638-2.6Q9.375 12.85 12 12.85q2.65 0 4.275.975 1.625.975 1.625 2.6V18.2Zm14 0v-1.825q0-.7-.175-1.313-.175-.612-.525-1.162h.35q1.875 0 3.013.737 1.137.738 1.137 1.938V18.2ZM12 15q-1.075 0-1.988.25-.912.25-1.337.675v.125h6.675v-.125q-.425-.425-1.325-.675Q13.125 15 12 15Zm-7.75-1.975q-.8 0-1.375-.575t-.575-1.4q0-.8.575-1.375T4.25 9.1q.825 0 1.4.562.575.563.575 1.388 0 .8-.575 1.388-.575.587-1.4.587Zm15.5 0q-.8 0-1.375-.575t-.575-1.4q0-.8.575-1.375T19.75 9.1q.825 0 1.388.562.562.563.562 1.388 0 .8-.562 1.388-.563.587-1.388.587Zm-7.75-.9q-1.25 0-2.125-.875T9 9.125Q9 7.875 9.875 7T12 6.125q1.25 0 2.125.875T15 9.125q0 1.25-.875 2.125T12 12.125Zm0-3.85q-.325 0-.587.25-.263.25-.263.6 0 .325.263.587.262.263.612.263t.588-.263q.237-.262.237-.612 0-.325-.25-.575-.25-.25-.6-.25Zm0 7.775Zm0-6.925Z" /></svg> 
                                <span class="nav_name " Style="padding-left:5%">Clientes</span>
                                
                              </div>
        
                                <ul class="submenuItems">
                                    <li><a href="{{ route('cliente.index') }}" class="@if(Request::is('/Cliente')) nav_link2 active @else nav_link2 @endif">
                                        <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                                <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>  
                                                Listado </a></li>
                                    <li><a href="{{route('show.registroCliente')}}" class="@if(Request::is('Cliente')) nav_link2 active @else nav_link2 @endif">
                                        <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                                <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg> 
                                            Registro </a></li>  
                                    </li>
                                </ul>
                            </li>
        
                            @if (App\Http\Permiso::traerRol(Auth::user()) == App\Http\Permiso::$roles[0])
                            <li>
                              <div class="dropdownlink nav_link " Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M4.15 22.3q-1.025 0-1.737-.713-.713-.712-.713-1.737V9.25q0-1.025.713-1.737Q3.125 6.8 4.15 6.8h4.7V3.85q0-.9.625-1.525Q10.1 1.7 11 1.7h2q.9 0 1.525.625.625.625.625 1.525V6.8h4.7q1.025 0 1.737.713.713.712.713 1.737v10.6q0 1.025-.713 1.737-.712.713-1.737.713Zm0-2.15h15.7q.125 0 .212-.088.088-.087.088-.212V9.25q0-.125-.088-.213-.087-.087-.212-.087h-4.7q0 .875-.6 1.512-.6.638-1.5.638h-2.1q-.9 0-1.5-.638-.6-.637-.6-1.512h-4.7q-.125 0-.212.087-.088.088-.088.213v10.6q0 .125.088.212.087.088.212.088Zm1.7-2h6.2v-.425q0-.475-.262-.862-.263-.388-.688-.563-.575-.25-1.112-.362-.538-.113-1.038-.113t-1.037.113q-.538.112-1.113.362-.425.175-.687.563-.263.387-.263.862Zm8.2-1.5h4.3v-1.6h-4.3Zm-5.1-1.6q.65 0 1.1-.45.45-.45.45-1.1 0-.65-.45-1.1-.45-.45-1.1-.45-.65 0-1.1.45-.45.45-.45 1.1 0 .65.45 1.1.45.45 1.1.45Zm5.1-1.25h4.3v-1.65h-4.3ZM11 8.95h2v-5.1h-2Zm1 5.6Z" /></svg>
                            <span class="nav_name " Style="padding-left:5%">Empleados</span>
                                
                              </div>
                              <ul class="submenuItems">
                                <li><a href="{{ route('empleado.index') }}" class="@if(Request::is('/Empleado')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                            <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                        <path d="M680 936q-17 0-28.5-11.5T640 896V576q0-17 11.5-28.5T680 536h160q17 0 28.5 11.5T880 576v320q0 17-11.5 28.5T840 936H680Zm0-60h160V596H680v280Zm-360 60v-60h90V776H140q-23 0-41.5-18.5T80 716V276q0-23 18.5-41.5T140 216h599q23 0 42 18.5t19 41.5v200h-60V276h.5H140v440h440v60H470v100h90v60H320Zm33-298 86-67 87 67-33-112 87-65H475l-36-103-35 103H300l85 65-32 112Zm88-142Z"/></svg> 
                                            Listado</a></li>
                                <li><a href="{{route('show.registroEmpleado')}}" class="@if(Request::is('Empleado')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                            <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                        <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                            Registro</a></li>
                              </ul>
                            </li>
                            @endif
        
        
                            <li>
                              <div class="dropdownlink nav_link " Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M17.25 8.925h2.4v-2.4h-2.4Zm0 4.25h2.4v-2.4h-2.4Zm0 4.25h2.4v-2.4h-2.4Zm-.625 3.875v-2.15h4.55V4.8h-9.1v1.775l-2.1-1.525v-.725q.125-.725.713-1.2.587-.475 1.387-.475h9.1q.925 0 1.538.612.612.613.612 1.538v14.35q0 .925-.612 1.538-.613.612-1.538.612Zm0-10.225Zm-15.95 9V12.2q0-.6.263-1.125.262-.525.762-.875l4.775-3.4q.675-.475 1.463-.475.787 0 1.437.475l4.775 3.4q.5.35.763.875.262.525.262 1.125v7.875q0 .5-.363.863-.362.362-.862.362H9.175v-5.55h-2.5v5.55H1.9q-.5 0-.862-.362-.363-.363-.363-.863Zm2.15-.925h2.1V14h6v5.15h2.1v-7.1l-5.1-3.575-5.1 3.575Zm8.1 0V14h-6v5.15V14h6Z" /></svg>
                            <span class="nav_name" Style="padding-left:5%">Proveedor</span>
                                
                              </div>
                              <ul class="submenuItems">
                                <li ><a href="{{ route('proveedor.index') }}" class="@if(Request::is('/Proveedor')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                            <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                        <path d="M680 936q-17 0-28.5-11.5T640 896V576q0-17 11.5-28.5T680 536h160q17 0 28.5 11.5T880 576v320q0 17-11.5 28.5T840 936H680Zm0-60h160V596H680v280Zm-360 60v-60h90V776H140q-23 0-41.5-18.5T80 716V276q0-23 18.5-41.5T140 216h599q23 0 42 18.5t19 41.5v200h-60V276h.5H140v440h440v60H470v100h90v60H320Zm33-298 86-67 87 67-33-112 87-65H475l-36-103-35 103H300l85 65-32 112Zm88-142Z"/></svg> 
                                            Listado</a></li></li>
                                <li><a href="{{route('show.registroProveedor')}}" class="@if(Request::is('Proveedor')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                            <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                        <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                            Registro</a></li>
                              </ul>
                            </li>
        
                            <li>
                              <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                <path d="M14.25 21.4q-.575.575-1.425.575-.85 0-1.425-.575l-8.8-8.8q-.275-.275-.437-.65Q2 11.575 2 11.15V4q0-.825.588-1.413Q3.175 2 4 2h7.15q.425 0 .8.162.375.163.65.438l8.8 8.825q.575.575.575 1.412 0 .838-.575 1.413ZM12.825 20l7.15-7.15L11.15 4H4v7.15ZM6.5 8q.625 0 1.062-.438Q8 7.125 8 6.5t-.438-1.062Q7.125 5 6.5 5t-1.062.438Q5 5.875 5 6.5t.438 1.062Q5.875 8 6.5 8ZM4 4Z" /></svg>
                            <span class="nav_name" Style="padding-left:5%">Productos</span>
                                
                              </div>
                              <ul class="submenuItems">
                                <li><a href="{{ route('show.registroProductos') }}" class="@if(Request::is('Product')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                            <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                        
                                            Registro </a></li>
                              </ul>
                            </li>
        
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M6 22q-1.25 0-2.125-.875T3 19v-3h3V2l1.5 1.5L9 2l1.5 1.5L12 2l1.5 1.5L15 2l1.5 1.5L18 2l1.5 1.5L21 2v17q0 1.25-.875 2.125T18 22Zm12-2q.425 0 .712-.288Q19 19.425 19 19V5H8v11h9v3q0 .425.288.712.287.288.712.288ZM9 9V7h6v2Zm0 3v-2h6v2Zm8-3q-.425 0-.712-.288Q16 8.425 16 8t.288-.713Q16.575 7 17 7t.712.287Q18 7.575 18 8t-.288.712Q17.425 9 17 9Zm0 3q-.425 0-.712-.288Q16 11.425 16 11t.288-.713Q16.575 10 17 10t.712.287Q18 10.575 18 11t-.288.712Q17.425 12 17 12ZM6 20h9v-2H5v1q0 .425.287.712Q5.575 20 6 20Zm-1 0v-2 2Z" /></svg>
                                <span class="nav_name" Style="padding-left:5%">Compras</span>
                                  
                                </div>
                                <ul class="submenuItems">
                                  <li><a href="{{ route('compra.index') }}" class="@if(Request::is('Compras')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                        <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                            
                                            Listado</a></li>
                                  <li><a href="{{route('show.registroCompras')}}"  class="@if(Request::is('Compras')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                        <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                            
                                            Registro</a></li>
                                </ul>
                            </li>
        
        
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M6 20q-1.25 0-2.125-.875T3 17H1V6q0-.825.588-1.412Q2.175 4 3 4h14v4h3l3 4v5h-2q0 1.25-.875 2.125T18 20q-1.25 0-2.125-.875T15 17H9q0 1.25-.875 2.125T6 20Zm0-2q.425 0 .713-.288Q7 17.425 7 17t-.287-.712Q6.425 16 6 16t-.713.288Q5 16.575 5 17t.287.712Q5.575 18 6 18Zm-3-3h.8q.425-.45.975-.725Q5.325 14 6 14t1.225.275q.55.275.975.725H15V6H3Zm15 3q.425 0 .712-.288Q19 17.425 19 17t-.288-.712Q18.425 16 18 16t-.712.288Q17 16.575 17 17t.288.712Q17.575 18 18 18Zm-1-5h4.25L19 10h-2Zm-8-2.5Z" /></svg>
                                <span class="nav_name" Style="padding-left:5%">Pedidos</span>
                                  
                                </div>
                                <ul class="submenuItems">
                                  <li><a href="{{ route('index.pedido') }}"  class="@if(Request::is('Pedido')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                        <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                            
                                            Listado</a></li>
                                  <li><a href="{{route('create.pedido')}}"  class="@if(Request::is('Pedido')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                        <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                            
                                            Registro</a></li>
                                </ul>
                            </li>
        
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M11.025 20.75h-5.85q-.8 0-1.363-.562-.562-.563-.562-1.363V5.15q0-.825.55-1.375t1.25-.55h4.225q.25-.875 1.013-1.425.762-.55 1.662-.55.95 0 1.7.55t1 1.425h4.2q.825 0 1.375.55t.55 1.375v4.875H18.9V5.1h-2.05v2.875H7.175V5.1h-2.05v13.775h5.9Zm4.425-1.025L11.325 15.6l1.325-1.325 2.8 2.8 5.55-5.55 1.325 1.325ZM12.025 5q.375 0 .65-.275t.275-.675q0-.375-.275-.65t-.65-.275q-.4 0-.675.275t-.275.65q0 .4.275.675t.675.275Z" /></svg>
                                <span class="nav_name" Style="padding-left:5%">Inventario</span>
                                  
                                </div>
                                <ul class="submenuItems">
                                  <li><a href="{{ route('inventario.index') }}"   class="@if(Request::is('Inventario')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                        <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                            
                                            Listado</a></li>
                                </ul>
                            </li>
        
        
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M1.05 21v-2.8q0-.825.425-1.55.425-.725 1.175-1.1 1.275-.65 2.875-1.1Q7.125 14 9.05 14q1.925 0 3.525.45 1.6.45 2.875 1.1.75.375 1.175 1.1.425.725.425 1.55V21Zm2-2h12v-.8q0-.275-.137-.5-.138-.225-.363-.35-.9-.45-2.312-.9Q10.825 16 9.05 16q-1.775 0-3.187.45-1.413.45-2.313.9-.225.125-.362.35-.138.225-.138.5Zm6-6q-1.65 0-2.825-1.175Q5.05 10.65 5.05 9H4.8q-.225 0-.362-.137Q4.3 8.725 4.3 8.5q0-.225.138-.363Q4.575 8 4.8 8h.25q0-1.125.55-2.025.55-.9 1.45-1.425v.95q0 .225.138.362Q7.325 6 7.55 6q.225 0 .363-.138.137-.137.137-.362V4.15q.225-.075.475-.113Q8.775 4 9.05 4t.525.037q.25.038.475.113V5.5q0 .225.138.362.137.138.362.138.225 0 .363-.138.137-.137.137-.362v-.95q.9.525 1.45 1.425.55.9.55 2.025h.25q.225 0 .363.137.137.138.137.363 0 .225-.137.363Q13.525 9 13.3 9h-.25q0 1.65-1.175 2.825Q10.7 13 9.05 13Zm0-2q.825 0 1.413-.588.587-.587.587-1.412h-4q0 .825.588 1.412Q8.225 11 9.05 11Zm7.5 4-.15-.75q-.15-.05-.287-.113-.138-.062-.263-.187l-.7.25-.5-.9.55-.5v-.6l-.55-.5.5-.9.7.25q.1-.1.25-.175.15-.075.3-.125l.15-.75h1l.15.75q.15.05.3.125t.25.175l.7-.25.5.9-.55.5v.6l.55.5-.5.9-.7-.25q-.125.125-.262.187-.138.063-.288.113l-.15.75Zm.5-1.75q.3 0 .525-.225.225-.225.225-.525 0-.3-.225-.525-.225-.225-.525-.225-.3 0-.525.225-.225.225-.225.525 0 .3.225.525.225.225.525.225Zm1.8-3.25-.2-1.05q-.225-.075-.412-.188-.188-.112-.338-.262l-1.05.35-.7-1.2.85-.75q-.05-.125-.05-.2v-.4q0-.075.05-.2l-.85-.75.7-1.2 1.05.35q.15-.15.338-.263.187-.112.412-.187l.2-1.05h1.4l.2 1.05q.225.075.413.187.187.113.337.263l1.05-.35.7 1.2-.85.75q.05.125.05.2v.4q0 .075-.05.2l.85.75-.7 1.2-1.05-.35q-.15.15-.337.262-.188.113-.413.188l-.2 1.05Zm.7-2.25q.525 0 .888-.363.362-.362.362-.887t-.362-.888q-.363-.362-.888-.362t-.887.362q-.363.363-.363.888t.363.887q.362.363.887.363ZM3.05 19h12-12Z" /></svg>
                                <span class="nav_name " Style="padding-left:5%">Servicios</span>
                                  
                                </div>
                                <ul class="submenuItems">
                                    <li ><div style="padding: 10px 10px 10px 45px" class="nav_link2" Style="padding-left:8%">
                                        <svg  style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                            <path d="M680 936q-17 0-28.5-11.5T640 896V576q0-17 11.5-28.5T680 536h160q17 0 28.5 11.5T880 576v320q0 17-11.5 28.5T840 936H680Zm0-60h160V596H680v280Zm-360 60v-60h90V776H140q-23 0-41.5-18.5T80 716V276q0-23 18.5-41.5T140 216h599q23 0 42 18.5t19 41.5v200h-60V276h.5H140v440h440v60H470v100h90v60H320Zm33-298 86-67 87 67-33-112 87-65H475l-36-103-35 103H300l85 65-32 112Zm88-142Z"/></svg> 
                                            <span class="nav_name " Style="padding-left:5%">Mantenimiento</span></div>

                                        <ul >
                                            <li ><a Style="padding-left:35%" href="{{ route('mantenimiento.index') }}" class="@if(Request::is('Mantenimiento')) nav_link3 active @else nav_link3 @endif">
                                                <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                                    <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                            
                                                    Listado</a></li>
                                            <li><a Style="padding-left:35%" href="{{ route('mantenimiento.index') }}" class="@if(Request::is('Mantenimiento')) nav_link3 active @else nav_link3 @endif">
                                                <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                                    <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                           
                                                        Registro</a></li>
        
                                        </ul>
                                    </li>
        
                                    <li><div style="padding: 10px 10px 10px 45px" class="nav_link2" Style="padding-left:8%">
                                        <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                            <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                            <span class="nav_name " Style="padding-left:5%">Reparación</span></div>

                                        <ul>
                                            <li><a Style="padding-left:35%" href="{{ route('reparacion.index') }}" class="@if(Request::is('Reparacion')) nav_link3 active @else nav_link3 @endif">
                                                <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                                    <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                            
                                                        Listado</a></li>
                                            <li><a Style="padding-left:35%" href="{{ route('mantenimiento.index') }}" class="@if(Request::is('Mantenimiento')) nav_link3 active @else nav_link3 @endif">
                                                <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                                    <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                           
                                                        Registro</a></li>
        
                                        </ul>
                                    </li>
                                </ul>
                            </li>
        
                            @if (App\Http\Permiso::traerRol(Auth::user()) == App\Http\Permiso::$roles[0])
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M3 20q-.825 0-1.412-.587Q1 18.825 1 18q0-.825.588-1.413Q2.175 16 3 16h.263q.112 0 .237.05l4.55-4.55Q8 11.375 8 11.262V11q0-.825.588-1.413Q9.175 9 10 9t1.413.587Q12 10.175 12 11q0 .05-.05.5l2.55 2.55q.125-.05.238-.05h.524q.113 0 .238.05l3.55-3.55q-.05-.125-.05-.238V10q0-.825.587-1.413Q20.175 8 21 8q.825 0 1.413.587Q23 9.175 23 10q0 .825-.587 1.412Q21.825 12 21 12h-.262q-.113 0-.238-.05l-3.55 3.55q.05.125.05.238V16q0 .825-.587 1.413Q15.825 18 15 18q-.825 0-1.412-.587Q13 16.825 13 16v-.262q0-.113.05-.238l-2.55-2.55q-.125.05-.238.05H10q-.05 0-.5-.05L4.95 17.5q.05.125.05.238V18q0 .825-.588 1.413Q3.825 20 3 20ZM4 9.975l-.625-1.35L2.025 8l1.35-.625L4 6.025l.625 1.35L5.975 8l-1.35.625ZM15 9l-.95-2.05L12 6l2.05-.95L15 3l.95 2.05L18 6l-2.05.95Z" /></svg>
                                <span class="nav_name" Style="padding-left:5%">Rango factura</span>
                                  
                                </div>
                                <ul class="submenuItems">
                                  <li><a href="{{ route('RangoFactura.index') }}"   class="@if(Request::is('rangofactura')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                               
                                            Listado</a></li>
                                  <li><a href="{{route('create.rangofactura')}}"   class="@if(Request::is('rangofactura')) nav_link active2 @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                           
                                        Registro</a></li>
                                </ul>
                            </li>
                            @endif
        
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M7 8q-.825 0-1.412-.588Q5 6.825 5 6V4q0-.825.588-1.413Q6.175 2 7 2h10q.825 0 1.413.587Q19 3.175 19 4v2q0 .825-.587 1.412Q17.825 8 17 8Zm0-2h10V4H7v2ZM4 22q-.825 0-1.412-.587Q2 20.825 2 20v-1h20v1q0 .825-.587 1.413Q20.825 22 20 22Zm-2-4 3.475-7.825q.25-.55.75-.863Q6.725 9 7.3 9h9.4q.575 0 1.075.312.5.313.75.863L22 18Zm6.5-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 15 9.5 15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 13 9.5 13h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 11 9.5 11h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Z" /></svg>
                                <span class="nav_name" Style="padding-left:5%">Ventas</span>
                                  
                                </div>
                                <ul class="submenuItems">
                                  <li><a href="{{ route('Venta.index') }}"   class="@if(Request::is('venta')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                                
                                            Listado</a></li>
                                  <li><a href="{{route('show.registroventa')}}"   class="@if(Request::is('venta')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                            
                                        Registro</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M160 316v-60h642v60H160Zm5 580V638h-49v-60l44-202h641l44 202v60h-49v258h-60V638H547v258H165Zm60-60h262V638H225v198Zm-50-258h611-611Zm0 0h611l-31-142H206l-31 142Z" /></svg>
                                <span class="nav_name" Style="padding-left:5%">Devolución garantía</span>
                                  
                                </div>
                                <ul class="submenuItems">
                                  <li><a href="{{ route('devolucion.index') }}"  class="@if(Request::is('devolucion')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                                <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                            Listado</a></li>
                                  <li><a href="{{route('show.devolucion')}}"  class="@if(Request::is('devolucion')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                            <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                        Registro</a></li>
                                </ul>
                            </li>
                          
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M12 23q-2.8 0-5.15-1.275Q4.5 20.45 3 18.325V21H1v-6h6v2H4.525q1.2 1.8 3.163 2.9Q9.65 21 12 21q1.875 0 3.513-.712 1.637-.713 2.85-1.926 1.212-1.212 1.925-2.85Q21 13.875 21 12h2q0 2.275-.862 4.275-.863 2-2.363 3.5t-3.5 2.362Q14.275 23 12 23Zm-.9-4v-1.3q-1.175-.275-1.912-1.012Q8.45 15.95 8.1 14.75l1.65-.65q.3 1.025.938 1.537.637.513 1.462.513t1.412-.388q.588-.387.588-1.212 0-.725-.612-1.175-.613-.45-2.188-1.025-1.475-.525-2.162-1.25-.688-.725-.688-1.9 0-1.025.713-1.863.712-.837 1.937-1.087V5h1.75v1.25q.9.075 1.638.725.737.65 1.012 1.525l-1.6.65q-.2-.575-.65-.962-.45-.388-1.25-.388-.875 0-1.337.375-.463.375-.463 1.025 0 .65.575 1.025.575.375 2.075.875 1.8.65 2.4 1.525.6.875.6 1.925 0 .725-.25 1.275-.25.55-.662.937-.413.388-.963.625-.55.238-1.175.363V19ZM1 12q0-2.275.863-4.275.862-2 2.362-3.5t3.5-2.363Q9.725 1 12 1q2.8 0 5.15 1.275Q19.5 3.55 21 5.675V3h2v6h-6V7h2.475q-1.2-1.8-3.163-2.9Q14.35 3 12 3q-1.875 0-3.512.712-1.638.713-2.85 1.925-1.213 1.213-1.926 2.85Q3 10.125 3 12Z" /></svg>
                                <span class="nav_name" Style="padding-left:5%">Gastos </span>
                                  
                                </div>
                                <ul class="submenuItems">
                                  <li><a href="{{ route('gasto.index') }}" class="@if(Request::is('gasto')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                                <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                            Listado</a></li>
                                  <li><a href="{{route('show.gasto')}}"  class="@if(Request::is('gasto')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                            <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                        Registro</a></li>
                                </ul>
                            </li>
        
                            @if (App\Http\Permiso::traerRol(Auth::user()) == App\Http\Permiso::$roles[0])
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"> <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M12 23q-2.8 0-5.15-1.275Q4.5 20.45 3 18.325V21H1v-6h6v2H4.525q1.2 1.8 3.163 2.9Q9.65 21 12 21q1.875 0 3.513-.712 1.637-.713 2.85-1.926 1.212-1.212 1.925-2.85Q21 13.875 21 12h2q0 2.275-.862 4.275-.863 2-2.363 3.5t-3.5 2.362Q14.275 23 12 23Zm-.9-4v-1.3q-1.175-.275-1.912-1.012Q8.45 15.95 8.1 14.75l1.65-.65q.3 1.025.938 1.537.637.513 1.462.513t1.412-.388q.588-.387.588-1.212 0-.725-.612-1.175-.613-.45-2.188-1.025-1.475-.525-2.162-1.25-.688-.725-.688-1.9 0-1.025.713-1.863.712-.837 1.937-1.087V5h1.75v1.25q.9.075 1.638.725.737.65 1.012 1.525l-1.6.65q-.2-.575-.65-.962-.45-.388-1.25-.388-.875 0-1.337.375-.463.375-.463 1.025 0 .65.575 1.025.575.375 2.075.875 1.8.65 2.4 1.525.6.875.6 1.925 0 .725-.25 1.275-.25.55-.662.937-.413.388-.963.625-.55.238-1.175.363V19ZM1 12q0-2.275.863-4.275.862-2 2.362-3.5t3.5-2.363Q9.725 1 12 1q2.8 0 5.15 1.275Q19.5 3.55 21 5.675V3h2v6h-6V7h2.475q-1.2-1.8-3.163-2.9Q14.35 3 12 3q-1.875 0-3.512.712-1.638.713-2.85 1.925-1.213 1.213-1.926 2.85Q3 10.125 3 12Z" /></svg>
                                <span class="nav_name" Style="padding-left:5%">Usuario </span>
                                  
                                </div>
                                <ul class="submenuItems">
                                  <li><a href="{{ route('index.usuario')}}" class="@if(Request::is('usuario')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                                <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                            Listado</a></li>
                                  <li><a href="{{route('show.registroUsuarios')}}"   class="@if(Request::is('usuario')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                            <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                        Registro</a></li>
                                </ul>
                            </li>
        
                          
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M640 653q-51 0-84.5-33.5T522 535q0-51 33.5-84.5T640 417q51 0 84.5 33.5T758 535q0 51-33.5 84.5T640 653ZM400 896v-66q0-18.864 9-35.932T433 770q45-32 98.5-47.5T640 707q55 0 108 17t99 46q14 10 23.5 25.5T880 830v66H400Zm55-71v11h370v-11q-39-26-90-42t-95-16q-44 0-95.5 16T455 825Zm185-232q26 0 42-16t16-42q0-26-16-42t-42-16q-26 0-42 16t-16 42q0 26 16 42t42 16Zm0-58Zm0 301ZM120 646v-60h306v60H120Zm0-330v-60h473v60H120Zm349 165H120v-60h380q-11 13-18.727 27.921Q473.545 463.841 469 481Z" /></svg>
                                <span class="nav_name" Style="padding-left:5%">Planilla</span>
                                  
                                </div>
                                <ul class="submenuItems">
                                  <li><a href="{{ route('index.planilla') }}" class="@if(Request::is('planilla')) nav_link2 active @else nav_link2 @endif">
                                    <svg  style="fill: white"  xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path   d="M149.825 776Q137 776 128.5 767.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 606 128.5 597.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5Zm0-170Q137 436 128.5 427.325q-8.5-8.676-8.5-21.5 0-12.825 8.675-21.325 8.676-8.5 21.5-8.5 12.825 0 21.325 8.675 8.5 8.676 8.5 21.5 0 12.825-8.675 21.325-8.676 8.5-21.5 8.5ZM290 776v-60h550v60H290Zm0-170v-60h550v60H290Zm0-170v-60h550v60H290Z"/></svg>                                                <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                            Listado</a></li>
                                  <li><a href="{{route('show.registroPlanilla')}}"   class="@if(Request::is('planilla')) nav_link2 active @else nav_link2 @endif">
                                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M453 776h60V610h167v-60H513V376h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>                                            <path d="M764 976q-6 0-11-2t-10-7L501 725q-5-5-7-10t-2-11q0-6 2-11t7-10l85-85q5-5 10-7t11-2q6 0 11 2t10 7l242 242q5 5 7 10t2 11q0 6-2 11t-7 10l-85 85q-5 5-10 7t-11 2Zm0-72 43-43-200-200-43 43 200 200Zm-569 72q-6 0-11.5-2t-10.5-7l-84-84q-5-5-7-10.5T80 861q0-6 2-11t7-10l225-225h85l38-38-175-175h-57L80 277l99-99 125 125v57l175 175 130-130-67-67 56-56H485l-18-18 128-128 18 18v113l56-56 169 169q15 15 23.5 34.5T870 456q0 20-6.5 38.5T845 528l-85-85-56 56-52-52-211 211v84L216 967q-5 5-10 7t-11 2Zm0-72 200-200v-43h-43L152 861l43 43Zm0 0-43-43 22 21 21 22Zm569 0 43-43-43 43Z"/></svg>
                                        Registro</a></li>
                                </ul>
                            </li>
                            @endif
                            <li>
                                <div class="dropdownlink nav_link" Style="padding-left:8%"><svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                    <path d="M222 801q63-44 125-67.5T480 710q71 0 133.5 23.5T739 801q44-54 62.5-109T820 576q0-145-97.5-242.5T480 236q-145 0-242.5 97.5T140 576q0 61 19 116t63 109Zm257.814-195Q422 606 382.5 566.314q-39.5-39.686-39.5-97.5t39.686-97.314q39.686-39.5 97.5-39.5t97.314 39.686q39.5 39.686 39.5 97.5T577.314 566.5q-39.686 39.5-97.5 39.5Zm.654 370Q398 976 325 944.5q-73-31.5-127.5-86t-86-127.266Q80 658.468 80 575.734T111.5 420.5q31.5-72.5 86-127t127.266-86q72.766-31.5 155.5-31.5T635.5 207.5q72.5 31.5 127 86t86 127.032q31.5 72.532 31.5 155T848.5 731q-31.5 73-86 127.5t-127.032 86q-72.532 31.5-155 31.5ZM480 916q55 0 107.5-16T691 844q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480 916Zm0-370q34 0 55.5-21.5T557 469q0-34-21.5-55.5T480 392q-34 0-55.5 21.5T403 469q0 34 21.5 55.5T480 546Zm0-77Zm0 374Z"/></svg>
                                        <span class="nav_name" Style="padding-left:5%"> {{ Auth::user()->name }}</span>
                                  
                                </div>
                            </li>
        
                            <li>
                                <a href="#" onclick="logou()" class="nav_link" >
                                    <svg style="fill: white" Style="padding-left:8%" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                                                    <path d="M480 817 239 576l241-241 42 42-168 169h526v60H354l169 169-43 42Zm-400-1V336h60v480H80Z"/></svg>
                                        <span Style="padding-left:5%"class="nav_name">Salir</span>
                                    </a>
                                <form action="{{ route('logout') }}" method="POST" id="formulario_logout" hidden>
                                    @csrf
                                </form>
                            </li>
        
                            
                        </ul>
                     
                    </div>
                </div>
   
             

                </nav>

               

        <!--IMAGEN DE FONDO AZUL-->
        <!--Container Main start-->
        <!-- background-image: url('imagenes/compu.png') -->
        <div class="bo" style="padding-top: 1rem; background-image: url({{asset('imagenes/fondo2.jpg')}})">

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
    </body>
</section>

</html>
