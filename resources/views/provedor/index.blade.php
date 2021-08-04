@extends('layouts.sidebar')

@section('content-sidebar')

    <div class="container">
        <div class="row ml-4">
            <div class="col-md-6">
                <h4>Provedores</h4>
            </div>
            <div class="col-md-5 text-right">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-insertar">
                    <span class="fas fa-plus"></span>
                    Agregar
                </button>
            </div>
        </div>
        <hr>

        <div class="table-responsive">
            <table id="table-data-provedor" class="table table-sm table-hover table-bordered">
                <thead style="font-size:14px">
                    <tr>
                        <th>NOMBRE</th>
                        <th>DIRECCIÓN</th>
                        <th>TELEFONO</th>
                        <th>CORREO</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
    </div>



    <!-- Modal Insertar fila-->
    <div class="modal fade" id="modal-insertar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Provedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @include('provedor.create')
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
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Provedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @include('provedor.edit')
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
<script src="{{ asset('js/provedor/index.js') }}"></script>

