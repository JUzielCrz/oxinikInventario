@extends('layouts.sidebar')



@section('content-sidebar')
<div class="container">
<form id="form-venta">
    @csrf
    
    <div class="card">
        <div class="card-header bg-verde-oscuro">
            <h5>VENTA</h5>
            
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-verde-oscuro">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="">Cliente</label>
                    <input type="text" name="cliente" id="cliente" class="form-control form-control-sm" placeholder="Nombre">
                    <div id="listar-clientes"></div>
                </div>
                <div class="col-md-2 form-group">
                    <label for="">Folio Factura</label>
                    <input type="text" name="folio_factura" id="folio_factura" class="form-control form-control-sm" placeholder="Folio">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control form-control-sm" >
                </div>
                
                
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="">Producto</label>
                    <input type="text" name="producto" id="producto" class="form-control form-control-sm" placeholder="Nombre">
                    <div id="listar-productos"></div>
                </div>
                <div class="col form-group">
                    <label for="">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control form-control-sm numero-entero-positivo" placeholder="#">
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
                    <button type="button" class="btn btn-verde-oscuro" id="btn-anadir-producto">Agregar</button>
                </div>
                
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered">
                    <thead class="bg-verde-intermedio">
                        <tr>
                            <th>PODUCTO</th>
                            <th>CANTIDAD</th>
                            <th>SUBTOTAL</th>
                            <th>IVA</th>
                            <th>TOTAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-lista-productos">
                        
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="row">
                <div class="col text-right mr-3">
                    <h5 id="h5-total-general">Total: $ 0.0</h5>
                    <input type="hidden" name="total_general" id="total_general" value=0>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col form-group text-right">
                    <button type="button" class="btn btn-success" id="btn-save-venta">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>          



@endsection
@include('layouts.scripts')

<!--Scripts-->
<script src="{{ asset('js/venta/index.js') }}"></script>
