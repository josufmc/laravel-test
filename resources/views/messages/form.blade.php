
@if ($showFields)
    <p><label for="nombre"> Nombre
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $message->nombre) }}">
        {!! $errors->first('nombre', '<span class=error>:message</span>') !!}
    </label></p>
    <p><label for="email"> Email
        <input type="email" name="email" class="form-control" value="{{ old('email', $message->email) }}">
        {!! $errors->first('email', '<span class=error>:message</span>') !!}
    </label></p>
@endif
<p><label for="mensaje"> Mensaje
    <textarea class="form-control" name="mensaje">{{ old('mensaje', $message->mensaje) }}</textarea>
    {!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
</label></p>
{!! csrf_field() !!}
<input type="submit" class="btn btn-primary" id="save" value="{{ $btnText }}">