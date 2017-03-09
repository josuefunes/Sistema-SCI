@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="/inicio">Inicio</a> >> Panel de Control</div>

                    <div class="panel-body">
                        <table style="text-align: center; margin: 0 auto;">
                            <tbody>
                            <tr>
                                <td style="padding: 10px;">
                                    <a href="/panel/agregarUsuario"><img src="img/add-user.png" style="width: 100px; height: auto;"></a><br>
                                    <label class="control-label">Agregar Usuario</label>
                                </td>
                                <td style="padding: 10px;">
                                    <a href="/panel/administrarUsuarios"><img src="img/manage-users.png" style="width: 100px; height: auto;"></a><br>
                                    <label class="control-label">Administrar Usuarios</label>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
