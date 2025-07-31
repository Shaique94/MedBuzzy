<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <style>
        .sidebar-link:hover,
        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0) 100%);
            border-left: 4px solid #3b82f6;
        }

        .notification-dot {
            position: absolute;
            top: 3px;
            right: 3px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #ef4444;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 font-sans antialiased">

    <!-- Mobile Header with Toggle -->
    <div class="md:hidden bg-white p-4 shadow-md flex items-center justify-between sticky top-0 z-30">
        <button onclick="toggleSidebar()" class="text-gray-700">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <span class="font-semibold text-lg text-blue-700">Doctor Dashboard</span>
        <div class="relative">
            <i class="fas fa-bell text-gray-600 text-xl"></i>
            <span class="notification-dot"></span>
        </div>
    </div>

    <!-- Page Container -->
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <livewire:admin.sidebar />

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col md:ml-64 transition-all duration-300">

            <!-- Header -->
            <livewire:admin.header />

            <!-- Page Content -->
            {{ $slot }}

            <!-- Footer -->
              <footer class="mt-12 bg-gray-50 shadow-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0">
            <div class="text-sm text-gray-500 text-center md:text-left">
                &copy; {{ date('Y') }} <span class="font-semibold text-blue-600">MedBuzzy</span>. All rights reserved.
            </div>
           
        </div>
    </footer>

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
