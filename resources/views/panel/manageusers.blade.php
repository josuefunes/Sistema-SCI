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

                    <div class="modal fade" id="modal-borrar">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close"
                                            data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
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

            $("a").click(function () {
                username = $(this).closest('tr').attr('id');
                if($(this).attr('type')=='editarUsuario')
                {
                    alert("Editando a " + username);
                }
                else if($(this).attr('type')=='cambioPassword')
                {
                    alert("Cambiando password a " + username);
                }
                else if($(this).attr('type')=='borrarUsuario')
                {
                    alert("Borrando a " + username)
                }
            });

        });

    </script>
@endsection