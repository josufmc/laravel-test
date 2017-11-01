@extends('layout')
@section('contenido')
    <h1> Editar mensaje </h1>
    @if(session()->has('info'))
        <div class="alert alert-success" role="alert">
            {{ session('info') }}
        </div>      
    @endif
    <form method="post" action="{{ route('users.update', $user->id) }}">
        <p><label for="name"> Nombre
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            {!! $errors->first('name', '<span class=error>:message</span>') !!}
        </label></p>
        <p><label for="email"> Email
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            {!! $errors->first('email', '<span class=error>:message</span>') !!}
        </label></p>
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <input type="submit" class="btn btn-primary" value="Enviar">
    </form>
@stop