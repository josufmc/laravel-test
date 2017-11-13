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
                    @if ($message->user_id)
                        <td><a href="{{ route('users.show', $message->user->id) }}">{{ $message->user->name }}</a></td>
                        <td>{{ $message->user->email }}</td>
                    @else
                        <td>{{ $message->nombre }}</td>
                        <td>{{ $message->email }}</td>
                    @endif
                    <td><a href="{{ route('messages.show', $message->id) }}">{{ $message->mensaje }}</a></td>
                    <td>{{ $message->note ? $message->note->body : '' }}</td>
                    <td>{{ $message->tags ? $message->tags->pluck('name')->implode(', ') : '' }}</td>
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
