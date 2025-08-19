<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ? $title . ' | Admin Panel - MedBuzzy' : 'Admin Panel - MedBuzzy' }}</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">



    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- jQuery and toastr.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        /* Minimal, performance-friendly admin overrides (no shadows/gradients) */
        :root {
            --fw-regular: 400;
            --fw-medium: 500;
            --fw-semibold: 600;
        }
        .font-bold { font-weight: var(--fw-semibold) !important; }
        .font-semibold { font-weight: var(--fw-medium) !important; }
        /* Neutralize shadow utilities */
        [class*="shadow-"], .card-hover, .shadow-inner, .shadow-lg, .shadow-sm, .shadow-2xl {
            box-shadow: none !important;
            text-shadow: none !important;
        }
        /* Use flat primary color, avoid gradients */
        .btn-primary { background-color: #2563eb; color: #fff; }
        .btn-primary:hover { filter: brightness(0.97); }

        /* Sidebar: subtle flat hover + left border */
        .sidebar-link {
            transition: background-color 140ms ease, border-left-color 140ms ease;
            border-radius: 0.5rem;
            margin: 0.25rem 0;
            transform: none !important;
        }
        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: rgba(59,130,246,0.04);
            border-left: 4px solid #3b82f6;
            box-shadow: none;
        }

        /* Inputs & buttons: flat and accessible */
        input, select, textarea, button, .form-input {
            box-shadow: none !important;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            background: #fff;
            transition: border-color 120ms ease, background-color 120ms ease;
        }
        input:focus, select:focus, textarea:focus, button:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: none;
        }

        /* Remove heavy overlay blur */
        .sidebar-overlay { backdrop-filter: none; background: rgba(0,0,0,0.45); }

        /* Responsive text sizing */
        .responsive-text-xs { font-size: 0.72rem; line-height: 1rem; }
        .responsive-text-sm { font-size: 0.82rem; line-height: 1.1rem; }
        .responsive-text-base { font-size: 0.95rem; line-height: 1.35rem; }
        .responsive-text-lg { font-size: 1.05rem; line-height: 1.5rem; }

        @media (max-width: 640px) {
            button, a, input, select, textarea { min-height: 44px; }
            .responsive-text-base { font-size: 0.95rem; }
        }

        /* Print: remove decorative effects */
        @media print {
            [class*="shadow-"], .card-hover { box-shadow: none !important; }
            .bg-gradient-to-r, .bg-gradient-to-br { background: none !important; }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Mobile Header with Toggle -->
    <div class="lg:hidden bg-white p-2 sm:p-3 md:p-4 flex items-center justify-between sticky top-0 z-30 border-b border-gray-200">
        <button onclick="toggleSidebar()" class="text-gray-700 hover:text-blue-600 transition-colors duration-200 p-1.5 sm:p-2 rounded-lg hover:bg-blue-50 active:bg-blue-100">
            <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="flex items-center space-x-1.5 sm:space-x-2">
            <img src="/logo/logo.png" alt="MedBuzzy Logo" class="h-10 sm:h-11 md:h-16">
        </div>
        <div class="flex items-center space-x-1 sm:space-x-2 md:space-x-3">
            <div class="relative">
                <button class="text-gray-600 hover:text-blue-600 transition-colors duration-200 p-1.5 sm:p-2 rounded-lg hover:bg-gray-100 active:bg-gray-200">
                    <i class="fas fa-bell text-sm sm:text-base md:text-lg"></i>
                    <span class="absolute top-0.5 right-0.5 sm:top-1 sm:right-1 inline-block w-1.5 h-1.5 sm:w-2 sm:h-2 bg-red-500 rounded-full notification-dot"></span>
                </button>
            </div>
            <div class="w-6 h-6 sm:w-8 sm:h-8 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-gray-600 text-xs sm:text-sm"></i>
            </div>
        </div>
    </div>

    <!-- Page Container -->
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <livewire:admin.sidebar />

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col lg:ml-64 transition-all duration-300">
            <!-- Header -->
            <livewire:admin.header />

            <!-- Page Content -->
            <main class="flex-1  bg-gray-50 min-h-screen">
                <div class="mx-auto px-4 py-6 max-w-7xl">
                {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-auto">
                <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 py-3 sm:py-4 md:py-6 flex flex-col sm:flex-row items-center justify-center space-y-1 sm:space-y-0">
                    <div class="responsive-text-sm text-gray-500 text-center">
                        &copy; {{ date('Y') }} <span class="font-semibold text-blue-600">MedBuzzy</span>. All rights reserved.
                    </div>
                    <div class="hidden sm:block sm:ml-4 text-xs text-gray-400">
                        Healthcare Management System
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-900/50 z-15 lg:hidden hidden sidebar-overlay" onclick="toggleSidebar()"></div>

    @livewireScripts
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar.classList.contains('-translate-x-full')) {
                 // Show sidebar
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                // Hide sidebar
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }
         // Close sidebar on window resize if desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Add active state to current sidebar link

        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            sidebarLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            // Toastr Configuration
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 3000,
                showMethod: 'fadeIn',
                hideMethod: 'fadeOut'
            };

            // Log to confirm jQuery and toastr are loaded
            console.log('jQuery loaded:', typeof jQuery !== 'undefined');
            console.log('Toastr loaded:', typeof toastr !== 'undefined');

            Livewire.on('success', (message) => {
                console.log('Livewire success event received:', message);
                toastr.success(message, 'Success');
            });

            Livewire.on('error', (message) => {
                console.log('Livewire error event received:', message);
                toastr.error(message, 'Error');
            });
        });
    </script>
</body>
</html>