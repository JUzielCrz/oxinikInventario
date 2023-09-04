<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head lang="es">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!--bootstrapp -->
        <link href="{{asset('bootstrap4/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/misestilos.css')}}" rel="stylesheet">
        
        {{-- archivos para datatables --}}
        <link href="{{asset('datatables/datatables.min.css')}}" rel="stylesheet"> 

        <!-- icon -->
        <link href="{{asset('img/icoawesome/css/all.min.css')}}" rel="stylesheet"> 
        
        <!--Para Ajax-->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
        
        
    </head>
    <style>
        html, body {
            background-color: #fff;
            color: #464646;
        }
    </style>

    <body>
        <!-- Image and text -->
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand ml-4" href="#">
            @php
                $url="img/".$config->logo;
            @endphp
                <img src={{$url}} style="width: 100px" class="img-fluid" alt="">
            </a>
            <a class="navbar-brand" href="{{ route('login') }}" style="font-size: 16px">
                <i class="fas fa-sign-in-alt"></i>
                Login
            </a>
        </nav>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header ">
                    <div class="row ml-4">
                        <div class="col">
                            <h4>ALMACÉN</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-data-almacen" class="table table-sm table-hover table-bordered" style="font-size:14px">
                            <thead style="font-size:12px">
                                <tr>
                                    <th>PRODUCTO</th>
                                    <th>U.M.</th>
                                    <th>CLAVE SAT</th>
                                    <th>STOCK</th>
                                    <th>P.VENTA</th>
                                    <th>P.MINIMO</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

        <script src="{{ asset('/jquery/jquery-3.5.1.min.js') }}"></script> 
        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="{{ asset('/bootstrap4/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/welcome/index.js') }}"></script>
    </body>


    
    
    </html>

    