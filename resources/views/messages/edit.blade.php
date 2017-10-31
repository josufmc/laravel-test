@extends('layout')
@section('contenido')
    <h1> Editar mensaje </h1>
    <form method="post" action="{{ route('messages.update', $message->id) }}">
        <p><label for="nombre"> Nombre
            <input type="text" name="nombre" class="form-control" value="{{ $message->nombre }}">
            {!! $errors->first('nombre', '<span class=error>:message</span>') !!}
        </label></p>
        <p><label for="email"> Email
            <input type="email" name="email" class="form-control" value="{{ $message->email }}">
            {!! $errors->first('email', '<span class=error>:message</span>') !!}
        </label></p>
        <p><label for="mensaje"> Mensaje
            <textarea class="form-control" name="mensaje">{{ $message->mensaje }}</textarea>
            {!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
        </label></p>
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <input type="submit" class="btn btn-primary" value="Enviar">
    </form>
@stop