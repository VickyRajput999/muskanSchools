<x-mail::message>
    Hello {{ $user->name }},
    <x-mail::button :url="route('auth.reset', ['remember_token' => $user->remember_token])">
        Click here to reset your password
    </x-mail::button>

    Or Copy Paste the following link on your web browser to reset your password

    {{ route('auth.reset', ['remember_token' => $user->remember_token]) }}
            {{-- {{ route('auth.reset', ['remember_token' => $user->remember_token]) }} --}}



    Thanks
    {{ config('app.name') }}
</x-mail::message>
