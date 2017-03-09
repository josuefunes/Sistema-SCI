@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="/inicio">Inicio</a> >> <a href="/panel">Panel</a> >> Administrar Usuarios</div>

                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Nombre de Usuario</th>
                                <th>Cambiar Contrase&ntilde;a</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                            <div class="container">
                            @foreach($users as $user)
                                <tr id="{{ $user->username }}">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td style="text-align: center"><a href="#" type="cambioPassword"><img style="width: 30px; height: auto" src="../img/password.png"></a></td>
                                    <td style="text-align: center"><a href="#" type="editarUsuario"><img style="width: 30px; height: auto" src="../img/edit-user.png"></a></td>
                                    <td style="text-align: center"><a href="#" type="borrarUsuario"><img style="width: 30px; height: auto" src="../img/eliminar-usuario.png"></a></td>
                                </tr>
                            @endforeach
                            </div>
                        </table>
                        {{ $users->links() }}
                    </div>

                    <div class="modal fade" id="modal-borrar" tabindex="-1" role="dialog" aria-labelledby="borrarModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close"
                                            data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="borrarModalLabel">Borrar Usuario</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <p>Desea borrar al usuario : <strong><label id="labelusuario">?</label></strong></p>
                                    </div>
                                    <div class="form-group" style="text-align: center">
                                        <span id="borrarspan" class="hidden alert-success">
                                        <strong>Usuario borrado exitosamente</strong>
                                    </span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button id="btnborrar" type="button" class="btn btn-danger">Borrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close"
                                            data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="editarModalLabel">Editar Usuario</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Editando usuario : <strong><label id="nombreusuario">?</label></strong></p>
                                    <form id="form-editarUsuario" class="form-horizontal" action="POST">
                                        <div class="form-group">
                                            <label for="usuario" class="col-md-4 control-label">Usuario</label>
                                            <div class="col-md-6">
                                                <input class="form-control" id="usuario" name="usuario" type="text" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-md-4 control-label">Nombre Completo</label>
                                            <div class="col-md-6">
                                                <input class="form-control" id="name" name="name" type="text" required value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-md-4 control-label">Correo electr&oacute;nico</label>
                                            <div class="col-md-6">
                                                <input class="form-control" id="email" name="email" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-md-4 control-label">Cambiar Rol</label>
                                            <div class="col-md-6">
                                                <select id="rol" class="form-control" name="rol">
                                                    @foreach($roles as $rol)
                                                        <option value="{{ $rol->idRol }}">{{ $rol->nombreRol }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button id="btneditar" type="button" class="btn btn-danger">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close"
                                            data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="passwordModalLabel">Cambiar Password</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Cambiando contrase&ntilde;a a usuario : <strong><label id="labelpassword">?</label></strong></p>
                                    <form id="form-cambiarpsk" class="form-horizontal" action="POST">
                                        <div class="form-group">
                                            <label for="password" class="col-md-4 control-label">Nueva Contrase&ntilde;a</label>
                                            <div class="col-md-6">
                                                <input class="form-control" id="password" name="password" type="password" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="text-align: center">
                                            <span id="passwordspan" class="hidden alert-success">
                                                <strong>Cambio realizado exitosamente</strong>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button id="btnpassword" type="button" class="btn btn-danger">Cambiar Contrase&ntilde;a</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            $("#btnpassword").click(function () {
                cambiarPassword($("#labelpassword").html());
            });

            $("#btnborrar").click(function () {
                borrarUsuario($("#labelusuario").html());
            });

            $("a").click(function () {
                username = $(this).closest('tr').attr('id');
                if($(this).attr('type')=='editarUsuario')
                {
                    getUserData(username);
                    $("#nombreusuario").html(username);
                    $("#usuario").val(username);
                    $("#modal-editar").modal();
                }
                else if($(this).attr('type')=='cambioPassword')
                {
                    $("#labelpassword").html(username);
                    $("#modal-password").modal();
                }
                else if($(this).attr('type')=='borrarUsuario')
                {
                    $("#labelusuario").html(username);
                    $("#modal-borrar").modal();
                }
            });

            function getUserData(username) {

                parametros = {
                    "username" : username,
                    "_token" : $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: '/panel/administrarUsuarios/getUserData',
                    data: parametros,
                    dataType: 'json',
                    method: 'post',
                    timeout: 5000,

                    success: function(data)
                    {
                        $("#name").val(data.name);
                        $("#email").val(data.email);
                        $("#rol").selectedIndex = data.rol;
                    },
                    error: function(x,t,m)
                    {
                        if(t=="timeout")
                        {
                            alert("Ocurrio un timeout en funcion Ajax");
                        }
                    }

                });
            }

            function cambiarPassword(username)
            {
                $("#btnpassword").attr('disabled', 'disable');

                parametros = {
                    "username" : username,
                    "password" : $("#password").val(),
                    "_token" : $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: '/panel/administrarUsuarios/cambiarPassword',
                    data: parametros,
                    dataType: 'json',
                    method: 'post',
                    timeout: 5000,

                    success: function(data)
                    {
                        if(data.status=='OK')
                        {
                            $("#passwordspan").removeClass('hidden');
                            setTimeout(function() { $("#modal-password").modal('hide') }, 3000);
                            setTimeout(function() { window.location.reload(true) } ,3500);
                        }
                        else
                        {
                            alert('Ocurrio un error al intentar cambiar el password');
                        }
                    },

                    error: function (x,t,m) {
                        if(t=="timeout")
                        {
                            alert("Ocurrio un timeout en funcion Ajax");
                        }
                    }
                });
            }

            function borrarUsuario(username)
            {

                $("#btnborrar").attr('disabled', 'disable');

                parametros = {
                    "username" : username,
                    "_token" : $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: '/panel/administrarUsuarios/borrarUsuario',
                    data: parametros,
                    dataType: 'json',
                    method: 'post',
                    timeout: 5000,

                    success: function(data)
                    {
                        if(data.status=='OK')
                        {
                            $("#borrarspan").removeClass('hidden');
                            setTimeout(function() { $("#modal-borrar").modal('hide') }, 3000);
                            setTimeout(function() { window.location.reload(true) } ,3500);
                        }
                        else
                        {
                            alert('Ocurrio un error al intentar borrar el usuario');
                        }
                    },

                    error: function (x,t,m) {
                        if(t=="timeout")
                        {
                            alert("Ocurrio un timeout en funcion Ajax");
                        }
                    }
                });


            }

        });

    </script>
@endsection