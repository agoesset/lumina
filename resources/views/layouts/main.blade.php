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
<body class="bg-background text-slate-900 min-h-screen font-sans">
    <div class="h-screen flex flex-col">
        @livewire('header')
        
        <div class="flex flex-1 min-h-0">
            @livewire('sidebar')
            
            <main class="flex-1 overflow-y-auto relative">
                <div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8">
                    {{ $slot ?? '' }}
                </div>
                @livewire('footer')
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>