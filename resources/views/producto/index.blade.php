@extends('layouts.sidebar')

@section('content-sidebar')

    <div class="container">
        <div class="card">
            <div class="card-header ">
                <div class="row ml-4">
                    <div class="col-md-6">
                        <h4>Productos</h4>
                    </div>
                    <div class="col-md-5 text-right">
                        <button type="button" class="btn btn-amarillo" data-toggle="modal" data-target="#modal-insertar">
                            <span class="fas fa-plus"></span>
                            Agregar
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-data-producto" class="table table-sm table-hover table-bordered" style="font-size:13px">
                        <thead style="font-size:13px">
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>CLAVE SAT</th>
                                <th>UNIDAD MEDIDA</th>
                                <th>P. COMPRA</th>
                                <th>P. VENTA</th>
                                <th>P. MINIMO</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Insertar fila-->
    <div class="modal fade" id="modal-insertar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @include('producto.create')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="btn-insertar" type="button" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Insertar fila-->
    <div class="modal fade" id="modal-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @include('producto.edit')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="btn-update" type="button" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
        </div>
    </div>

@endsection


@include('layouts.scripts')

<!--Scripts-->
<script src="{{ asset('js/producto/index.js') }}"></script>

