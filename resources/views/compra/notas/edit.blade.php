@extends('layouts.sidebar')

@section('content-sidebar')
<div class="container">
   
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3>EDITAR NOTA:  {{$nota->id}}</h3>
                    <input type="hidden" id="nota_id" value="{{$nota->id}}">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <form id="form-compra">
                @csrf
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Provedor</label>
                        <input type="text" name="provedor" id="provedor" value="{{$proveedor}}" class="form-control form-control-sm" placeholder="Nombre" disabled >
                        <div id="listar-provedores"></div>
                    </div>
                    <div class="col form-group">
                        <label for="">Tipo Folio</label>
                        <select name="tipo_folio" id="tipo_folio" class="form-control form-control-sm" disabled>
                            <option value="" disabled>Seleccione</option>
                            <option value="Factura" {{$nota->tipo_folio == 'Factura' ? 'selected' : ''}}>Factura</option>
                            <option value="Remision" {{$nota->tipo_folio == 'Remision' ? 'selected' : ''}}>Remision</option>
                        </select>
                    </div>
                    <div class="col form-group">
                        <label for="">Folio</label>
                        <input type="text" name="folio" id="folio" value="{{$nota->folio}}" class="form-control form-control-sm" placeholder="Folio" disabled>
                    </div>
                    <div class="col form-group">
                        <label for="">Fecha</label>
                        <input type="date" name="fecha" id="fecha" value="{{$nota->fecha}}" class="form-control form-control-sm"  disabled>
                    </div>
                    
                    <div class="col form-group align-self-end">
                        <button class="btn btn-sm btn-amarillo mr-1" id='btn_edit_encabezado' type="button">Editar</button>
                        <button class="btn btn-sm btn-amarillo " id='btn_guardar_encabezado' type="button" disabled >Guardar</button>
                    </div>
                    
                </div>

            </form>
        </div>
        <div class="card-body">
            <form id="form-compra-producto">
                @csrf
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Producto</label> 
                        <input type="text" id="producto" name="producto" class="form-control form-control-sm" placeholder="Nombre">
                        <div id="listar-productos"></div>
                    </div>
                    <div class="col form-group">
                        <label for="">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control form-control-sm numero-decimal-positivo" placeholder="#">
                    </div>
                    <div class="col form-group">
                        <label for="">U.Medida</label>
                        <select  id="unidad_medida" name="unidad_medida" class="form-control form-control-sm" >
                            <option value="" disabled selected>Selecciona</option>
                        </select>
                    </div>
                    <div class="col form-group">
                        <label for="">Subtotal</label>
                        <input type="number" id="subtotal" name="subtotal" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0">
                    </div>
                    <div class="col form-group">
                        <label for="">IVA</label>
                        <input type="number"  id="iva" name="iva" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0">
                    </div>
                    <div class="col form-group">
                        <label for="">Total</label>
                        <input type="number"  id="total" name="total" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0">
                    </div>

                    <div class="col form-group">
                        <label for="">Facturado</label>
                        <select  id="facturado" name="facturado" class="form-control form-control-sm">
                            <option value="">selecciona</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                    </div>
                    <div class="col form-group align-self-end">
                        <button type="button" class="btn btn-amarillo" id="btn-anadir-producto">Agregar</button>
                    </div>
                    
                </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered" style="font-size:13px">
                    <thead>
                        <tr>
                            <th>PODUCTO</th>
                            <th>U. BASE</th>
                            <th>U. SECUNDARIA</th>
                            <th>SUBTOTAL</th>
                            <th>IVA</th>
                            <th>TOTAL</th>
                            <th>FACTURADO</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr class="tr-class-producto">
                            <td>{{$producto->nombre }}</td>
                            <td>{{$producto->cantidad}} {{$producto->unidad_medida_base}}</td>
                            <td>{{$producto->cantidad / $producto->unidad_conversion}} {{$producto->unidad_medida_secundaria}}</td>
                            <td>{{$producto->subtotal}}</td>
                            <td>{{$producto->iva}}</td>
                            <td>{{$producto->total}}</td>
                            <td>{{$producto->facturado}}</td>
                            <td><button type="button" class="btn btn-sm btn-amarillo" id="btn-delete-product" data-id="{{$producto->id}}"><i class="far fa-trash-alt"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tbody id="tbody-lista-productos"></tbody>
                </table>
            </div>
            <hr class="m-0">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                </div>
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

</form>
</div>          



@endsection
@include('layouts.scripts')

<!--Scripts-->
<script src="{{ asset('js/compra/edit.js') }}"></script>
