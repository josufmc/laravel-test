@extends('layout')
@section('contenido')
    <h1> Login </h1>
    <form method="post" class="form-inline" action="{{ route('login') }}">
        <p><label for="email"> Email
            <input type="email" name="email" class="form-control" value="">
        </label></p>
        <p><label for="password"> Password
            <input type="password" name="password" class="form-control" value="">
        </label></p>
        {!! csrf_field() !!}
        <input type="submit" class="btn btn-primary" value="Enviar">
    </form>
@stop