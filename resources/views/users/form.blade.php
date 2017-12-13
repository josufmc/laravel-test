<p><label for="avatar"> Avatar
    <input type="file" name="avatar">
    {!! $errors->first('avatar', '<span class=error>:message</span>') !!}
</label></p>
<p><label for="name"> Nombre
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
    {!! $errors->first('name', '<span class=error>:message</span>') !!}
</label></p>
<p><label for="email"> Email
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
    {!! $errors->first('email', '<span class=error>:message</span>') !!}
</label></p>
@unless ($user->id)
    <p><label for="password"> Password
        <input type="password" name="password" class="form-control" value="">
        {!! $errors->first('password', '<span class=error>:message</span>') !!}
    </label></p>
    <p><label for="password_confirmation"> Password confirmation
        <input type="password" name="password_confirmation" class="form-control" value="">
        {!! $errors->first('password_confirmation', '<span class=error>:message</span>') !!}
    </label></p>
@endunless
<p>
    @foreach ($roles as $id => $name)
        <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" 
                class="form-check-input" 
                name="roles[]" 
                {{ $user->roles->pluck('id')->contains($id) ? 'checked' : '' }}
                value="{{ $id }}"> 
                {{ $name }}
        </label>
        </div>
    @endforeach
    {!! $errors->first('roles', '<span class=error>:message</span>') !!}
</p>

{!! csrf_field() !!}