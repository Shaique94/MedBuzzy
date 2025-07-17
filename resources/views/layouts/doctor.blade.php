<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Doctor Dashboard</title>

    <!-- Tailwind (optional, if not already included in app.css) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Canonical & OpenGraph -->
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- App styles and scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="//unpkg.com/alpinejs" defer></script>

    @livewireStyles
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Mobile Header -->
    <div class="md:hidden bg-white p-4 shadow flex items-center justify-between">
        <button onclick="toggleSidebar()" class="text-gray-700 focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <span class="font-semibold text-lg">Doctor Dashboard</span>
    </div>

    <!-- Page Container -->
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-md transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-30">
            <livewire:doctor.sidebar />
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-64 transition-all duration-300">

            <!-- Header -->
            <livewire:doctor.header />

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <livewire:doctor.footer />
        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>

    @livewireScripts
</body>
</html>
