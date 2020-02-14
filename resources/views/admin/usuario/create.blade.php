@extends('layouts.admin')

@section('titulo','Administración | Crear usuario')
@section('titulo2','Usuarios')

@section('breadcrumbs')
@endsection

@section('contenido')
<a class="btn btn-primary btn-sm"
    style="margin-bottom: 10px;"
    href="{{route('usuarios.index')}}">
    <i class="fas fa-arrow-left"></i>
    Volver a lista de usuarios</a>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Éxito
                    </h5>
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('failure'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Error
                    </h5>
                    {{ Session::get('failure') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Crear usuario</h3>
                </div>
                <div class="card-body">
                    <form method="POST" 
                        action="{{route('usuarios.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" 
                                name="txtNombre" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Correo</label>
                            <input class="form-control" 
                                rows="1" name="txtCorreo"></input>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input class="form-control" id="password"
                                rows="1" name="txtContraseña"></input>
                        </div>
                        <div class="form-group">
                            <label>Confirmar Contraseña</label>
                            <input class="form-control" id="confirm_password"
                                rows="1" name="txtConfirmarContraseña"></input>
                        </div>
                        <div class="form-group">
                            <button type="submit" 
                                class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");
    function validatePassword(){
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Las contraseñas no coinciden.");
    } else {
        confirm_password.setCustomValidity('');
    }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
 </script>
@endsection

@section('estilos')
@endsection