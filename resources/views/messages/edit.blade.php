@extends('layout')
@section('contenido')
    <h1> Editar mensaje </h1>
    <form method="post" action="{{ route('messages.update', $message->id) }}">
        @include('messages.form', [
            'btnText' => 'Actualizar',
            'showFields' => ! $message->user_id
            ])
        {!! method_field('PUT') !!}
    </form>
@stop