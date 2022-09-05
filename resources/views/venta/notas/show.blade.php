@extends('layouts.sidebar')

@section('content-sidebar')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>VENTA</h5>
                <span>
                    Nota ID: {{$nota->id}}
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="">Cliente</label>
                        <input type="text" class="form-control form-control-sm" value="{{$nota->cliente}}" disabled>
                    </div>
                    <div class="col">
                        <label for="">Tipo Folio</label>
                        <input type="text" class="form-control form-control-sm" value="{{$nota->tipo_folio}}" disabled>
                    </div>
                    <div class="col">
                        <label for="">Folio</label>
                        <input type="text" class="form-control form-control-sm" value="{{$nota->folio}}" disabled>
                    </div>
                    <div class="col">
                        <label for="">Fecha</label>
                        <input type="text" class="form-control form-control-sm" value="{{$nota->fecha}}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" style="font-size:13px">
                        <thead >
                            <tr>
                                <th>id</th>
                                <th>PODUCTO</th>
                                <th>CANTIDAD</th>
                                <th>SUBTOTAL</th>
                                <th>IVA</th>
                                <th>TOTAL</th>
                                <th>FACTURADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{$producto->id}}</td>
                                    <td>{{$producto->producto_id }}</td>
                                    <td>{{$producto->cantidad}}</td>
                                    <td>{{$producto->subtotal}}</td>
                                    <td>{{$producto->iva}}</td>
                                    <td>{{$producto->total}}</td>
                                    <td>{{$producto->facturado}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="row">
                    <div class="col text-right">
                        <h5 >Total: $ {{$nota->total_general}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Observaciones</label>
                        <textarea name="" id="" cols="30" rows="3" class="form-control form-control-sm" disabled>{{$nota->observaciones}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@include('layouts.scripts')
