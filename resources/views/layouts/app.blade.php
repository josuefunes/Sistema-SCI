<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Iniciar Sesion</a></li>
                            <!--<li><a href="{{ route('register') }}">Register</a></li>-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#" id="changePassword">Cambiar Contrase&ntilde;a</a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesi&oacute;n
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>


    <div class="modal fade" id="modal-password-home" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="passwordModalLabel">Cambiar Contrase&ntilde;a</h4>
                </div>
                <div class="modal-body">
                    <p>Cambio de contrase&ntilde;a para tu usuario</strong></p>
                    <form id="form-iniciopsk" class="form-horizontal" onkeypress="return event.keyCode != 13;">
                        <div class="form-group">
                            <label for="inicio-password" class="col-md-4 control-label">Nueva Contrase&ntilde;a</label>
                            <div class="col-md-6">
                                <input class="form-control" id="inicio-password" name="inicio-password" type="password" required>
                            </div>
                        </div>
                        <div class="form-group" style="text-align: center">
                            <span id="iniciopasswordspan" class="hidden alert-success">
                                <strong>Cambio realizado exitosamente</strong>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="btnpasswordinicio" type="button" class="btn btn-danger">Cambiar Contrase&ntilde;a</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">

        $("#form-iniciopsk").submit(function () {
           event.preventDefault();
        });

        $("#btnpasswordinicio").click(function () {

            event.preventDefault();

            parametros = {
                "password" : $("#inicio-password").val(),
                "_token" : $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: '/inicio/cambiarPassword',
                data: parametros,
                dataType: 'json',
                method: 'post',
                timeout: 5000,

                success: function(data)
                {
                    if(data.status=='OK')
                    {
                        $("#iniciopasswordspan").removeClass('hidden');
                        setTimeout(function() { $("#modal-password-home").modal('hide') }, 2000);
                        $("#inicio-password").val('');
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

        });

        $("#changePassword").click(function () {
            $("#modal-password-home").modal();
            $("#iniciopasswordspan").addClass('hidden');
        });
    </script>
</body>
</html>
