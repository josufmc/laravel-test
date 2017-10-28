@extends('layout')
@section('contenido')
    <h1> Login </h1>
    <form method="post" action="{{ route('login') }}">
        <p><label for="email"> Email
            <input type="email" name="email" value="">
        </label></p>
        <p><label for="password"> Password
            <input type="password" name="password" value="">
        </label></p>
        {!! csrf_field() !!}
        <input type="submit" value="Enviar">
    </form>
@stop