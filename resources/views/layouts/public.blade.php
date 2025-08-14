<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ $title ?? ' MedBuzzy - Healthcare Management System' }}</title>
    <title>Book Doctors Online | MedBuzzy - Purnea, Bihar</title>
    <meta name="description"
        content="Book appointments with trusted doctors in Purnea, Bihar. MedBuzzy offers instant booking, expert consultations, and 24/7 support.">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="Book Doctors Online | MedBuzzy">
    <meta property="og:description"
        content="Book appointments with trusted doctors in Purnea, Bihar. MedBuzzy offers instant booking, expert consultations, and 24/7 support.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <!-- Tailwind CSS with full config -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js - Loading this before Tailwind -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': {
                            50: '#e6f0f9',
                            100: '#cce0f4',
                            200: '#99c1e9',
                            300: '#66a2dd',
                            400: '#3383d2',
                            500: '#1864ac',
                            600: '#0d4b8c',
                            700: '#073976',
                            800: '#042c61',
                            900: '#00264d',
                        },
                        'brand-yellow': {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
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
                        },
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
                        }
                    }
                }
            }
        }
    </script> --}}

    <!-- Custom CSS for gradients and mobile nav -->
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #e6f0f9 0%, #ffffff 70%, #fffbeb 100%);
        }

        .search-gradient {
            background: linear-gradient(90deg, #0d4b8c 0%, #1864ac 100%);
        }

        /* Primary brand blue from logo */
        .bg-primary {
            background-color: #00264d;
        }

        .text-primary {
            color: #00264d;
        }

        /* Brand yellow/gold from logo */
        .bg-secondary {
            background-color: #f59e0b;
        }

        .text-secondary {
            color: #f59e0b;
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
            @apply text-brand-blue-600;
        }

        .mobile-bottom-nav .active-tab div {
            @apply bg-brand-blue-600 text-white shadow-md;
        }

        /* Add x-cloak directive support */
        [x-cloak] {
            display: none !important;
        }
    </style>

    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">


      <!-- Preload critical CSS -->
    <style>
        /* Critical CSS for above-the-fold content */
        body { @apply bg-gray-50 font-sans min-h-screen flex flex-col }
        .container { @apply mx-auto px-0 py-4 }
        /* Add other critical styles */
    </style>

  
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
        <main class="flex-1 overflow-x-hidden md:mt-20 mt-10  overflow-y-auto bg-gray-100 pb-5 lg:pb-0">
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

    <script src="https://kit.fontawesome.com/9620ac7e85.js" crossorigin="anonymous"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/689c2cfeddd4a0192670a0f5/1j2h0vh9g';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>
