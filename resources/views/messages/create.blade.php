@extends('layout')
@section('contenido')
    <h1> Crear mensaje </h1>
    <form method="post" action="{{ route('messages.store') }}">
        @include('messages.form', ['message' => new App\Message(), 'btnText' => 'Crear'])
        {!! method_field('POST') !!}
    </form>
@stop
