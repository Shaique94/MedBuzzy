<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tailwind CSS with full config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-orange': {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        },
                        'brand-teal': {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS for gradients and mobile nav -->
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #f0fdfa 0%, #ffffff 70%, #fff7ed 100%);
        }

        .search-gradient {
            background: linear-gradient(90deg, #14b8a6 0%, #2dd4bf 100%);
        }
        
        /* Mobile Bottom Navigation Styles */
        .mobile-bottom-nav {
            transition: all 0.3s ease;
        }
        
        .mobile-bottom-nav a {
            transition: all 0.2s ease-out;
        }
        
        .mobile-bottom-nav a:active {
            transform: scale(0.95);
        }
        
        .mobile-bottom-nav .active-tab {
            @apply text-teal-600;
        }
        
        .mobile-bottom-nav .active-tab div {
            @apply bg-teal-600 text-white shadow-md;
        }
    </style>

    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

   

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col transition-all duration-300">
        <!-- Header -->
        <livewire:public.header />

        <!-- Page Content -->
        <main class="flex-1 overflow-x-hidden md:mt-28 mt-14  overflow-y-auto bg-gray-100 pb-5 lg:pb-0">
            <div class="container mx-auto px-0 py-4">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <livewire:public.footer />
        
        <!-- Mobile Bottom Navigation -->
        @include('components.mobile-bottom-nav')
    </div>

    @livewireScripts
</body>
</html>