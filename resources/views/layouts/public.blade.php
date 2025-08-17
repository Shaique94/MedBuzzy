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
        <main class="flex-1 overflow-x-hidden md:mt-16 mt-12 overflow-y-auto bg-gray-100 pb-5 lg:pb-0">
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

        // Payment Failed Overlay
        function showPaymentFailedOverlay(message, onRetry) {
            const existing = document.getElementById('payment-failed-overlay');
            if (existing) existing.remove();
            const overlay = document.createElement('div');
            overlay.id = 'payment-failed-overlay';
            overlay.style.position = 'fixed';
            overlay.style.inset = '0';
            overlay.style.background = 'rgba(0,0,0,0.5)';
            overlay.style.display = 'flex';
            overlay.style.alignItems = 'center';
            overlay.style.justifyContent = 'center';
            overlay.style.zIndex = '10000';
            overlay.innerHTML = `
                <div style="background:white;max-width:480px;width:90%;border-radius:12px;padding:20px;box-shadow:0 10px 30px rgba(0,0,0,0.2)">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2"><path d="M12 9v4m0 4h.01"/><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                        <h3 style="font-weight:700;color:#111827;margin:0;">Payment Failed</h3>
                    </div>
                    <p style="color:#374151;margin:8px 0 16px;">${message || 'Payment could not be completed. Please try again.'}</p>
                    <div style="display:flex;gap:8px;justify-content:flex-end;">
                        <button id="pf-close" style="padding:8px 12px;border:1px solid #e5e7eb;border-radius:8px;background:#fff;color:#374151;">Close</button>
                        <button id="pf-retry" style="padding:8px 12px;border:none;border-radius:8px;background:#0d4b8c;color:#fff;">Retry Payment</button>
                    </div>
                </div>
            `;
            document.body.appendChild(overlay);
            overlay.querySelector('#pf-close').addEventListener('click', () => overlay.remove());
            overlay.querySelector('#pf-retry').addEventListener('click', () => {
                overlay.remove();
                try { onRetry && onRetry(); } catch (e) { console.error(e); }
            });
        }

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
                console.error('Failed to load Razorpay SDK');
                showPaymentFailedOverlay('Unable to load payment service. Please check your internet connection and try again.');
            };
            document.body.appendChild(script);
        }

        function openRazorpayCheckout(data) {
            if (!data) {
                console.error('No data provided for Razorpay checkout');
                showPaymentFailedOverlay('Payment initiation failed: No data provided.');
                return;
            }

            let retries = 0;
            const maxRetries = 2;
            const retryDelay = 500;

            function attemptOpen() {
                loadRazorpaySDK(() => {
                    if (typeof Razorpay === 'undefined') {
                        console.error('Razorpay SDK not loaded after dynamic load attempt');
                        if (retries < maxRetries) {
                            retries++;
                            console.log(`Retrying Razorpay checkout (attempt ${retries + 1})`);
                            setTimeout(attemptOpen, retryDelay);
                        } else {
                            showPaymentFailedOverlay('Payment service is currently unavailable. Please try again later.', () => {
                                Livewire.dispatch('retry-payment');
                            });
                            Livewire.dispatch('payment-failed', {
                                error: 'Razorpay SDK failed to load',
                                orderId: data.orderId,
                                appointmentId: data.appointmentId
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
                            image: "{{ asset('logo.png') }}",
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
                                    Livewire.dispatch('payment-failed', { appointmentId: data.appointmentId });
                                    try { window.dispatchEvent(new CustomEvent('payment-failed', { detail: { appointmentId: data.appointmentId } })); } catch(e){}
                                    showPaymentFailedOverlay('Payment was cancelled. Please try again.', () => {
                                        Livewire.dispatch('retry-payment');
                                    });
                                }
                            }
                        };

                        try {
                            const rzp = new Razorpay(options);
                            rzp.on('payment.failed', function (resp) {
                                console.error('Payment failed:', resp);
                                document.body.style.overflow = '';
                                Livewire.dispatch('payment-failed', { appointmentId: data.appointmentId, error: resp?.error?.description });
                                try { window.dispatchEvent(new CustomEvent('payment-failed', { detail: { appointmentId: data.appointmentId, error: resp?.error?.description } })); } catch(e){}
                                showPaymentFailedOverlay(resp?.error?.description || 'Payment failed', () => {
                                    Livewire.dispatch('retry-payment');
                                });
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
                                showPaymentFailedOverlay('Failed to initiate payment. Please try again.', () => {
                                    Livewire.dispatch('retry-payment');
                                });
                                Livewire.dispatch('payment-failed', {
                                    error: 'Failed to initialize payment',
                                    orderId: data.orderId,
                                    appointmentId: data.appointmentId
                                });
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
                Livewire.navigate(url);
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

    <!-- Tawk.to Chat - Desktop Only -->
    <script>
        if (window.innerWidth > 768) {
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function(){
                var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/689c2cfeddd4a0192670a0f5/1j2h0vh9g';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        }
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && typeof Tawk_API === 'undefined') {
                var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
                (function(){
                    var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                    s1.async = true;
                    s1.src = 'https://embed.tawk.to/689c2cfeddd4a0192670a0f5/1j2h0vh9g';
                    s1.charset = 'UTF-8';
                    s1.setAttribute('crossorigin', '*');
                    s0.parentNode.insertBefore(s1, s0);
                })();
            } else if (window.innerWidth <= 768 && typeof Tawk_API !== 'undefined') {
                if (Tawk_API.hideWidget) Tawk_API.hideWidget();
            }
        });
    </script>
</body>
</html>