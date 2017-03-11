@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="/inicio">Inicio</a> >> <a href="/panel">Panel</a> >> Agregar nuevo usuario</div>
                    <div style="text-align: center">
                        <h3>Agregar Nuevo Usuario</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('/panel/agregarUsuario') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username" class="col-md-4 control-label">Usuario</label>
                                <div class="col-md-6">
                                    <input id="username" name="username" type="text" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Nombre Completo</label>
                                <div class="col-md-6">
                                    <input id="name" name="name" type="text" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" name="password" type="password" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Correo Electr&oacute;nico</label>
                                <div class="col-md-6">
                                    <input id="email" name="email" type="email" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nivel" class="col-md-4 control-label">Nivel Administrativo</label>
                                <div class="col-md-6">
                                    <select id="nivel" name="nivel" required class="form-control">
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol->idRol }}">{{ $rol->nombreRol }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" id="rol" name="rol" value="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-success ">
                                        Crear Nuevo Usuario
                                    </button>
                                </div>
                            </div>
                        </form>
                        @if (Session::has('statusok'))
                            <div class="panel-success" style="text-align: center">
                                <span class="alert-success">
                                    <h4><strong>Usuario creado exitosamente</strong></h4>
                                </span>
                            </div>
                        @elseif (Session::has('statuserror'))
                            <div class="panel-danger" style="text-align: center">
                                <span class="alert-danger">
                                    <h4><strong>Error al crear usuario. Verificar log</strong></h4>
                                </span>
                            </div>
                        @elseif (Session::has('statusduplicado'))
                            <div class="panel-danger" style="text-align: center">
                                <span class="alert-danger">
                                    <h4><strong>Ya existe un usuario registrado con el mismo nombre de usuario o correo electr&oacute;nico</strong></h4>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            $("#nivel").on('change', function(){
               $("#rol").val($("#nivel").val());
            });
        });
    </script>
@endsection
