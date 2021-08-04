    <input type="hidden" name="id_edit" id="id_edit">
    <div class="form-row">
        <div class="form-group col">
            <label for="">Producto</label>
            <input type="text" name="nombre_edit" id="nombre_edit" class="form-control form-control-sm" placeholder="Nombre" required>
        </div>
        <div class="form-group col">
            <label for="">Clave SAT</label>
            <input type="text" name="clave_sat_edit" id="clave_sat_edit" class="form-control form-control-sm" placeholder="Clave" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col">
            <label for="">U.M.</label>
            <select name="unidad_medida_edit" id="unidad_medida_edit" class="form-control form-control-sm" required>
                <option value="">Selecciona</option>
                <option value="pza">pza</option>
                <option value="kg">kg</option>
                <option value="kit">kit</option>
                <option value="unidad">unidad</option>
            </select>
        </div>
        <div class="form-group col">
            <label for="">P.U.</label>
            <input type="number" name="precio_unitario_edit" id="precio_unitario_edit" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col">
            <label for="">Descripción</label>
            <textarea name="descripcion_edit" id="descripcion_edit" cols="30" rows="2" class="form-control form-control-sm"></textarea>
        </div>    
    </div>

