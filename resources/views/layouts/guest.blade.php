<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Formulir Akses Ruang Server - Pupuk Kujang' }}</title>

        <!-- Favicon Logo Perusahaan -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo_pkc_light.png') }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo_pkc_light.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased min-h-screen bg-[#F8FAF9] dark:bg-[#030504] text-slate-900 dark:text-slate-100">
        {{ $slot }}
        @livewireScripts
    </body>
</html>