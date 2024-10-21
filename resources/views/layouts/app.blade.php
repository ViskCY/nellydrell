<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- General Meta Tags -->
        <meta name="description" content="Nelly Drell ametlik veebileht">
        <meta name="keywords" content="nellydrell, art, maalid, galerii, töö, paintings">
        <meta name="author" content="Karl-Jasper Niidi">

        @stack('meta')

        <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">

        <title>
            {{ (isset($title) ? $title . ' - ' : '') . config('app.name', 'Laravel') }}
        </title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
        <livewire:styles />

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            // Credit: https://flowbite.com/docs/customize/dark-mode/
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
        
        <!-- EasyMDE CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde@latest/dist/easymde.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        @stack('styles')

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col" style="background-color: #000000;">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <livewire:scripts />

        <!-- EasyMDE JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/easymde@latest/dist/easymde.min.js"></script>

        @stack('scripts')

        @if (app()->isLocal())
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endif
    </body>
</html>
