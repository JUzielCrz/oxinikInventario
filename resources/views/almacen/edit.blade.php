<form id="form-edit-almacen">
    @csrf
    <input type="hidden" name="idAlmacen" id="idAlmacen">
    <input type="hidden" name="idProducto" id="idProducto">
    {{-- <fieldset disabled>
        <div class="form-row">
            <div class="form-group col">
                <label for="">Producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" placeholder="Nombre">
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="">U.M.</label>
                    <input type="text" name="unidad_medida" id="unidad_medida" class="form-control form-control-sm" placeholder="U.M.">
                </div>
                <div class="form-group col">
                    <label for="">Clave SAT</label>
                    <input type="text" name="clave_sat" id="clave_sat" class="form-control form-control-sm" placeholder="Clave">
                </div>
            </div>
        </div>
    </fieldset>

    <div class="form-row">
        <div class="form-group col">
            <label for="">Inicial</label>
            <input type="number" name="inicial" id="inicial" class="form-control form-control-sm" disabled>
        </div>
        <div class="form-group col">
            <label for="">Entradas</label>
            <input type="number" name="entradas" id="entradas" class="form-control form-control-sm" disabled >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col">
            <label for="">Salidas</label>
            <input type="number" name="salidas" id="salidas" class="form-control form-control-sm" disabled>
        </div>
        <div class="form-group col">
            <label for="">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control form-control-sm" disabled >
        </div>
    </div> --}}
    <div class="form-row">
        <div class="form-group col">
            <label for="">Observaciones</label>
            <textarea name="observaciones" id="observaciones" cols="30" rows="3" class="form-control form-control-sm"></textarea>
        </div>
    </div>


</form>
