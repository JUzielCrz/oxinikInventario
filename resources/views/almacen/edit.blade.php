<form id="form-edit-almacen">
    @csrf
    <input type="hidden" name="idAlmacen" id="idAlmacen">
    <input type="hidden" name="idProducto" id="idProducto">

    <div class="form-row">
        <div class="form-group col">
            <label for="">Observaciones</label>
            <textarea name="observaciones" id="observaciones" cols="30" rows="3" class="form-control form-control-sm"></textarea>
        </div>
    </div>


</form>
