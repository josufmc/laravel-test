@extends('layout')
@section('contenido')
    <h1> Crear mensaje </h1>
    <form method="post" action="{{ route('messages.store') }}">
        <p><label for="nombre"> Nombre
            <input type="text" name="nombre" value="{{ old('nombre') }}">
            {!! $errors->first('nombre', '<span class=error>:message</span>') !!}
        </label></p>
        <p><label for="email"> Email
            <input type="email" name="email" value="{{ old('email') }}">
            {!! $errors->first('email', '<span class=error>:message</span>') !!}
        </label></p>
        <p><label for="mensaje"> Mensaje
            <textarea name="mensaje">{{ old('mensaje') }}</textarea>
            {!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
        </label></p>
        {!! csrf_field() !!}
        <input type="submit" value="Enviar">
    </form>
@stop
