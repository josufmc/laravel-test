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
                        <a class="nav-link" href="{{ route('home') }}"> Home </a>
                    </li>
                    <li class="nav-item {{ activeMenu('saludos/*') }}">
                        <a class="nav-link" href="{{ route('saludo', 'Josu') }}"> Saludos </a>
                    </li>
                    <li class="nav-item {{ activeMenu('messages/create') }}">
                        <a class="nav-link" href="{{ route('messages.create') }}"> Crear mensaje </a>
                    </li>

                    @if (auth()->check())
                        <li class="nav-item {{ activeMenu('messages') }}">
                            <a class="nav-link" href="{{ route('messages.index') }}"> Mensajes </a>
                        </li>
                    @endif
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (auth()->check())
                        <li class="nav-item {{ activeMenu('logout') }}">
                            <a class="nav-link" href="{{ route('logout') }}"> Cerrar sesión de {{ auth()->user()->name }} </a>
                        </li>
                    @endif
                    @if (auth()->guest())
                        <li class="nav-item {{ activeMenu('login') }}">
                            <a class="nav-link" href="{{ route('login') }}"> Login </a>
                        </li>
                    @endif
                    {{--  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Action</a>
                        </div>
                    </li>  --}}
                </ul>
            </div>
        </header>
        <div class="container">
            @yield('contenido')
        </div>
    </body>
</html>
