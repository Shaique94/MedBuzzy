<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

     {{-- <title>{{ $title ? $title . ' | Manager Panel - MedBuzzy' : 'Manager Panel - MedBuzzy' }}</title>  --}}


    <!-- Open Graph & canonical tags (optional) -->
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <script src="https://cdn.tailwindcss.com"></script>
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
    </script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Mobile header -->


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
                <div class="container mx-auto ">
                    {{ $slot }}
                    @livewire('livewire-ui-modal')
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
