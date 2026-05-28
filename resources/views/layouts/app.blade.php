<!DOCTYPE html>
<html lang="id" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistem Lumina') }}</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen font-sans">
    {{ $slot ?? '' }}
    @yield('content')
    @livewireScripts
</body>
</html>
