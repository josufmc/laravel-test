@extends('layout')

@section('contenido')
    <h1>Usuario: {{ $user->id }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Roles</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->pluck('display_name')->implode(', ') }}</td>
            </tr>
        </tbody>
    </table>

    @can('edit', $user)
        <a class="btn btn-info" href="{{route('users.edit', $user->id)}}" role="button">Editar</a>
    @endcan

    @can('destroy', $user)
        <form method="post" style="display:inline;" action="{{ route('users.destroy', $user->id) }}">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    @endcan

@stop
