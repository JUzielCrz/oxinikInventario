

@extends('layouts.sidebar')

@section('content-sidebar')

    <div class="container">
        <div class="card">
            <div class="card-header ">
                <div class="row ml-4">
                    <div class="col-md-6">
                        <h4>Clientes</h4>
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
                    <table id="table-data-cliente" class="table table-sm table-hover table-bordered">
                        <thead style="font-size:14px">
                            <tr>
                                <th>NOMBRE</th>
                                <th>TELEFONO</th>
                                <th>CORREO</th>
                                <th>RFC</th>
                                <th>DIRECCIÓN</th>
                                <th>REFERENCIA</th>
                                <th>OBSERVACIONES</th>
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
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @include('cliente.create')
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
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @include('cliente.edit')
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
<script src="{{ asset('js/cliente/index.js') }}"></script>



