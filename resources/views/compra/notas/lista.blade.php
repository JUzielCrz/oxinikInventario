@extends('layouts.sidebar')

@section('content-sidebar')

    <div class="container">
        <div class="card">
            <div class="card-header">
                Notas Compra
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-notas" class="table table-sm">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Provedor</th>
                                <th>Folio</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@include('layouts.scripts')


<!--Scripts-->
<script src="{{ asset('js/compra/nota.js') }}"></script>