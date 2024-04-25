<x-mail::message>
    Hello {{ $user->name }},
    <x-mail::button :url="route('auth.reset', ['remember_token' => $user->remember_token])">
        Click here to reset your password
    </x-mail::button>

    <p>Or Copy Paste the following link on your web browser to reset your password</p>
    <p>
        <a href="{{ route('auth.reset', ['remember_token' => $user->remember_token]) }}">
            {{ route('auth.reset', ['remember_token' => $user->remember_token]) }}
        </a>
    </p>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
