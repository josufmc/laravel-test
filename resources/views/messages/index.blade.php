@extends('layout')

@section('contenido')
    <h1>Todos los mensajes</h1>

    {!! $messages->appends(request()->query())->links('pagination::default') !!}
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Notas</th>
                <th>Tags</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->present()->userName() }}</td>
                    <td>{{ $message->present()->userEmail() }}</td>
                    <td>{{ $message->present()->link() }}</td>
                    <td>{{ $message->present()->notes() }}</td>
                    <td>{{ $message->present()->tags() }}</td>
                    <td>
                        <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-info btn-xs">Editar</a>
                        <form method="post" style="display:inline;" action="{{ route('messages.destroy', $message->id) }}">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $messages->appends(request()->query())->links('pagination::default') !!}
@stop
