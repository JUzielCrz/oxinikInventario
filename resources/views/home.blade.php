@extends('layouts.sidebar')

@section('content-sidebar')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body bg-verde-oscuro border-dark text-white">
                    <div class="row">
                        <div class="col m-0 align-self-center text-center">
                            <i class="fas fa-shopping-cart fa-4x"></i>
                        </div>
                        <div class="col align-self-center"> 
                            <h4>Compras</h4>
                            <p class="text-white" style="font-size:12px" >Registra ingresos de productos</p>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/compra/index') }}">
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col text-right">
                                Ir a vista <i class="fas fa-angle-double-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
                
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body bg-verde-oscuro border-dark text-white">
                    <div class="row">
                        <div class="col m-0 align-self-center text-center">
                            <i class="fas fa-file-invoice-dollar fa-4x"></i>
                        </div>
                        <div class="col align-self-center"> 
                            <h4>Venta</h4>
                            <p class="text-white" style="font-size:12px" >Registra salidas de productos</p>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/venta/index') }}">
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col text-right">
                                Ir a vista <i class="fas fa-angle-double-right "></i>
                            </div>
                        </div>
                    </div>
                </a>
                
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body bg-verde-oscuro border-dark text-white">
                    <div class="row">
                        <div class="col m-0 align-self-center text-center">
                            <i class="fas fa-warehouse fa-4x"></i>
                        </div>
                        <div class="col align-self-center"> 
                            <h4>Almacen</h4>
                            <p class="text-white" style="font-size:12px" >Revisa tus entradas y salidas</p>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/almacen/general/index') }}">
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col text-right">
                                Ir a vista <i class="fas fa-angle-double-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
                
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body bg-verde-oscuro border-dark text-white">
                    <div class="row">
                        <div class="col m-0 align-self-center text-center">
                            <i class="fas fa-shopping-basket fa-4x"></i>
                        </div>
                        <div class="col align-self-center"> 
                            <h4>Productos</h4>
                            <p class="text-white" style="font-size:12px">Registro de productos</p>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/producto/index') }}">
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col text-right">    
                                Ir a vista <i class="fas fa-angle-double-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
                
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body bg-verde-oscuro border-dark text-white">
                    <div class="row">
                        <div class="col m-0 align-self-center text-center">
                            <i class="fas fa-user-tag fa-4x"></i></i>
                        </div>
                        <div class="col align-self-center"> 
                            <h4>Provedores</h4>
                            <p class="text-white" style="font-size:12px" >Registra los datos de tus provedores</p>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/provedor/index') }}">
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col text-right">
                                Ir a vista <i class="fas fa-angle-double-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
                
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body bg-verde-oscuro border-dark text-white">
                    <div class="row">
                        <div class="col m-0 align-self-center text-center">
                            <i class="fas fa-users fa-4x"></i>
                        </div>
                        <div class="col align-self-center"> 
                            <h4>Clientes</h4>
                            <p class="text-white" style="font-size:12px" >Resgistro de todos tus clientes</p>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/cliente/index') }}">
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col text-right">
                                Ir a vista <i class="fas fa-angle-double-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
                
            </div>
        </div>
    </div>
</div>





@endsection

@include('layouts.scripts')

