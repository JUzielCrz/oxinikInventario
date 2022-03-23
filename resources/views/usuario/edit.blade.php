<center>
    <div id="divmsgedit" style="display:none" class="alert" role="alert">
    </div>
</center>

<form id="idFormUseredit">
    @csrf
        <label class="text-danger">Los campos marcados con asterisco son obligatorios </label>
        <hr>
        <input type="hidden" name="idedit" id="idedit">
        <!-- Nombre Completo-->
        <div class="form-row justify-content-center">
            <div class="form-group col-md-11">
                <label for="">Nombre</label>
                <input type="text" name="nameedit" id="nameedit" class="form-control" placeholder="..." required>
                <span  id="nameeditError" class="text-danger"></span>
            </div>
        </div>

        <!-- nacimiento, sexo, email-->
        <div class="form-row justify-content-center">
            <div class="form-group col-md-11">
                <label for="">Correo Electronico</label>
                <input type="email" name="emailedit" id="emailedit" class="form-control" placeholder="..." required>
                <span  id="emaileditError" class="text-danger"></span>
            </div>
        </div>

        <div class="form-row justify-content-center">
            <div class="form-group col-md-11">
                <label for="">Correo Electronico</label>
                <input type="email" name="emailedit" id="emailedit" class="form-control" placeholder="..." required>

                {{-- {!! Form::label('Rol*') !!}
                {{ Form::select('roleidedit', $roles , null,['id' => 'roleidedit','class'=>'form-control', 'required'])}} --}}
                <span  id="roleideditError" class="text-danger"></span>
            </div>
        </div>
        
</form>
