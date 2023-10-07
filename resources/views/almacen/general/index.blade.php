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
                            <th rowspan="2">PRODUCTO</th>
                            <th rowspan="2">CLAVE SAT</th>
                            <th colspan="2">INICIAL</th>
                            <th colspan="2">ENTRADAS</th>
                            <th colspan="2">SALIDAS</th>
                            <th colspan="2">STOCK</th>
                            <th rowspan="2">P.COMPRA</th>
                            <th rowspan="2">P.VENTA</th>
                            <th rowspan="2">P.MINIMO</th>
                        </tr>
                        <tr>
                            <th>Unidad Base</th>
                            <th>Unidad Sec</th>
                            <th>Unidad Base</th>
                            <th>Unidad Sec</th>
                            <th>Unidad Base</th>
                            <th>Unidad Sec</th>
                            <th>Unidad Base</th>
                            <th>Unidad Sec</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@include('layouts.scripts')
<script>
    $(document).ready(function () {
        $("#id-menu-general").addClass('active');
    });
</script>

<!--Scripts-->
<script src="{{ asset('js/almacen/general/index.js') }}"></script>