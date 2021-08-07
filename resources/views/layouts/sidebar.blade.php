@extends("layouts.head")
@section('contenido-body')


{{-- <img src="{{asset('/img/empresa/logo.svg')}}" width="120" class="d-inline-block align-top">--}}

<!--Container Main end-->

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <h3>OXINIK</h3>
                <strong>OX</strong>
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
                <li id="nav-ico-almacen" ><a href="{{ url('/almacen/index') }}"><i class="fas fa-warehouse"></i>Almacen</a></li>
                <li id="nav-ico-producto" ><a href="{{ url('/producto/index') }}"><i class="fas fa-shopping-basket"></i>Productos</a></li>
                <li id="nav-ico-provedor" ><a href="{{ url('/provedor/index') }}"><i class="fas fa-user-tag"></i></i>Provedores</a></li>
                <li id="nav-ico-cliente" ><a href="{{ url('/cliente/index') }}"><i class="fas fa-users"></i>Clientes</a></li>

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

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>   
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item dropdown dropleft">
                                <button class="btn btn-outline-secondary dropdown-toggle nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    Nombre Usuario
                                </button>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Mi perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" 
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form1').submit();">Cerar Sesion</a>
                                    <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>


                            {{-- <li class="nav-item active">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </nav>


            @yield('content-sidebar')

            </div>
    </div>

@endsection


