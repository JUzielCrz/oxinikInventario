@extends('layouts.sidebar')

@section('content-sidebar')

<ul class="nav nav-tabs justify-content-center mt-2">
    @include('almacen.submenu')
</ul> 
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-data-almacen" class="table table-sm table-hover table-bordered" style="font-size:14px">
                        <thead style="font-size:12px">
                            <tr>
                                <th>PRODUCTO</th>
                                <th>U.M.</th>
                                <th>CLAVE SAT</th>
                                <th>INICIAL</th>
                                <th>ENTRADAS</th>
                                <th>SALIDAS</th>
                                <th>STOCK</th>
                                <th>P.COMPRA</th>
                                <th>P.VENTA</th>
                                <th>P.MINIMO</th>
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
    <div class="modal fade" id="modal-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @include('almacen.edit')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="btn-update" type="button" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
        </div>
    </div>

    <!--Editar stock -->
    <div class="modal fade" id="modal-edit-stock" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar Stock</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @include('almacen.edit_stock')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="btn-update-stock" type="button" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
        </div>
    </div>

@endsection


@include('layouts.scripts')

<!--Scripts-->
<script src="{{ asset('js/almacen/nofiscal/index.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#id-menu-nofiscal").addClass('active');
    });
</script>

