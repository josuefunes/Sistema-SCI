@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="javascript:window.history.back()">Ir a p&aacute;gina anterior</a> </div>

                    <div class="panel-body">
                        <span class="alert-danger" style="text-align: center;">
                            <h3><strong>Usted no tiene privilegios para acceder a esta p&aacute;gina. Redireccionando a la p&aacute;gina anterior en 5 segundos.</strong></h3>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">

       $(document).ready(function () {

           setTimeout(function(){ window.history.back() }, 5000);

       });

    </script>
@endsection
