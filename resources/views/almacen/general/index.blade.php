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