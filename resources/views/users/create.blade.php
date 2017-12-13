@extends('layout')
@section('contenido')
    <h1> Crear mensaje </h1>
    <form method="post" enctype="multipart/form-data" action="{{ route('users.store') }}">
        @include('users.form', ['user' => new App\User()])
        <input type="submit" class="btn btn-primary" value="Enviar">
    </form>
@stop
