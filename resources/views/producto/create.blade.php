<form id="form-create">
    @csrf
    <div class="form-row">
        <div class="form-group col">
            <label for="">Producto</label>
            <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" placeholder="Nombre" required>
        </div>
        <div class="form-group col">
            <label for="">Clave SAT</label>
            <input type="text" name="clave_sat" id="clave_sat" class="form-control form-control-sm" placeholder="Clave" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col">
            <label for="">U.M.</label>
            <select name="unidad_medida" id="unidad_medida" class="form-control form-control-sm" required>
                <option value="">Selecciona</option>
                <option value="pza">pza</option>
                <option value="kg">kg</option>
                <option value="kit">kit</option>
                <option value="unidad">unidad</option>
            </select>
        </div>
        <div class="form-group col">
            <label for="">P.U.</label>
            <input type="number" name="precio_unitario" id="precio_unitario" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="">Stock Inicial</label>
            <input type="number" name="stock_inicial" id="stock_inicial" class="form-control form-control-sm numero-entero-positivo" placeholder="#" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col">
            <label for="">Descripción</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="2" class="form-control form-control-sm"></textarea>
        </div>    
    </div>

    

</form>
