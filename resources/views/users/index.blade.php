@extends('layout')

@section('contenido')
    <h1>Todos los usuarios</h1>

    <a class="btn btn-primary pull-right" href="{{ route('users.create') }}">Crear nuevo usuario</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Role</th>
                <th>Notas</th>
                <th>Tags</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->present()->link() }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->present()->roles() }}</td>
                    <td>{{ $user->present()->notes() }}</td>
                    <td>{{ $user->present()->tags() }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-xs">Editar</a>
                        <form method="post" style="display:inline;" action="{{ route('users.destroy', $user->id) }}">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
