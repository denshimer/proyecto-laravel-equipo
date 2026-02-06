<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>{{ $title ?? 'SICI-ISI' }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&family=Inter:wght@400;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-sici-dark text-sici-light font-sans antialiased flex flex-col min-h-screen">

        <x-navbar />

        <main class="flex-grow pt-16 pb-20 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>

        <x-footer />
        
    </body>
</html>