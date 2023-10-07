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
            <label for="">Unidad Base (Unidad menor)</label> <br>
            <div class="mb-3">
                <select name="unidad_medida_base" id="unidad_medida_base" class="form-control form-control-sm" required>
                        <option value="" disabled selected>Selecciona</option>
                        <option value="caja">caja</option>
                        <option value="carga">carga</option>
                        <option value="centimetro">centimetro</option>
                        <option value="cilindro">cilindro</option>
                        <option value="kg">kg</option>
                        <option value="kit">kit</option>
                        <option value="litro">litro</option>
                        <option value="m3">m3</option>
                        <option value="metro">metro</option>
                        <option value="paquete">paquete</option>
                        <option value="par">par</option>
                        <option value="pulgada">pulgada</option>
                        <option value="pza">pza</option>
                        <option value="rollo">rollo</option>
                        <option value="unidad">unidad</option>
                    </select>  
            </div>
        </div>
        <div class="form-group col">
            <label for="">Unidad conversión</label>
            <input type="number" name="unidad_conversion" id="unidad_conversion" class="form-control form-control-sm numero-decimal-positivo" placeholder="#" required>
        </div>
        <div class="form-group col">
            <label for="">Unidad Secundaria</label>
            <select name="unidad_medida_secundaria" id="unidad_medida_secundaria" class="form-control form-control-sm">
                <option value="" disabled selected>Selecciona</option>
                <option value="caja">caja</option>
                <option value="carga">carga</option>
                <option value="centimetro">centimetro</option>
                <option value="cilindro">cilindro</option>
                <option value="kg">kg</option>
                <option value="kit">kit</option>
                <option value="litro">litro</option>
                <option value="m3">m3</option>
                <option value="metro">metro</option>
                <option value="paquete">paquete</option>
                <option value="par">par</option>
                <option value="pulgada">pulgada</option>
                <option value="pza">pza</option>
                <option value="rollo">rollo</option>
                <option value="unidad">unidad</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="">Stock Inicial</label>
            <div class="mb-3">
                <div class="input-group input-group-sm is-invalid">
                  <input type="number" name="stock_inicial" id="stock_inicial" class="form-control form-control-sm numero-decimal-positivo" placeholder="#" required>
                  <div class="input-group-prepend">
                    <label id="label_um1" class="input-group-text" for="validatedInputGroupSelect">U.M.</label>
                  </div>
                </div>
            </div>
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

<script>
    $(document).on('change', '#unidad_medida_base', function(){  
        $("#label_um1").empty();
        $("#label_um1").text(unidad_medida_base.value);
        
    });  
</script>