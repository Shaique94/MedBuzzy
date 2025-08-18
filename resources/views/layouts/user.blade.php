<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Patient Dashboard | MedBuzzy' }}</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Sidebar transitions */
        .sidebar-collapse {
            transform: translateX(calc(-100% + 4rem)); /* Leaves room for icons */
        }
        
        .sidebar-transition {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sidebar-item-transition {
            transition: all 0.2s ease-in-out;
        }
        
        .sidebar-text {
            transition: opacity 0.15s ease-in-out, margin 0.2s ease-in-out;
        }
        
        .main-content-transition {
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
    
    @livewireStyles
</head>

<body class="bg-gray-50 font-sans antialiased">
    <!-- Header -->
    @include('livewire.user.header')

    <!-- Main Content -->
    <div class="flex min-h-screen">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 lg:hidden hidden opacity-0 transition-opacity duration-300" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        @include('livewire.user.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Page Content -->
            <main id="main-content" class="flex-1 lg:ml-64 p-4 md:p-6 bg-gray-50 main-content-transition">
                {{ $slot }}
            </main>

            {{-- footer --}}
            @include('livewire.user.footer')
        </div>
    </div>

    <script>
        // Track sidebar state
        let isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const mainContent = document.getElementById('main-content');
            
            // For mobile
            if (window.innerWidth < 1024) {
                const isHidden = sidebar.classList.contains('-translate-x-full');
                
                if (isHidden) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.remove('opacity-0'), 10);
                } else {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('opacity-0');
                    setTimeout(() => overlay.classList.add('hidden'), 300);
                }
            } 
            // For desktop - toggle collapsed state
            else {
                isSidebarCollapsed = !isSidebarCollapsed;
                
                // Toggle collapsed class
                sidebar.classList.toggle('lg:w-64');
                sidebar.classList.toggle('lg:w-20');
                sidebar.classList.toggle('sidebar-collapse');
                
                // Adjust main content margin
                mainContent.classList.toggle('lg:ml-64');
                mainContent.classList.toggle('lg:ml-20');
                
                // Toggle text visibility
                document.querySelectorAll('.sidebar-text').forEach(text => {
                    text.classList.toggle('opacity-0');
                    text.classList.toggle('ml-0');
                    text.classList.toggle('-ml-4');
                });
                
                // Store preference
                localStorage.setItem('sidebarCollapsed', isSidebarCollapsed);
            }
        }
        
        // Initialize sidebar state
        document.addEventListener('DOMContentLoaded', function() {
            if (isSidebarCollapsed && window.innerWidth >= 1024) {
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('main-content');
                
                sidebar.classList.add('lg:w-20', 'sidebar-collapse');
                sidebar.classList.remove('lg:w-64');
                mainContent.classList.add('lg:ml-20');
                mainContent.classList.remove('lg:ml-64');
                
                document.querySelectorAll('.sidebar-text').forEach(text => {
                    text.classList.add('opacity-0', '-ml-4');
                    text.classList.remove('ml-0');
                });
            }
            
            // Close mobile sidebar if window is resized to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebar-overlay');
                    
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.add('hidden');
                    overlay.classList.add('opacity-0');
                }
            });
        });
    </script>
    
    @livewireScripts
</body>
</html>