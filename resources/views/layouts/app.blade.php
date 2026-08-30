<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
   <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex">

        {{-- Sidebar --}}
       <aside class="w-64 bg-slate-900 flex-shrink-0">
    <div class="px-6 py-5 border-b border-slate-700">
        <span class="text-lg font-bold text-white">CRM</span>
    </div>
    <nav class="p-4 space-y-1">
        <a href="/dashboard" class="@if(request()->is('dashboard')) bg-indigo-600 text-white @else text-slate-300 hover:bg-slate-800 @endif block px-4 py-2 rounded-lg">
            Dashboard
        </a>
        <a href="/clients" class="@if(request()->is('clients*')) bg-indigo-600 text-white @else text-slate-300 hover:bg-slate-800 @endif block px-4 py-2 rounded-lg">
            Clients
        </a>
        <a href="/deals" class="@if(request()->is('deals*')) bg-indigo-600 text-white @else text-slate-300 hover:bg-slate-800 @endif block px-4 py-2 rounded-lg">
            Deals
        </a>
    </nav>
</aside>

        {{-- Right side: navbar + header + page content --}}
        <div class="flex-1 flex flex-col">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>
</html>
