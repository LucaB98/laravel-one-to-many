<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    
    <!-- Per far si che carichi direttamente la pagina senza mostrare linee di codice all'utente nel caricamento (in app.scss faccio tornare il body visible dopo che la pagina ha caricato tutto) -->
    <style>
        body{
            visibility:hidden
        }
    </style>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CDN -->
    @yield('cdns')

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        {{-- Navbar --}}
        @include('includes.layouts.navbar')
        {{-- Alert --}}
        @include('includes.alert')
        {{-- Main content --}}
        @yield('content')
    </div>
    {{-- Toasts --}}
    @include('includes.toast')

    {{-- Scripts --}}
    @yield('scripts')
</body>

</html>
