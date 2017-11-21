@extends('layout')

@section('contenido')
    <h1>Mensaje: {{ $message->id }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{!! $message->present()->userName() !!}</td>
                <td>{{ $message->present()->userEmail() }}</td>
                <td>{{ $message->mensaje }}</td>
            </tr>
        </tbody>
    </table>
@stop
