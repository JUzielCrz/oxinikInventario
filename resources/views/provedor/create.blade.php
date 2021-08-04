<form id="form-create">
    @csrf
    <div class="form-row">
        <div class="form-group col">
            <label for="">Provedor</label>
            <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" placeholder="Nombre" required>
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col">
            <label for="">Teléfono</label>
            <input type="number" name="telefono" id="telefono" class="form-control form-control-sm telefono numero-entero-positivo" placeholder="Teléfono" required>
        </div>
        <div class="form-group col">
            <label for="">Correo</label>
            <input type="email" name="correo" id="correo" class="form-control form-control-sm" placeholder="Correo" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col">
            <label for="">Dirección</label>
            <textarea name="direccion" id="direccion" cols="30" rows="2" class="form-control form-control-sm"></textarea>
        </div>    
    </div>
</form>
