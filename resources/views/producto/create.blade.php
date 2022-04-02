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
                <option value="m3">m3</option>
                <option value="pza">pza</option>
                <option value="kg">kg</option>
                <option value="litros">litros</option>
                <option value="kit">kit</option>
                <option value="unidad">unidad</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="">Stock Inicial</label>
            <input type="number" name="stock_inicial" id="stock_inicial" class="form-control form-control-sm numero-entero-positivo" placeholder="#" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col">
            <label for="">Precio Compra</label>
            <input type="number" name="precio_compra" id="precio_compra" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0" required>
        </div>
        <div class="form-group col">
            <label for="">Precio Venta</label>
            <input type="number" name="precio_venta" id="precio_venta" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-6">
            <label for="">Precio Minimo</label>
            <input type="number" name="precio_minimo" id="precio_minimo" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col">
            <label for="">Descripción</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="2" class="form-control form-control-sm"></textarea>
        </div>    
    </div>

    

</form>
