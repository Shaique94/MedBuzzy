<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
          <title>{{ $title ?? ' Doctor Panel - MedBuzzy' }}</title>
    


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
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 md:hidden hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-64 transition-all duration-300">

            <!-- Header -->
            <livewire:doctor.header />

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-4 sm:px-6 py-6 ">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            {{-- <livewire:doctor.footer /> --}}
        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        // function toggleSidebar() {
        //     const sidebar = document.getElementById('sidebar');
        //     sidebar.classList.toggle('-translate-x-full');
        // }

         function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            
            // Toggle body scroll
            document.body.classList.toggle('overflow-hidden', !sidebar.classList.contains('-translate-x-full'));
        }

        // Close sidebar when clicking outside (mobile)
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (!sidebar.contains(e.target) && !e.target.closest('[data-sidebar-toggle]') && !overlay.classList.contains('hidden')) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>

    @livewireScripts

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('profile-picture-updated', (event) => {
            // Force refresh any Livewire components showing the profile picture
            Livewire.dispatch('refresh-navigation');
            
            // Update all profile images on the page
            document.querySelectorAll('[wire\\:key^="profile-image-"]').forEach(img => {
                img.src = `${event.imageUrl}?t=${new Date().getTime()}`;
            });
        });
    });
</script>

</body>
</html>




