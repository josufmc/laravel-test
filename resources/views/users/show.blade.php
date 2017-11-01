@extends('layout')

@section('contenido')
    <h1>Mensaje: {{ $message->id }}</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $message->nombre }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->mensaje }}</td>
            </tr>
        </tbody>
    </table>
@stop
