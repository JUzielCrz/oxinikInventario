@extends('layouts.sidebar')

@section('content-sidebar')

<div class="card">
    <div class="card-header"> Historial </div>
    <div class="card-body">
        <span>Producto: Nombre del producto</span>
        <div class="table-responsive">
            <table id="table-data-producto" class="table table-sm table-hover table-bordered" style="font-size:13px">
                <thead style="font-size:13px">
                    <tr>
                        <th>FECHA</th>
                        <th>ID PRODUCTO</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCIÓN</th>
                        <th>CLAVE SAT</th>
                        <th>UNIDAD MEDIDA</th>
                        <th>P. COMPRA</th>
                        <th>P. VENTA</th>
                        <th>P. MINIMO</th>
                        <th>EVENTO</th>
                        <th>USUARIO</th>
                    </tr>
                </thead>
                <body>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->current_date}}</td>
                            <td>{{$product->product_id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->key_sat}}</td>
                            <td>{{$product->unit_measurement}}</td>
                            <td>{{$product->price_buy}}</td>
                            <td>{{$product->price_sale}}</td>
                            <td>{{$product->price_minimum}}</td>
                            <td>{{$product->event}}</td>
                            <td>{{$product->user_name}}</td>
                        </tr>
                    @endforeach
                </body>
            </table>
        </div>
    </div>
</div>

@endsection
@include('layouts.scripts')