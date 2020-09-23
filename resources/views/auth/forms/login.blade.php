{!! Form::open([
    'route'  => 'login.user',
    'class'  => 'rounded',
    'method' => 'POST',
    'id'     => 'auth-form',
]) !!}
{!! Form::hidden('via', 'web') !!}

<div class="mb-4">
    {!! Form::button(__('Sign In with Spotify'), ['type' => 'submit', 'class' => 'rounded-full bg-green-600 hover:bg-green-700 px-8 py-4 outline-none transition duration-150']) !!}
</div>

{!! Form::close() !!}
