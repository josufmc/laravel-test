@extends('layout')
@section('contenido')
    <h1> Crear mensaje </h1>
    <form method="post" action="{{ route('users.store') }}">
        <p><label for="nombre"> Nombre
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
            {!! $errors->first('nombre', '<span class=error>:message</span>') !!}
        </label></p>
        <p><label for="email"> Email
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            {!! $errors->first('email', '<span class=error>:message</span>') !!}
        </label></p>
        <p><label for="mensaje"> Mensaje
            <textarea class="form-control" name="mensaje">{{ old('mensaje') }}</textarea>
            {!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
        </label></p>
        {!! csrf_field() !!}
        <input type="submit" class="btn btn-primary" value="Enviar">
    </form>
@stop
