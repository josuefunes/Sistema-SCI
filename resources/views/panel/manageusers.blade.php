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
                                    <p>Desea borrar al usuario : <strong><label id="labelusuario">?</label></strong></p>
                                    <br>
                                    <span id="borrarspan" class="hidden alert-success">
                                        <h4><strong>Usuario borrado exitosamente</strong> </h4>
                                    </span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button id="btnborrar" type="button" class="btn btn-danger">Borrar</button>
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
                                            <label for="password" class="col-md-4 control-label">Nuve Contrase&ntilde;a</label>
                                            <div class="col-md-6">
                                                <input class="form-control" id="password" name="password" type="password" required>
                                            </div>
                                            <span id="passwordspan" class="hidden alert-success">
                                                <h4><strong>Cambio realizado exitosamente</strong> </h4>
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

            function cambiarPassword(username)
            {
                $("#btnpassword").attr('disabled', 'disable');

                parametros = {
                    "username" : username,
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