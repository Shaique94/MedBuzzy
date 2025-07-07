<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Manager Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Open Graph & canonical tags (optional) -->
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Mobile header -->
    <div class="md:hidden bg-white p-4 shadow flex items-center justify-between">
        <button onclick="toggleSidebar()" class="text-gray-700">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <span class="font-semibold text-lg">Manager Dashboard</span>
    </div>

    <!-- Page container -->
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <livewire:manager.sidebar />

        <!-- Main content -->
        <div class="flex-1 flex flex-col md:ml-64 transition-all duration-300">

            <!-- Header -->
            <livewire:manager.header />

            <!-- Page content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <livewire:manager.footer />
        </div>
    </div>

    <!-- Sidebar toggle script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>

    @livewireScripts
</body>
</html>
