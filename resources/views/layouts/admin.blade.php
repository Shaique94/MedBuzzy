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

 /* Sidebar Styles */
        .sidebar-link {
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            margin: 0.25rem 0;
        }
        .sidebar-link:hover,
        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(79, 172, 254, 0.08) 100%);
            border-left: 4px solid #3b82f6;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        .sidebar-link i {
            transition: all 0.3s ease;
        }
        .sidebar-link:hover i {
            transform: scale(1.1);
        }

        /* Notification Styles */
        .notification-dot {
            position: absolute;
            top: 3px;
            right: 3px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #ef4444;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Chart and Grid Styles */
        .chart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        /* Mobile Sidebar Overlay */
        .sidebar-overlay {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        /* Responsive Container */
        .responsive-container {
            max-width: 100%;
            padding: 0.5rem;
        }
        @media (min-width: 480px) {
            .responsive-container {
                padding: 0.75rem;
            }
        }
        @media (min-width: 640px) {
            .responsive-container {
                padding: 1rem;
            }
        }
        @media (min-width: 768px) {
            .responsive-container {
                padding: 1.25rem;
            }
        }
        @media (min-width: 1024px) {
            .responsive-container {
                padding: 1.5rem 2rem;
            }
        }
        @media (min-width: 1280px) {
            .responsive-container {
                padding: 2rem;
            }
        }

        /* Enhanced Button Animations */
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        /* Form Input Enhancements */
        .form-input {
            transition: all 0.3s ease;
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #e5e7eb, #f3f4f6) border-box;
        }
        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Card Hover Effects */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Loading Animations */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Responsive Text Sizing */
        .responsive-text-xs { font-size: 0.65rem; line-height: 1rem; }
        .responsive-text-sm { font-size: 0.75rem; line-height: 1rem; }
        .responsive-text-base { font-size: 0.875rem; line-height: 1.25rem; }
        .responsive-text-lg { font-size: 1rem; line-height: 1.5rem; }
        @media (min-width: 480px) {
            .responsive-text-xs { font-size: 0.7rem; }
            .responsive-text-sm { font-size: 0.8rem; }
            .responsive-text-base { font-size: 0.9rem; }
            .responsive-text-lg { font-size: 1.1rem; }
        }
        @media (min-width: 640px) {
            .responsive-text-xs { font-size: 0.75rem; line-height: 1rem; }
            .responsive-text-sm { font-size: 0.875rem; line-height: 1.25rem; }
            .responsive-text-base { font-size: 1rem; line-height: 1.5rem; }
            .responsive-text-lg { font-size: 1.125rem; line-height: 1.75rem; }
        }
        @media (min-width: 1024px) {
            .responsive-text-xs { font-size: 0.75rem; line-height: 1rem; }
            .responsive-text-sm { font-size: 0.875rem; line-height: 1.25rem; }
            .responsive-text-base { font-size: 1rem; line-height: 1.5rem; }
            .responsive-text-lg { font-size: 1.25rem; line-height: 1.75rem; }
        }

        /* Enhanced Mobile Responsiveness */
        @media (max-width: 767px) {
            .sidebar-link {
                padding: 0.5rem 0.75rem;
                margin: 0.125rem 0;
            }
            .sidebar-link i {
                width: 1.25rem;
                margin-right: 0.5rem;
            }
            .mobile-hide {
                display: none;
            }
        }
        @media (min-width: 768px) and (max-width: 1023px) {
            .tablet-adjust {
                font-size: 0.9rem;
            }
        }

        /* Touch-friendly sizing for mobile */
        @media (max-width: 640px) {
            button, a, input, select, textarea {
                min-height: 44px;
            }
            .touch-friendly {
                padding: 0.75rem;
                margin: 0.25rem 0;
            }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Mobile Header with Toggle -->
    <div class="lg:hidden bg-white shadow-lg p-2 sm:p-3 md:p-4 flex items-center justify-between sticky top-0 z-30 border-b border-gray-200">
        <button onclick="toggleSidebar()" class="text-gray-700 hover:text-blue-600 transition-colors duration-200 p-1.5 sm:p-2 rounded-lg hover:bg-blue-50 active:bg-blue-100">
            <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="flex items-center space-x-1.5 sm:space-x-2">
            <img src="/logo/logo1.png" alt="MedBuzzy Logo" class="h-12 sm:h-12 md:h-20">
        </div>
        <div class="flex items-center space-x-1 sm:space-x-2 md:space-x-3">
            <div class="relative">
                <button class="text-gray-600 hover:text-blue-600 transition-colors duration-200 p-1.5 sm:p-2 rounded-lg hover:bg-gray-100 active:bg-gray-200">
                    <i class="fas fa-bell text-sm sm:text-base md:text-lg"></i>
                    <span class="absolute top-0.5 right-0.5 sm:top-1 sm:right-1 inline-block w-1.5 h-1.5 sm:w-2 sm:h-2 bg-red-500 rounded-full notification-dot"></span>
                </button>
            </div>
            <div class="w-6 h-6 sm:w-8 sm:h-8 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full flex items-center justify-center shadow-inner">
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
            <main class="flex-1 responsive-container bg-gray-50 min-h-screen">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white shadow-inner border-t border-gray-200 mt-auto">
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
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-15 lg:hidden hidden sidebar-overlay" onclick="toggleSidebar()"></div>

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

     <!-- Global Scripts -->
    <script>
        // SVG Auto Attribute Fix
        (function () {
            if (window.__svgAutoFixInstalled) return;
            window.__svgAutoFixInstalled = true;
            function fixSvgAutoAttributes(root = document) {
                try {
                    const svgs = root.querySelectorAll ? root.querySelectorAll('svg') : [];
                    svgs.forEach(svg => {
                        const w = svg.getAttribute('width');
                        const h = svg.getAttribute('height');
                        if (w && String(w).toLowerCase() === 'auto') {
                            svg.setAttribute('width', svg.classList.contains('h-5') ? '20' : '16');
                        }
                        if (h && String(h).toLowerCase() === 'auto') {
                            svg.setAttribute('height', svg.classList.contains('h-5') ? '20' : '16');
                        }
                    });
                } catch (e) {
                    console.debug('SVG auto-attr fix skipped:', e);
                }
            }
            const observer = new MutationObserver(mutations => {
                for (const m of mutations) {
                    m.addedNodes.forEach(node => {
                        if (node && node.nodeType === 1) fixSvgAutoAttributes(node);
                    });
                }
            });
            function initSvgFix() {
                fixSvgAutoAttributes();
                try { observer.observe(document.documentElement, { childList: true, subtree: true }); } catch (_) {}
            }
            document.addEventListener('DOMContentLoaded', initSvgFix);
            document.addEventListener('livewire:init', initSvgFix);
            document.addEventListener('livewire:navigated', initSvgFix);
        })();

        // Razorpay Integration
        function loadRazorpaySDK(callback) {
            if (typeof Razorpay !== 'undefined') {
                callback();
                return;
            }
            const script = document.createElement('script');
            script.src = 'https://checkout.razorpay.com/v1/checkout.js';
            script.async = true;
            script.onload = () => {
                console.log('Razorpay SDK loaded successfully');
                callback();
            };
            script.onerror = () => {
                console.error('Failed to load Razorpay SDK dynamically');
                // Always notify Livewire; server-side handlers will manage UI/redirects.
                Livewire.dispatch('payment-failed', {
                    error: 'Unable to load payment service',
                    orderId: window.lastPaymentData?.orderId ?? null,
                    appointmentId: window.lastPaymentData?.appointmentId ?? null
                });
            };
            document.body.appendChild(script);
        }

        function openRazorpayCheckout(data) {
            data = data[0];
            if (!data) {
                console.error('No data provided for Razorpay checkout');
                Livewire.dispatch('payment-failed', {
                    error: 'Payment initiation failed: No data provided',
                    orderId: data?.orderId ?? null,
                    appointmentId: data?.appointmentId ?? null
                });
                return;
            }
            
            // Store payment data for potential use in error handlers
            window.lastPaymentData = data;

            let retries = 0;
            const maxRetries = 1; // fewer retries for faster feedback
            const retryDelay = 200;

            function attemptOpen() {
                loadRazorpaySDK(() => {
                    if (typeof Razorpay === 'undefined') {
                        console.error('Razorpay SDK not loaded after dynamic load attempt');
                        if (retries < maxRetries) {
                            retries++;
                            console.log(`Retrying Razorpay checkout (attempt ${retries + 1})`);
                            setTimeout(attemptOpen, retryDelay);
                        } else {
                            // Notify Livewire that payment initiation failed; server handles retry UI/redirect.
                            Livewire.dispatch('payment-failed', {
                                error: 'Razorpay SDK failed to load',
                                orderId: data.orderId ?? null,
                                appointmentId: data.appointmentId ?? null
                            });
                        }
                        return;
                    }

                    setTimeout(() => {
                        const options = {
                            key: data.key || "{{ config('services.razorpay.key') }}",
                            amount: String(data.amount),
                            currency: "INR",
                            name: "Medbuzzy",
                            description: "Appointment Booking",
                            image: "{{ asset('logo/logo1.png') }}",
                            order_id: data.orderId,
                            handler: function (response) {
                                console.log('Payment success:', response);
                                // Dispatch for Livewire and also emit a plain CustomEvent so handlers receive the same shape
                                Livewire.dispatch('payment-success', {
                                     paymentId: response.razorpay_payment_id,
                                     orderId: response.razorpay_order_id,
                                     signature: response.razorpay_signature,
                                     allData: data,
                                     appointmentData: data.appointmentData,
                                     appointmentId: data.appointmentId
                                });
                                try {
                                    window.dispatchEvent(new CustomEvent('payment-success', {
                                        detail: {
                                            paymentId: response.razorpay_payment_id,
                                            orderId: response.razorpay_order_id,
                                            signature: response.razorpay_signature,
                                            allData: data,
                                            appointmentData: data.appointmentData,
                                            appointmentId: data.appointmentId
                                        }
                                    }));
                                } catch (e) { console.debug('CustomEvent dispatch failed', e); }
                                document.body.style.overflow = '';
                            },
                            prefill: {
                                name: data?.patientData?.name || "{{ auth()->user()?->name ?? 'Customer' }}",
                                email: data?.patientData?.email || "{{ auth()->user()?->email ?? 'customer@example.com' }}",
                                contact: data?.patientData?.phone || "{{ auth()->user()?->phone ?? '9999999999' }}"
                            },
                            theme: { color: "#3399cc" },
                            modal: {
                                ondismiss: function () {
                                    console.log('Razorpay modal dismissed');
                                    document.body.style.overflow = '';
                                    // Let Livewire handle cancelled/dismiss flows
                                    Livewire.dispatch('payment-failed', { 
                                        error: 'Payment was cancelled by user',
                                        orderId: data.orderId ?? null,
                                        appointmentId: data.appointmentId ?? null
                                    });
                                }
                            }
                        };

                        try {
                            const rzp = new Razorpay(options);
                            rzp.on('payment.failed', function (resp) {
                                console.error('Payment failed - dispatching payment-failed:', resp);
                                document.body.style.overflow = '';
                                // Dispatch standardized failure event; server will handle UI/redirect.
                                Livewire.dispatch('payment-failed', { 
                                    appointmentId: data.appointmentId ?? null, 
                                    orderId: data.orderId ?? data.order_id ?? null, 
                                    error: resp?.error?.description || 'Payment failed'
                                });
                                 // Let Livewire handle the redirect to failed page
                             });
                            console.log('Opening Razorpay checkout with options:', options);
                            rzp.open();
                        } catch (error) {
                            console.error('Error initializing Razorpay checkout:', error);
                            document.body.style.overflow = '';
                            if (retries < maxRetries) {
                                retries++;
                                console.log(`Retrying Razorpay checkout (attempt ${retries + 1})`);
                                setTimeout(attemptOpen, retryDelay);
                            } else {
                                console.log('Max retries reached for Razorpay initialization - dispatching payment-failed');
                                Livewire.dispatch('payment-failed', {
                                    error: 'Failed to initialize payment after multiple attempts',
                                    orderId: data.orderId ?? null,
                                    appointmentId: data.appointmentId ?? null
                                });
                                 // Let Livewire backend handle redirect to failed page
                             }
                        }
                    }, 200);
                });
            }

            attemptOpen();
        }

        function setupRazorpayListeners() {
            if (window.__rzpListenersSetup) {
                console.log('Razorpay listeners already set up, skipping');
                return;
            }
            window.__rzpListenersSetup = true;

            console.log('Setting up Razorpay listeners');

            Livewire.on('razorpay:open', (data) => {
                console.log('Livewire razorpay:open event received:', data);
                openRazorpayCheckout(data);
            });

            window.addEventListener('razorpay:open', (e) => {
                console.log('Browser razorpay:open event received:', e.detail);
                openRazorpayCheckout(e.detail);
            });

            Livewire.on('show-payment-failed', (data) => {
                console.log('Show payment failed:', data);
                showPaymentFailedOverlay(data?.message || 'Payment failed', () => {
                    Livewire.dispatch('retry-payment');
                });
            });

            document.addEventListener('livewire:navigated', () => {
                console.log('Livewire navigated, rebinding Razorpay listeners');
                window.__rzpListenersSetup = false;
                setupRazorpayListeners();
            });

            Livewire.on('redirect-to-confirmation', (url) => {
                console.log('Redirecting to confirmation:', url);
                document.body.style.overflow = '';
                // Use window.location to ensure session preservation
                window.location.href = url;
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOM loaded, initializing Razorpay listeners');
            setupRazorpayListeners();
        });
        document.addEventListener('livewire:init', () => {
            console.log('Livewire initialized, initializing Razorpay listeners');
            setupRazorpayListeners();
        });
    </script>

</body>
</html>