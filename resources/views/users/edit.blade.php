@extends('layout')
@section('contenido')
    <h1> Editar mensaje </h1>
    @if(session()->has('info'))
        <div class="alert alert-success" role="alert">
            {{ session('info') }}
        </div>      
    @endif
    <form method="post" enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}">
        <img width="100" src="{{ Storage::url($user->avatar) }}">
        @include('users.form')
        {!! method_field('PUT') !!}
        <input type="submit" class="btn btn-primary" value="Enviar">
    </form>
@stop