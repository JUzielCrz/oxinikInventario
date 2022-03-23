<center>
    <div id="divmsg" style="display:none" class="alert" role="alert">
    </div>
</center>

<form id="idFormUser">
    @csrf

    <!-- nombre-->
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required>
            <span  id="nameError" class="text-danger"></span>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="">Correo:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" required>
            <span  id="emailError" class="text-danger"></span>
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
        <label for="">Rol:</label>
        <select name="roleid" id="roleid" class="form-control form-control-sm">
            <option value="">Selecciona</option>
            @foreach ($roles as $rols)
                <option value={{$rols}}>{{$rols}}</option>
            @endforeach
        </select>
        <span  id="roleidError" class="text-danger"></span>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="********">
            <span  id="passwordError" class="text-danger"></span>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="">Confirma Contraseña</label>
            <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="********">
            <span  id="passwordError" class="text-danger"></span>
        </div>
    </div>


</form>