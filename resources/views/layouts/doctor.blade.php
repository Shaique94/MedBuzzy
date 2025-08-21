<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'Doctor Panel - MedBuzzy' }}</title>

    <!-- Canonical & OpenGraph -->
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- App styles and scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 font-sans antialiased">
    <!-- Page Container -->
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-md transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-30">
            <livewire:doctor.sidebar />
        </div>

        <!-- Sidebar Overlay (for mobile) -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 md:hidden hidden" onclick="closeSidebar()"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-64 transition-all duration-300">

            <!-- Header -->
            <livewire:doctor.header />

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden bg-gray-100">
                <div class="container mx-auto px-4 sm:px-6 py-6">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            {{-- <livewire:doctor.footer /> --}}
        </div>
    </div>

    @livewireScripts
    
    <!-- Simple and Reliable Sidebar Script -->
    <script>
        // Toggle sidebar function
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            // Toggle sidebar
            sidebar.classList.toggle('-translate-x-full');
            
            // Toggle overlay
            overlay.classList.toggle('hidden');
            
            // Prevent body scroll when sidebar is open
            if (!sidebar.classList.contains('-translate-x-full')) {
                document.body.classList.add('overflow-hidden');
            } else {
                document.body.classList.remove('overflow-hidden');
            }
        }
        
        // Close sidebar function
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        
        // Close sidebar when clicking outside (for mobile)
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggleButton = document.querySelector('[onclick="toggleSidebar()"]');
            
            // If click is outside sidebar and overlay is visible, close sidebar
            if (!sidebar.contains(e.target) && 
                e.target !== toggleButton && 
                !toggleButton.contains(e.target) &&
                !overlay.classList.contains('hidden')) {
                closeSidebar();
            }
        });
        
        // Close sidebar when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const overlay = document.getElementById('sidebar-overlay');
                if (!overlay.classList.contains('hidden')) {
                    closeSidebar();
                }
            }
        });
        
        // Close sidebar when navigating (Livewire navigation)
        document.addEventListener('livewire:navigated', function() {
            closeSidebar();
        });
    </script>
</body>
</html>