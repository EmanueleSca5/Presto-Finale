<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js' , "resources\css\style.css"])

        @livewireStyles
    </head>
    <body class="bg-black">
        <x-navbar></x-navbar>

       @if (session('success'))
    <div class="container mt-3 bg-black">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    </div>
@endif

        {{ $slot }}

        @livewireScripts
    </body>
</html>
