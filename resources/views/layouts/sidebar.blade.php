@extends("layouts.head")
@section('contenido-body')


{{-- <img src="{{asset('/img/empresa/logo.svg')}}" width="120" class="d-inline-block align-top">--}}

<!--Container Main end-->

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="active">
            <div>
                <img id="miLogo" class="img-fluid ">
            </div>

            <ul class="list-unstyled components">
                {{-- <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="#">Home 1</a></li>
                        <li><a href="#">Home 2</a></li>
                        <li><a href="#">Home 3</a></li>
                    </ul>
                </li> --}}
                <li id="nav-ico-compra" ><a href="{{ url('/compra/index') }}"><i class="fas fa-shopping-cart"></i>Compras</a></li>
                <li id="nav-ico-venta" ><a href="{{ url('/venta/index') }}"><i class="fas fa-file-invoice-dollar"></i>Venta</a></li>
                <li id="nav-ico-almacen" ><a href="{{ url('/almacen/general/index') }}"><i class="fas fa-warehouse"></i>Almacen</a></li>
                <li id="nav-ico-producto" ><a href="{{ url('/producto/index') }}"><i class="fas fa-shopping-basket"></i>Productos</a></li>
                <li id="nav-ico-provedor" ><a href="{{ url('/provedor/index') }}"><i class="fas fa-user-tag"></i></i>Provedores</a></li>
                <li id="nav-ico-cliente" ><a href="{{ url('/cliente/index') }}"><i class="fas fa-users"></i>Clientes</a></li>
                <li id="nav-ico-usuario" ><a href="{{ url('/user/index') }}"><i class="fas fa-users-cog"></i>Usuarios</a></li>
                <li id="nav-ico-usuario" ><a href="{{ url('/configuracion/index') }}"><i class="fas fa-cogs"></i>Config</a></li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-sm pt-1 pb-1 mb-3">
                {{-- BOTON PARA MENU LATERAL (SIDEBAR) --}}
                <button type="button" id="sidebarCollapse" class="btn btn-amarillo " >
                    <i class="fas fa-align-left"></i>   
                </button>
                <button class="btn btn-sm btn-amarillo ml-2" onclick="return window.history.back();"><span class="fas fa-arrow-circle-left"></span></button>
                <span class="ml-2" id="name_empresa"></span>
                {{-- MENU del NVAR--}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>     
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav" id="menu-navbar">
                        @yield('menu-navbar')
                    </ul>
                </div>

                {{-- CERRAR SESION --}}
                <span class=" mr-2"> <i class="fas fa-user"></i> {{auth()->user()->name}} </span>
                <div class="btn-group">
                    <a type="button" class="btn btn-amarillo" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="font-size: 13px">
                        <a  href="{{ route('logout') }}" class="dropdown-item" type="button" onclick="event.preventDefault(); document.getElementById('logout-form1').submit();" class="article">
                            <i class="fas fa-sign-out-alt"></i> Cerar Sesión
                        </a>
                        <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                
            </nav>

            @yield('content-sidebar')

        </div>
    </div>

@endsection

<script>
    $.ajax({
        method: "get",
        url: "/configuracion/getconfig"
    }).done(function (msg) {
        // Obtén el elemento de la imagen por su ID
        var miLogo = document.getElementById('miLogo');
        var name_empresa = document.getElementById('name_empresa');
        console.log(msg.logo)
        // Cambia la imagen reemplazando el atributo src
        miLogo.src = "{{ asset('img') }}" +"/"+msg.logo;
        name_empresa.textContent = msg.name;

    })
</script>
