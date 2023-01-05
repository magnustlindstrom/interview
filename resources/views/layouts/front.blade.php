<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/front.js') }}" defer></script>

        {{-- TODO: add 32x32, 16x16 and .ico favicon --}}
        <link rel="icon" type="image/png" sizes="64x64" href="/favicon.png" />
    </head>
    <body data-theme="classic">
        <div class="relative bg-gray-50">
            <x-front.header></x-front.header>

            {{ $slot ?? null }}
            @yield('content')

            <x-front.footer></x-front.footer>
        </div>
    </body>
</html>
