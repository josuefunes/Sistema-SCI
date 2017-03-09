@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard de Sistema</div>

                <div class="panel-body">
                    <table style="text-align: center; margin: 0 auto;">
                        <tbody>
                            <tr>
                                @if(Auth::user()->rol == 1 || Auth::user()->rol == 2)
                                <td style="padding: 10px;">
                                    <a href="/inventario"><img src="img/caja-logo.png" style="width: 100px; height: auto;"></a><br>
                                    <label class="control-label">Modulo de Inventario</label>
                                </td>
                                @endif
                                @if(Auth::user()->rol == 1 || Auth::user()->rol == 3)
                                <td style="padding: 10px;">
                                    <a href="/reportes"><img src="img/report-logo.png" style="width: 100px; height: auto;"></a><br>
                                    <label class="control-label">Reportes</label>
                                </td>
                                @endif
                                @if(Auth::user()->rol == 1)
                                <td style="padding: 10px;">
                                    <a href="/panel"><img src="img/admin-panel.png" style="width: 100px; height: auto;"></a><br>
                                    <label class="control-label">Panel de Administrador</label>
                                </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
