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
    <body class="bg-sici-dark text-sici-light font-sans antialiased min-h-screen flex flex-col justify-center items-center relative overflow-hidden">
        
        <div class="absolute inset-0 opacity-10 pointer-events-none" 
             style="background-image: radial-gradient(#EF4444 1px, transparent 1px); background-size: 30px 30px;">
        </div>

        <div class="w-full sm:max-w-md px-6 py-4 relative z-10">
            <div class="flex justify-center mb-8">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" class="h-20 w-auto" alt="Logo SICI">
                </a>
            </div>

            {{ $slot }}
            
            <div class="mt-8 text-center">
                <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto mx-auto opacity-50 grayscale hover:grayscale-0 transition duration-500" alt="SICI Footer">
            </div>
        </div>
    </body>
</html>