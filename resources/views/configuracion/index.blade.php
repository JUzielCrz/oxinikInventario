@extends('layouts.sidebar')

@section('content-sidebar')
<div class="card">
    <div class="card-header ">
        <div class="row ml-4">
            <div class="col-md-6">
                <h4>Ajustes</h4>
            </div>
            
        </div>
    </div>
</div>

    <div class="container mt-3 ">
        
        <form action="{{route('configuracion.save')}}"  method="POST"  enctype="multipart/form-data">


        <div class="card">
            <div class="card-body ">
                    @csrf
        
                    <div class="row">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                      <label for="name" class="form-label">Nombre Empresa: </label>
                      <input type="text" class="form-control" id="name" name="name"  value="{{$config->name}}">
                    </div>

                    <div class="col-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                Mi Logo
                            </div>
                            <div class="card-body ">
                                <div class="col-12">         
      
                                    <input type="file" name="logo" id="logo"  class="form-control">
                                </div>
                                <div class="col-12">
                                    <div class="card bg-body-tertiary" style="min-height: 10rem" aria-placeholder="hola">
                                        <div class="card-body" style="max-width: 20%;">
                                            <img id="img-previous" src="/img/{{$config->logo}}" alt="" style="max-width: 100%">
                                            {{-- <img id="img-previous" src="/img/logo.svg" alt="" style="max-width: 100%"> --}}
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-row-reverse my-md-5">
                        <button type="submit" class="btn btn-amarillo me-5">Guardar Cambios</button>
                    </div>
                    
            </div>
        </div>
    </form>

    </div>


    
<script>
    $(document).ready(function(e){
        $("#logo").change(function(){
            let reader =new FileReader();
            reader.onload =(e) => {
                $("#img-previous").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        })

    });
  </script>


@endsection


@include('layouts.scripts')

<!--Scripts-->

