<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <livewire:admin.header />
    <!-- Page Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>
    <!-- Footer -->
    <livewire:admin.footer />

    @livewireScripts
</body>

</html>