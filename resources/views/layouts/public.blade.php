<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'MedBuzzy - Healthcare Management System' }}</title>
    <meta name="description" content="Book appointments with trusted doctors in Purnea, Bihar. MedBuzzy offers instant booking, expert consultations, and 24/7 support.">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="Book Doctors Online | MedBuzzy">
    <meta property="og:description" content="Book appointments with trusted doctors in Purnea, Bihar. MedBuzzy offers instant booking, expert consultations, and 24/7 support.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Tailwind CSS -->
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

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    <!-- Custom CSS -->
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #e6f0f9 0%, #ffffff 70%, #fffbeb 100%);
        }
        .search-gradient {
            background: linear-gradient(90deg, #0d4b8c 0%, #1864ac 100%);
        }
        .bg-primary { background-color: #00264d; }
        .text-primary { color: #00264d; }
        .bg-secondary { background-color: #f59e0b; }
        .text-secondary { color: #f59e0b; }
        .mobile-bottom-nav { transition: all 0.3s ease; }
        .mobile-bottom-nav a { transition: all 0.2s ease-out; }
        .mobile-bottom-nav a:active { transform: scale(0.95); }
        .mobile-bottom-nav .active-tab { color: #0d4b8c; }
        .mobile-bottom-nav .active-tab div { background-color: #0d4b8c; color: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        [x-cloak] { display: none !important; }
        @media (max-width: 768px) { .tawk-chat-container { display: none !important; } }
        /* Ensure scroll is not locked by modals */
        body.razorpay-checkout-open { overflow: auto !important; }

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
            color: #0d4b8c;
        }

        .mobile-bottom-nav .active-tab div {
            background-color: #0d4b8c;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Add x-cloak directive support */
        [x-cloak] {
            display: none !important;
        }

        /* Hide Tawk.to widget on mobile */
        @media (max-width: 768px) {
            .tawk-chat-container {
                display: none !important;
            }
        }

        /* In your app.css or public CSS file */
.modal-enter {
    opacity: 0;
}
.modal-enter-active {
    opacity: 1;
    transition: opacity 100ms;
}
.modal-exit {
    opacity: 1;
}
.modal-exit-active {
    opacity: 0;
    transition: opacity 100ms;
}
    </style>

    <!-- Critical CSS -->
    <style>
        body {
            background-color: #f9fafb;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .container {
            margin-left: auto;
            margin-right: auto;
            padding-left: 0;
            padding-right: 0;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
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
        <main class="flex-1 overflow-x-hidden md:mt-15 mt-12 overflow-y-auto bg-gray-100 lg:pb-0">
            <div class="mx-auto px-0">
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
        @stack("scripts")
    
    <!-- Global Scripts -->
    <script>
        // SVG Auto Attribute Fix
        
        function otpComponent(initialCountdown) {
        return {
            countdown: initialCountdown,
            countdownInterval: null,
            init() {
                if (this.countdown > 0) {
                    this.startCountdown();
                }
                Livewire.on('start-countdown', () => {
                    this.countdown = 30;
                    this.startCountdown();
                    
                });
            },
            startCountdown() {
                clearInterval(this.countdownInterval);
                this.countdownInterval = setInterval(() => {
                    if (this.countdown > 0) {
                        this.countdown--;
                    } else {
                        clearInterval(this.countdownInterval);
                    }
                }, 1000);
            }
        }
    }
    </script>

    <!-- Tawk.to Chat - Desktop Only -->
    <script>
        // Initialize Tawk.to chat widget for all screen sizes
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function(){
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/689c2cfeddd4a0192670a0f5/1j2h0vh9g';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>

    <!-- Global payment processing loader (hidden by default) -->
    <div id="global-processing-loader" class="hidden fixed inset-0 z-50 items-center justify-center bg-brand-blue-600 bg-opacity-95">
        <div class="text-center">
            <div class="inline-block w-16 h-16 border-4 border-white border-t-transparent rounded-full animate-spin mb-4" aria-hidden="true"></div>
            <div class="text-white font-semibold text-lg">Processing payment…</div>
        </div>
    </div>

    <script>
        (function () {
            const loader = document.getElementById('global-processing-loader');
            function showLoader() {
                if (!loader) return;
                loader.classList.remove('hidden');
                loader.classList.add('flex');
            }
            function hideLoader() {
                if (!loader) return;
                loader.classList.remove('flex');
                loader.classList.add('hidden');
            }

            // Show loader immediately when Razorpay returns success (client-side CustomEvent)
            window.addEventListener('payment-success', () => {
                showLoader();
            });

            // Also react to Livewire event emitted from server when payment handling starts
            if (typeof Livewire !== 'undefined') {
                Livewire.on('payment-processing-started', () => {
                    showLoader();
                });
                // Hide if payment failed
                Livewire.on('payment-failed', () => {
                    hideLoader();
                });
                // Hide on redirect-to-confirmation (server will redirect; hide as fallback)
                Livewire.on('redirect-to-confirmation', () => {
                    hideLoader();
                });
            }

            // Safety: hide loader if navigation occurs (prevent it from sticking)
            window.addEventListener('beforeunload', () => hideLoader());
        })();
    </script>
</body>
</html>