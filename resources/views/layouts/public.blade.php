<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
   
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta name="description"
        content="Healing Touch Hospital, Linebazar, Purnea offers online appointments, specialist doctors, and complete healthcare services.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="font-sans antialiased">
 <livewire:public.header />

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    @livewireScripts

</body>

</html>
