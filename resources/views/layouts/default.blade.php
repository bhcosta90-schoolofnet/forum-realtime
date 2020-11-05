<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content={{ csrf_token()}} />
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}" />
    </head>
    <body class="antialiased">
        <header>
            @include('layouts.default.header')
        </header>

        <main>
            <section id="app">
                @yield('content')
            </section>
        </main>

        <footer class='page-footer'>
            @include('layouts.default.footer')
        </footer>
        @component('layouts.default.scripts')
            @yield('scripts')
        @endcomponent
        
    </body>
</html>
