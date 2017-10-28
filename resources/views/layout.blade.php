<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
        <header>
            <?php
            function activeMenu($url){
                return request()->is($url) ? 'active' : '';
            }
            ?>
            <nav>
                <a class="{{ activeMenu('/') }}" href="{{ route('home') }}"> Home </a>
                <a class="{{ activeMenu('saludos/*') }}" href="{{ route('saludo', 'Josu') }}"> Saludos </a>
                <a class="{{ activeMenu('messages/create') }}" href="{{ route('messages.create') }}"> Crear mensaje </a>
                @if (auth()->check())
                    <a class="{{ activeMenu('messages') }}" href="{{ route('messages.index') }}"> Mensajes </a>
                    <a class="{{ activeMenu('logout') }}" href="{{ route('logout') }}"> Cerrar sesión de {{ auth()->user()->name }} </a>
                @endif
                @if (auth()->guest())
                    <a class="{{ activeMenu('login') }}" href="{{ route('login') }}"> Login </a>
                @endif
            </nav>
        </header>
        <div class="content">
            @yield('contenido')
        </div>
    </body>
</html>
