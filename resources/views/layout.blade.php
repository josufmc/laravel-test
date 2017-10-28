<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/app.css">
        <title>Laravel</title>
    </head>
    <body>
        <header>
            <?php
            function activeMenu($url){
                return request()->is($url) ? 'active' : '';
            }
            ?>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="nav navbar-nav">
                    <li class="nav-item {{ activeMenu('/') }}">
                        <a class="" href="{{ route('home') }}"> Home </a>
                    </li>
                    <li class="nav-item {{ activeMenu('saludos/*') }}">
                        <a class="" href="{{ route('saludo', 'Josu') }}"> Saludos </a>
                    </li>
                    <li class="nav-item {{ activeMenu('messages/create') }}">
                        <a class="" href="{{ route('messages.create') }}"> Crear mensaje </a>
                    </li>

                    @if (auth()->check())
                        <li class="nav-item {{ activeMenu('messages') }}">
                            <a class="" href="{{ route('messages.index') }}"> Mensajes </a>
                        </li>
                    @endif
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (auth()->check())
                        <li class="nav-item {{ activeMenu('logout') }}">
                            <a class="" href="{{ route('logout') }}"> Cerrar sesión de {{ auth()->user()->name }} </a>
                        </li>
                    @endif
                    @if (auth()->guest())
                        <li class="nav-item {{ activeMenu('login') }}">
                            <a class="" href="{{ route('login') }}"> Login </a>
                        </li>
                    @endif
                </ul>
            </div>
        </header>
        <div class="content">
            @yield('contenido')
        </div>
    </body>
</html>
