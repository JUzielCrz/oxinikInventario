<center>
    <div id="divmsg" style="display:none" class="alert" role="alert">
    </div>
  </center>
  
  
    <form id="idformRole">
      @csrf
  
      <!-- nombre-->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="">Nombre</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required>
          <span  id="nameError" class="text-danger"></span>
        </div>
  
        <div class="form-group col-md-6">
          <label for="">Slug</label>
          <input type="text" name="slug" id="slug" class="form-control" placeholder="Palabra Clave" required>
          <span  id="slugError" class="text-danger"></span>
        </div>
  
      </div>
  
      <div class="form-row">
        <div class="form-group col-md-12">
          <label for="">Descripción</label>
          <textarea name="description" id="description" cols="30" rows="2" class="form-control form-control-sm" placeholder="Descripción"></textarea>
          <span  id="descriptionError" class="text-danger"></span>
        </div>
      </div>
  
      <hr>
  
      <h3>Permisos</h3>
  
      @foreach ($permissions as $permission)
      <div class="ml-3">
          {{-- {!! Form::checkbox('permission[]', $permission->id, null)!!}  --}}
          <input type="checkbox" name="permission[]" id="" value={{$permission->id}} class="form-control form-control-sm">
          <span class="font-weight-bold">{{$permission->name}}: </span>
          {{$permission->description}}
          <br>
        </div>
      @endforeach
  
      {{-- {!! dd(old())!!} --}}
  
    </form>
  
  
  