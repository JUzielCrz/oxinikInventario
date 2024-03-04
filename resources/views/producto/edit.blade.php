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
            <label for="">Unidad Base</label> <br>
            <input type="text" class="form-control"  name="unidad_medida_base_edit" id="unidad_medida_base_edit" disabled>
        </div> 
        <div class="form-group col">
            <label for="">Unidad conversión</label>
            <input type="number" name="unidad_conversion_edit" id="unidad_conversion_edit" class="form-control form-control-sm" placeholder="#" disabled>
        </div>
        <div class="form-group col">
            <label for="">Unidad Secundaria</label> <br>
            <input type="text" class="form-control"  name="unidad_medida_secundaria_edit" id="unidad_medida_secundaria_edit" disabled>
        </div> 
    </div>

    <div class="form-row">
        <div class="form-group col">
            <label for="">Precio Compra</label>
            <input type="number" name="precio_compra_edit" id="precio_compra_edit" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0" required>
        </div>
        <div class="form-group col">
            <label for="">Precio Venta</label>
            <input type="number" name="precio_venta_edit" id="precio_venta_edit" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-6">
            <label for="">Precio Minimo</label>
            <input type="number" name="precio_minimo_edit" id="precio_minimo_edit" class="form-control form-control-sm numero-decimal-positivo" placeholder="$0.0" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col">
            <label for="">Descripción</label>
            <textarea name="descripcion_edit" id="descripcion_edit" cols="30" rows="2" class="form-control form-control-sm"></textarea>
        </div>    
    </div>

