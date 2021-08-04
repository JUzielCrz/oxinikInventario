@extends('layouts.sidebar')

@section('content-nvar')
    
@endsection



@section('content-sidebar')
<div class="container">
<form id="form-compra">
    @csrf
    
    <div class="row ml-4">
        <h4>+ COMPRA</h4>
    </div>
    
    <hr>

    <div class="row">
        <div class="col form-group">
            <label for="">Folio Factura</label>
            <input type="text" name="folio_factura" id="folio_factura" class="form-control form-control-sm" placeholder="Folio">
        </div>
        <div class="col form-group">
            <label for="">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control form-control-sm" >
        </div>
        <div class="col form-group">
            <label for="">Provedor</label>
            <input type="text" name="provedor" id="provedor" class="form-control form-control-sm" placeholder="Nombre">
        </div>
        <div class="col form-group">
            <label for="">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control form-control-sm numero-entero-positivo" placeholder="#">
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 form-group">
            <label for="">Producto</label>
            <input type="text" name="producto" id="producto" class="form-control form-control-sm" placeholder="Nombre Producto">
        </div>
        <div class="col form-group">
            <label for="">Subtotal</label>
            <input type="number" name="subtotal" id="subtotal" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0">
        </div>
        <div class="col form-group">
            <label for="">IVA</label>
            <input type="number" name="iva" id="iva" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0">
        </div>
        <div class="col form-group">
            <label for="">Total</label>
            <input type="number" name="total" id="total" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0">
        </div>
        <div class="col form-group align-self-end">
            <button type="button" class="btn btn-success" id="btn-anadir-producto">Agregar</button>
        </div>
    </div>

    <hr>

    <div class="card">
        <div class="card-header">
            <label for="">Lista de Productos</label>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Factura</th>
                            <th>Fecha</th>
                            <th>provedor</th>
                            <th>cantidad</th>
                            <th>producto</th>
                            <th>subtotal</th>
                            <th>iva</th>
                            <th>total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-lista-productos">
                        
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="row">
                <div class="col form-group text-right">
                    <button type="button" class="btn btn-success" id="btn-save-compra">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>          



@endsection
@include('layouts.scripts')

<!--Scripts-->
<script src="{{ asset('js/compra/index.js') }}"></script>
